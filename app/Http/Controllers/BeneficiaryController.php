<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Beneficiary::orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="transfer btn btn-success btn-sm" id="transfer" data-id=' . $row->id . '>Transfer amount</a>';
                    $btn = $btn . '<a class="editBeneficiary btn btn-primary btn-sm" data-id=' . $row->id . '  data-user_name=' . $row->user_name . '
                            data-IBAN=' . $row->IBAN . '   data-acc_number=' . $row->acc_number .'>Edit</a>';
                    $btn = $btn . '<a href="' . url("beneficiary/delete/" .  $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $user = User::where('user_type', 'user')->get();
        return view('beneficiary.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "user_name" => "required",
            "acc_number" => "required|exists:users,acc_number|unique:beneficiaries",
            "IBAN" => "required|exists:users,IBAN|unique:beneficiaries"
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        try {
            $user = User::where('acc_number', $request->acc_number)->orWhere('IBAN', $request->IBAN)->first();
            $data = [
                'user_name' => $request->user_name,
                'IBAN' => $request->IBAN,
                'acc_number' => $request->acc_number,
            ];
            if (!empty($user)) {
                $data['user_id'] = $user->id;
            }
            Beneficiary::create($data);
            return Redirect::back()->withSuccess(['success', 'Registered successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|exists:beneficiaries,id",
            "user_name" => "required",
            "IBAN" => "nullable|exists:users,IBAN|unique:beneficiaries,IBAN," . $request->id,
            "acc_number" => "required|exists:users,acc_number|unique:beneficiaries,acc_number," . $request->id,
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        try {
            $user = Beneficiary::find($request->id);
            if (empty($user)) {
                return Redirect::back()->withErrors(['User not found']);
            }
            $auth_user = Auth::user();
            if ($auth_user->IBAN === $request->IBAN || $auth_user->acc_number === $request->acc_number)
            {
                return Redirect::back()->withErrors(['You can add your account as a beneficiary.']);
            }
            $data = [
                'user_name' => $request->user_name,
                'IBAN' => $request->IBAN,
                'acc_number' => $request->acc_number
            ];
            $user->update($data);
            return Redirect::back()->withSuccess(['success', 'Beneficiary updated successfully successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $beneficiary = Beneficiary::find($id);
            if (empty($beneficiary)) {
                return Redirect::back()->withErrors(['Sorry no beneficiary found']);
            }
            $beneficiary->delete();
            return Redirect::back()->withSuccess(['Beneficiary deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }

    public function transfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|exists:beneficiaries,id",
            "amount" => "required",
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        try {
            $auth_user = Auth::user();
            $beneficiary = Beneficiary::whereId($request->id)->with(['user'])->first();
            if (empty($beneficiary)) {
                return Redirect::back()->withErrors(['error', 'Beneficiary not found']);
            }
            if ($auth_user->balance < $request->amount)
            {
                return Redirect::back()->withErrors(['Requested amount is greater than user balance']);
            }
            if (!empty($beneficiary->user)) {
                if ($beneficiary->user->id === $auth_user->id)
                {
                    return Redirect::back()->withErrors(['You can not transfer amount in yours account']);
                }
                $auth_user->update(['balance' => ($auth_user->balance - $request->amount)]);
                $balance = $beneficiary->user->balance + $request->amount;
                User::whereId($beneficiary->user->id)->update(['balance' => $balance]);
            }
            $data = [
                'beneficiary_id' => isset($beneficiary->id) ? $beneficiary->id : "",
                'sender_id' => $auth_user->id,
                'receiver_id' => !empty($beneficiary->user) ?  $beneficiary->user->id : "",
                'type' => 'credit',
                'amount' => $request->amount,
                'send_by' => 'other'
            ];
            Transaction::create($data);
            return Redirect::back()->withSuccess(['success', 'User updated successfully successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }

}
