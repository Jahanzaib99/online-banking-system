<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request)
    {
        if ($request->ajax()) {

            $data = Sale::orderBy('created_at', 'desc')->get();

            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('sparePartName', function($rst){
                    return !empty ($rst->spare_part->title) ? $rst->spare_part->title : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('userName', function($rst){
                    return !empty ($rst->user->name) ? $rst->user->name : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('action', function($row){
                    // $btn = '<a href="' . route("sparepart.edit", $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    // $btn = $btn.'<a href="' . route("sparepart.delete", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';
                    $btn = '';
                    $btn = $btn.'<a href="" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.sales.list');
    }


}
