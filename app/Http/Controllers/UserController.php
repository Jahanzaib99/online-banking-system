<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private function generateBarcodeNumber()
    {
        $number = mt_rand(1000000000, 9999999999); // better than rand()

        // call the same function if the barcode exists already
        if (barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::whereUserType('user')->orderBy('created_at', 'desc')->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->editColumn('name', function ($rst) {
                    return $rst->first_name . " " . $rst->last_name;
                })
                ->editColumn('avatar', function ($rst) {
                    return '<img src="' . url(Storage::disk('local')->url($rst->avatar)) . '">';
                })
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->editColumn('balance', function ($record) {
                    return "\xE2\x82\xAc" . " " . $record->balance;
                })
                ->addColumn('action', function ($row) {
                    $avatar = !empty($row->avatar) ? url($row->avatar) : "";
//                    $btn = '';
//                    $btn = '<a href="' . route("admin.supplier.show", $row->id) . '" class="edit btn btn-primary btn-sm">View</a>';
                    $btn = '<a class="transfer btn btn-success btn-sm" id="transfer" data-id=' . $row->id . '>Transfer amount</a>';
                    $btn = $btn . '<a class="editUser btn btn-primary btn-sm" id="editUser" data-id=' . $row->id . '  data-first_name=' . $row->first_name . '
                            data-last_name=' . $row->last_name . '   data-phone=' . $row->phone . '  data-email=' . $row->email . '
                            data-city=' . $row->city . '  data-country=' . $row->country . '  data-avatar=' . $avatar . '>Edit</a>';
                    $btn = $btn . '<a href="' . route("admin.user.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action', 'avatar', 'balance'])
                ->make(true);

        }
        return view('admin.suppier.list');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "nullable",
            "email" => "required|email|unique:users",
            "city" => "nullable",
            "country" => "nullable",
            "phone" => "nullable",
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        try {
            $account_number = mt_rand(10000000000000, 99999999999999);
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'country' => $request->country,
                'password' => empty($request->password) ? bcrypt('12345678') : bcrypt($request->password),
                'user_type' => 'user',
                'acc_number' => $account_number,
                'IBAN' => 'PKHBL' . $account_number,
            ];
            if ($request->file('avatar')) {
                $imagePath = $request->file('avatar');
                $imageName = $imagePath->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('profile', $imageName, 'public');
                $data['avatar'] = $path;
            }
            User::create($data);
            return Redirect::back()->withSuccess(['success', 'Registered successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => "required",
            "last_name" => "nullable",
            "email" => "required|unique:users,email," . $request->id,
            "city" => "nullable",
            "country" => "nullable",
            "phone" => "nullable",
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        try {
            $user = User::find($request->id);
            if (empty($user)) {
                return Redirect::back()->withErrors(['error', 'User not found']);
            }
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'country' => $request->country,
            ];
            if ($request->file('avatar')) {
                $imagePath = $request->file('avatar');
                $imageName = $imagePath->getClientOriginalName();
                $path = $request->file('avatar')->storeAs('profile', $imageName, 'public');
                $data['avatar'] = $path;
            }
            $user->update($data);
            return Redirect::back()->withSuccess(['success', 'User updated successfully successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }

    public function transfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required|exists:users,id",
            "amount" => "required",
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }
        try {
            $user = User::find($request->id);
            if (empty($user)) {
                return Redirect::back()->withErrors(['error', 'User not found']);
            }
            $balance = $user->balance +  $request->amount;

            $user->update(['balance' => $balance]);
            Transaction::create([
                'type' => 'credit',
                'amount' => $request->amount,
                'send_by' => 'admin'
            ]);
            return Redirect::back()->withSuccess(['success', 'User updated successfully successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if (empty($user)) {
                return Redirect::back()->withErrors(['error', 'Sorry no user found']);
            }
            $user->delete();
            return Redirect::back()->withSuccess(['User deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }

}
