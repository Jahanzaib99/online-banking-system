<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Make;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Car::orderBy('created_at', 'desc')->get();

            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('carModel', function($rst){
                    return empty ($rst->carModel->name) ? $rst->carModel->name : $rst->carModel->name;
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('Make', function($action){
                    return empty ($action->Make->name) ? $action->Make->name : $action->Make->name;
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route("car.edit", $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn = $btn.'<a href="' . route("car.delete", $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.car.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $make = Make::whereStatus('publish')->get();
            $model = CarModel::whereStatus('publish')->get();

            return view('admin.car.create',compact('make','model'));

        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
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
                SaveImageAllSizes($request, 'car/');
                $path = 'car/'.$request->image->hashName();
            }
            $data = [
                'title' => $request->title,
                'make_id' => $request->make,
                'car_model_id' => $request->model,
                'year' => $request->year,
                'registration' => $request->registration,
                'mileage' => $request->mileage,
                'transmission' => $request->transmission,
                'fuel' => $request->fuel,
                'description' => $request->description,
                'engine' => $request->engine,
                'body' => $request->body,
                'trim' => $request->trim,
                'gearbox' => $request->gearbox,
                'image' => empty($path) ? 'defaul.png' : $path,
            ];
            Car::Create($data);
            DB::commit();
            return redirect(route('car.index'))->with('success', 'Car inserted successfully.');
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['Sorry Record not inserted.']);
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
       //dd('ada');
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
            $data = Car::find($id);
            $make = Make::whereStatus('publish')->get();
            $model = CarModel::whereStatus('publish')->get();
            if ($data) {
                return view('admin.car.edit',compact('data','make','model'));
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
            $car = Car::find($id);
            DB::beginTransaction();
            if ($car){
                if ($request->hasFile('profile_pic')){
                    UpdateImageAllSizes($request, 'car/', $car->image);
                    //$path = Storage::disk('s3')->put('profiles', $request->file('profile_pic'));
                    $path = 'car/'.$request->profile_pic->hashName();
                }
                $data = [
                    'title' => !empty($request->title) ? $request->title : $car->title,
                    'make_id' => !empty($request->make) ? $request->make : $car->make_id,
                    'car_model_id' =>  !empty($request->model) ? $request->model : $car->car_model_id,
                    'year' =>  !empty($request->year) ? $request->year : $car->year,
                    'registration' => !empty($request->registration) ? $request->registration : $car->registration,
                    'mileage' => !empty($request->mileage) ? $request->mileage : $car->mileage,
                    'transmission' => !empty($request->transmission) ? $request->transmission : $car->transmission,
                    'fuel' => !empty($request->fuel) ? $request->fuel : $car->fuel,
                    'description' =>  !empty($request->description) ? $request->description : $car->description,
                    'image' => empty($path) ? 'defaul.png' : $path,
                ];

                $car->update($data);
                DB::commit();
                return redirect(route('car.index'))->with('success', 'Record has been updated.');
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

        try {
            $data_exist = Car::find($id);
            if ($data_exist) {
                $data_exist->delete();
                return redirect(route('car.index'))->with('success', 'Record has been deleted.');
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
    public function deleteCar($id)
    {
        try {
            $data_exist = Car::find($id);
            if ($data_exist) {
                $data_exist->delete();
                return redirect(route('car.index'))->with('success', 'Record has been deleted.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }
}
