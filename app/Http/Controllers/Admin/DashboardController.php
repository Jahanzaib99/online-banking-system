<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Make;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {

        $this->middleware('auth');
    }*/
    /**
     * Show the application dashboard.
     * eSquall@318
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('admin.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function supplierDetial($id)
    {
        try {
            $data = User::whereId($id)->whereHas('supplier')->with('supplier')->first();

            if ($data) {
                return view('admin.suppier.detail', compact('data'));
            } else {
                return Redirect::back()->withErrors(['Sorry Record not found.']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['Sorry Record not found.']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function supplierEdit(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required',
        ]);

        try {
            $make = Supplier::find($id);
            DB::beginTransaction();
            if ($make) {
                $data = [
                    'account_status' => !empty($request->status) ? $request->status : $make->account_status,
                ];
                $make->update($data);
                DB::commit();
                return Redirect::back()->with('success', 'Status has been updated successfully.');
            }
            return Redirect::back()->withErrors(['Sorry Record not inserted.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }
}
