<?php

namespace App\Http\Controllers;

use App\Models\RequestOrder;
use App\Models\Sale;
use App\Models\SendOffer;
use App\Models\SparePartTypes;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        return view('admin.dashboard');
    }

    public function join()
    {
        return view('supplier.join');
    }

    public function sendOffer($id){
        try {
            $spare_part = RequestOrder::find($id);
            //dd($spare_part);
            return view('supplier.sendoffer',compact('spare_part'));
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "trade_name" => "required",
            "contact_name" => "nullable",
            "contact_tel" => "nullable",
            "email" => "required|email|unique:users",
            "address_1" => "nullable",
            "address_2" => "nullable",
            "post_town" => "nullable",
            "county" => "nullable",
            "country" => "nullable",
            "postcode" => "nullable",
            "website_address" => "nullable",
            "business_type" => "nullable",
            "company_registration_number" => "required",
            "vat_registered" => "required",
            "trading_years" => "nullable",
            "about" => "nullable",
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors(['error' => 'Required fields are empty']);
        }
        try {
            $user = User::create([
                'name' => $request->contact_name,
                'email' => $request->email,
                'phone' => $request->contact_tel,
                'password' => empty($request->password) ? '' : bcrypt($request->password),
                'user_type' => 'Supplier',
            ]);
            Supplier::create([
                'user_id' => $user->id,
                "trade_name" => $request->trade_name,
                "contact_name" => $request->contact_name,
                "contact_tel" => $request->contact_tel,
                "contact_email" => $request->email,
                "address_1" => $request->address_1,
                "address_2" => $request->address_2,
                "post_town" => $request->post_town,
                "county" => $request->county,
                "country" => $request->country,
                "postcode" => $request->postcode,
                "website_address" => $request->website_address,
                "business_type" => $request->business_type,
                "company_registration_number" => $request->company_registration_number,
                "vat_registered" => $request->vat_registered,
                "trading_years" => $request->trading_years,
                "vehicle_parts_deal" => $request->vehicle_parts_deal,
                "ebay_account_username" => $request->ebay_account_username,
                "about" => $request->about,
            ]);

            DB::commit();
            return Redirect::back()->withSuccess(['success', 'Registered successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {
        if ($request->ajax()) {

            $data = RequestOrder::orderBy('created_at', 'desc')->get();

            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function($rst){
                    return !empty ($rst->sparePartType->title) ? $rst->sparePartType->title : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('name', function($rst){
                    return !empty ($rst->user->name) ? $rst->user->name : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('colour', function($rst){
                    return !empty ($rst->sparePartType->colour) ? $rst->sparePartType->colour : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route("send.offer", $row->id) . '" class="edit btn btn-primary btn-sm">View</a>';
                    $btn = $btn.'<a href="#" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.sales.list');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allOffers(Request $request)
    {
        if ($request->ajax()) {

            $data = SendOffer::whereSenderId(auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function($rst){
                    return !empty ($rst->sparePartTpe->title) ? $rst->sparePartTpe->title : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('name', function($rst){
                    return !empty ($rst->reciever->name) ? $rst->reciever->name : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })

                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route("send.offer", $row->id) . '" class="edit btn btn-primary btn-sm">View</a>';
                    $btn = $btn.'<a href="#" class="edit btn btn-danger btn-sm">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('supplier.offer_list');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendOfferStore(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            "price" => "required",
            "description" => "required",
            "colour" => "nullable",
            "size" => "nullable",
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors(['error' => 'Required fields are empty']);
        }
        try {
            $path = "profiles/default.png";
            if($request->hasFile('image')){
                SaveImageAllSizes($request, 'sendoffer/');
                $path = 'sendoffer/'.$request->image->hashName();
            }
            $user = SendOffer::create([
                'sender_id' => auth()->user()->id,
                'reciever_id' => $request->reciever_id,
                'request_order_id' => $id,
                'spare_part_type_id' => $request->spare_part_type_id,
                'size' => $request->size,
                'colour' => $request->colour,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $path,
            ]);

            DB::commit();
            return Redirect::back()->withSuccess(['success', 'Offer sent successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted']);
        }
    }
}
