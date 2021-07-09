<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Make;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
class MakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Make::orderBy('created_at', 'desc')->get();

            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route("make.edit", $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn = $btn.'<a href="' . route("make.delete", $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
       return view('admin.make.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.make.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            //upload profile pic
            $path = "profiles/default.png";
            if($request->hasFile('image')){
                SaveImageAllSizes($request, 'make/');
                $path = 'make/'.$request->image->hashName();
            }
            $data = [
                'name' => $request->name,
                'status' => $request->status,
                'image' => empty($path) ? 'defaul.png' : $path,
            ];
            Make::Create($data);
            DB::commit();
            return redirect(route('make.index'))->with('success', 'Make inserted successfully.');
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
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
        try {
            $data = Make::find($id);
            if ($data) {
                return view('admin.make.edit',compact('data'));
            } else {
                return Redirect::back()->withErrors(['error', 'Sorry Record not found.']);
            }
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not found.']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        //try {
            //dd($request);
            $make = Make::find($id);
            DB::beginTransaction();
            if ($make){
                if ($request->hasFile('profile_pic')){
                    UpdateImageAllSizes($request, 'make/', $make->image);
                    //$path = Storage::disk('s3')->put('profiles', $request->file('profile_pic'));
                    $path = 'make/'.$request->profile_pic->hashName();
                }
                $data = [
                    'name' => !empty($request->name) ? $request->name : $make->name,
                    'status' => !empty($request->status) ? $request->status : $make->status,
                    'image' => empty($path) ? 'defaul.png' : $path,
                ];
                $make->update($data);
                DB::commit();
                return redirect(route('make.index'))->with('success', 'Record has been updated.');
            }
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        /*} catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }*/
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
            $data_exist = User::find($id);
            if ($data_exist) {
                $data_exist->delete();
                return redirect(route('users.index'))->with('success', 'Record has been deleted.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteMake($id)
    {
        try {
            $data_exist = Make::find($id);
            if ($data_exist) {
                $data_exist->delete();
                return redirect(route('make.index'))->with('success', 'Record has been deleted.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }
}
