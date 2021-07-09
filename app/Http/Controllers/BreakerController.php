<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Make;
use App\Models\RequestOrder;
use App\Models\Sale;
use App\Models\SendOffer;
use App\Models\SparePart;
use App\Models\SparePartTypes;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BreakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = \Auth::user();
            return view('admin.dashboard', compact('user'));
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error', 'Sorry something went wrong']);
        }

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
            return view('admin.spare_parts.create', compact('cars'));

        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['error', 'Sorry something went wrong']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function orderSave(Request $request)
    {
        //dd($request);

        try {
            $user = \Auth::user();
            DB::beginTransaction();

            foreach ($request->product_id as $p_id) {

                $product_exist = SparePart::find($p_id);
                if ($product_exist) {
                    $data = [
                        'user_id' => $user->id,
                        'spare_part_id' => $p_id,
                        'price' => $product_exist->price * $request->$p_id,
                        'quantity' => $request->$p_id,
                    ];
                    Sale::Create($data);
                }
            }
            Session::forget('cart');
            $data = [];
            \Mail::send('email.message', $data, function ($message) use ($data) {
                $message->to('jk@gmail.com', '')->subject
                ("Testing email by Spareparts");
                $message->from('admin@admin.com', 'Spareparts');
            });
            DB::commit();
            // return Redirect::back()->with('success', 'Order Submitted successfully.');

            return redirect(route('home'))->with('success', 'Order sumitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestedOrder(Request $request)
    {
        if ($request->ajax()) {

            $data = RequestOrder::orderBy('created_at', 'desc')->get();

            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($rst) {
                    return !empty ($rst->sparePartType->title) ? $rst->sparePartType->title : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('colour', function ($rst) {
                    return !empty ($rst->sparePartType->colour) ? $rst->sparePartType->colour : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route("sparepart.delete", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('customer.order.requested_list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function requestOrder(Request $request)
    {
        //dd($request);
        try {
            $user = \Auth::user();
            DB::beginTransaction();

            $product_exist = SparePartTypes::find($request->id);
            if ($product_exist) {
                $data_body = [
                    'user_id' => $user->id,
                    'spare_part_type_id' => $request->id,
                ];
                $insert = RequestOrder::Create($data_body);
                $data = [];
                \Mail::send('email.message', $data, function ($message) use ($data) {
                    $message->to('jk@gmail.com', '')->subject
                    ("Testing email by Spareparts");
                    $message->from('admin@admin.com', 'Spareparts');
                });
                DB::commit();
                return $this->apiResponse(JsonResponse::HTTP_OK, 'data', $insert);
            } else {
                return $this->apiResponse(JsonResponse::HTTP_NOT_FOUND, 'message', 'Record not found');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function supplierOffer(Request $request)
    {
        if ($request->ajax()) {

            $data = SendOffer::whereRecieverId(auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($rst) {
                    return !empty ($rst->sparePartTpe->title) ? $rst->sparePartTpe->title : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('name', function ($rst) {
                    return !empty ($rst->sender->name) ? $rst->sender->name : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route("add.to.cart", $row->id) . '" class="edit btn btn-primary btn-sm">Add To Cart</a>';
                    $btn = $btn . '<a class="btn btn-info btn-sm getProductData" data-id="' . $row->id . '" data-supplier_id="' . $row->reciever_id . '" data-size="' . $row->size . '"  data-colour="' . $row->colour . '" data-price="' . $row->price . '" data-description="' . $row->description . '" data-status="' . $row->status . '" data-img="' . url($row->image) . '">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('customer.order.offer_list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function purchasedItem(Request $request)
    {
        if ($request->ajax()) {

            $data = Sale::whereUserId(auth()->user()->id)->orderBy('created_at', 'desc')->get();
            return \Yajra\DataTables\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($rst) {
                    return !empty ($rst->spare_part->title) ? $rst->spare_part->title : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->addColumn('name', function ($rst) {
                    return !empty ($rst->user->name) ? $rst->user->name : "";
                    //return DB::raw("SELECT * FROM 'patients' WHERE 'patients_id' = ?", $action->patient_id);
                })
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route("add.to.cart", $row->id) . '" class="edit btn btn-primary btn-sm">Add To Cart</a>';
                    $btn = $btn . '<a class="btn btn-info btn-sm getProductData" data-id="' . $row->id . '" data-href="' . route("purchase") . '" data-img="' . url($row->image) . '">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('customer.order.purchased_item');
    }
}
