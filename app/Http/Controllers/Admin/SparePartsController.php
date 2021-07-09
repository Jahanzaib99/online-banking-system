<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Make;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SparePartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = SparePart::orderBy('created_at', 'desc')->get();

            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('carName', function($rst){
                    return empty ($rst->car->title) ? $rst->car->title : $rst->car->title;
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route("sparepart.edit", $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn = $btn.'<a href="' . route("sparepart.delete", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.spare_parts.list');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $cars = Car::whereStatus('publish')->get();
            return view('admin.spare_parts.create',compact('cars'));

        } catch ( \Exception $e) {
            return Redirect::back()->withErrors(['error', 'Sorry something went wrong']);
        }
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
                SaveImageAllSizes($request, 'spare_parts/');
                $path = 'spare_parts/'.$request->image->hashName();
            }

            $data = [
                'title' => $request->title,
                'car_id' => $request->car_id,
                'description' => $request->description,
                'price' => $request->price,
                'image' => empty($path) ? 'default.png' : $path,
            ];
            SparePart::create($data);
            DB::commit();
            return redirect(route('sparepart.index'))->with('success', 'Spare parts inserted successfully.');
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
            $data = SparePart::find($id);
            $car = Car::whereStatus('publish')->get();
            if ($data) {
                return view('admin.spare_parts.edit',compact('data','car'));
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
            'title' => 'required',
        ]);


        try {
            //dd($request);
            $sparepart = SparePart::find($id);
            DB::beginTransaction();
            if ($sparepart){
                if ($request->hasFile('profile_pic')){
                    UpdateImageAllSizes($request, 'spare_parts/', $sparepart->image);
                    //$path = Storage::disk('s3')->put('profiles', $request->file('profile_pic'));
                    $path = 'spare_parts/'.$request->profile_pic->hashName();
                }
                $data = [
                    'title' => !empty($request->title) ? $request->title : $sparepart->title,
                    'car_id' =>  !empty($request->car_id) ? $request->car_id : $sparepart->car_id,
                    'price' =>  !empty($request->price) ? $request->price : 0.0,
                    'description' =>  !empty($request->description) ? $request->description : $sparepart->description,
                    'image' => empty($path) ? 'defaul.png' : $path,
                ];

                $sparepart->update($data);
                DB::commit();
                return redirect(route('sparepart.index'))->with('success', 'Record has been updated.');
            }
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
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
        //
    }

    public function deleteSparePart($id)
    {
        try {
            $data_exist = SparePart::find($id);
            if ($data_exist) {
                $data_exist->delete();
                return redirect(route('sparepart.index'))->with('success', 'Record has been deleted.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }


}
