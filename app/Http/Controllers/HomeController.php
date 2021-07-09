<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Make;
use App\Models\Sale;
use App\Models\SparePart;
use App\Models\SparePartTypes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    protected $url;
    protected $path;
    protected $key;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->url = config('app.DVLA_API_URL');
        $this->key = config('app.DVLA_API_KEY');

        $this->url .= $this->path;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $make = Make::whereStatus('publish')->withoutTrashed()->get();

            return view('frontend.index',compact('make'));
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function aboutUs()
    {
        try {
            return view('frontend.aboutus');
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contactUs()
    {
        try {
            return view('frontend.contactus');
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }

    /**
     * Show the car spareparts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getCarSpareParts()
    {
        try {
//            dd(\request('registration_number'));
            $spare_parts = [];
            $cars = Car::search(\request('registration_number'))->with(['spareParts'])->first();
            if(!empty($cars)) {
                $spare_parts = $cars->spareParts;
            }
            return view('frontend.sparepart.spare_parts', compact('spare_parts'));
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function vehicleDetail($id)
    {
        //dd($id);
        $spare_parts = [];
        $queryArray = ['registrationNumber' => $id];
        $api_data = $this->makeRequest( $queryArray );
        $data = json_decode($api_data, true);
        $cars = Car::search($id)->with(['spareParts'])->first();
        if(!empty($cars)) {
            $spare_parts = $cars->spareParts;
        }
        //dd($spare_parts);
        return view('frontend.vehicle.detail',compact('data','spare_parts'));
    }

    /**
     * Show the application dashboard.
     *
     * @Requesst \Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function findModel(Request $request)
    {
        $validated = $request->validate([
            'registrationNumber' => 'required|min:4',
        ]);
        try {
            $queryArray = ['registrationNumber' => !empty($request->registrationNumber) ? $request->registrationNumber : 'WN67DSO'];
            $api_data = $this->makeRequest( $queryArray );
            if ($api_data){
                $json_file = json_decode($api_data, true);
                if (isset($json_file['errors'])){
                    $message = $json_file['errors'][0]['detail'];
                    return Redirect::back()->withErrors(['error', $message]);
                } else {
                    return redirect(route('vehicle.detail',$request->registrationNumber, $queryArray));
                }
            } else {
                return Redirect::back()->withErrors(['error', 'Sorry record not found']);
            }
        } catch ( \Exception $e) {

            return Redirect::back()->withErrors(['error', 'Sorry Record not found.']);
        }

        //return view('frontend.vehicle.detail');
    }
    /**
     * Make Request
     */
    protected function makeRequest($queryArray){

        try{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($queryArray ));

            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers());

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new \Exception('Error: ' . curl_error($ch));
            }

            curl_close($ch);
            return $result ;

        }catch(\Exception $e){
            Log::error($e->getMessage(), ['error' => $e]);
            Session::flash('err_message', 'OOPs! We cannot provide you with what you want now. Please, try again later or contact us if error persists.');
            Session::flash('alert-class', 'alert-danger');
            return [];
        }
    }

    /**
     * Headers
     */
    protected function headers(){
        return [
            'Accept: application/json',
            'X-API-KEY: ' . $this->key,
            'Content-Type: application/json',
            'X-Correlation-Id: string',
        ];
    }

    public function getSpareParts($id) {
        try {
            $make = Make::whereHas('spareParts')->with(['spareParts'])->whereId($id)->first();
            $spare_parts = $make->spareParts;
            return view('frontend.sparepart.spare_parts', compact('spare_parts'));
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sparePartsDetail($id) {
        try {

            $spare_part = SparePart::whereId($id)->first();
            if ($spare_part) {
                $suggestion = SparePart::whereCarId($spare_part->car_id)->take(3)->get();

                return view('frontend.sparepart.detail', compact('spare_part','suggestion'));
            } else {
                return Redirect::back()->withErrors([ 'Sorry Record not found.']);
            }
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function purchase(Request $request) {
        try {
            $product = SparePart::find($request->id);
            if ($product) {
                $data = [
                    'user_id' => Auth::user()->id,
                    'spare_part_id' => $product->id,
                    'status' => 'pending',
                    "quantity" => $request->quantity,
                    "price" => $product->price,
                    "supplier_id" => $request->supplier_id,
                ];
                Sale::create($data);
                return response()->json(['message' => 'Product added successfully']);
            } else {
                return response()->json(['error' => 'Record not found']);
            }
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart($id) {
        try {
            $product = SparePart::find($id);
            if ($product) {
                $cart = session()->get('cart');
                // if cart is empty then this the first product
                if(!$cart) {
                    $cart = [
                        $id => [
                            "title" => $product->title,
                            "product_id" => $product->id,
                            "quantity" => 1,
                            "price" => $product->price,
                            "image" => $product->image
                        ]
                    ];
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Product added to cart successfully!');
                }
                // if cart not empty then check if this product exist then increment quantity
                if(isset($cart[$id])) {
                    $cart[$id]['quantity']++;
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Product added to cart successfully!');
                }
                // if item not exist in cart then add to cart with quantity = 1
                $cart[$id] = [
                    "product_id" => $product->id,
                    "title" => $product->title,
                    "quantity" => 1,
                    "price" => $product->price,
                    "image" => $product->image
                ];
                session()->put('cart', $cart);

                return redirect()->back()->with('success', 'Product added to cart successfully!');
            } else {
                return Redirect::back()->withErrors([ 'Sorry Record not found.']);
            }
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cartItems() {
        try {
            $cart = session()->get('cart');
            if ($cart) {
                return view('frontend.customer.cart_items', compact('cart'));
            } else {
                return Redirect::back()->withErrors([ 'Sorry Record not found.']);
                //return view('frontend.customer.cart_items');
            }
        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'nullable',
            'email' => 'required|unique:users,email,'. $id,
            'phone' => 'nullable',
        ]);

        $user = User::find($id);
        DB::beginTransaction();
        if ($user){
            $data = [
                'first_name' => !empty($request->first_name) ? $request->first_name : $user->first_name,
                'last_name' => !empty($request->last_name) ? $request->last_name : $user->last_name,
                'email' => !empty($request->email) ? $request->email : $user->email,
                'phone' => $request->phone,
            ];
            if(!empty($request->password)) {
                $data['password'] = bycrpt($request->password);
            }
            $user->update($data);
            DB::commit();
            return redirect(route('profile.index', $user->id))->with('success', 'Record has been updated.');
        }
        return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        /*} catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['error', 'Sorry Record not inserted.']);
        }*/
    }

    function profile($id) {
        $data = User::whereId($id)->first();
        return view('profile', compact('data'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findParts() {

        try {
            $make = Make::whereStatus('publish')->withoutTrashed()->get();
            $model = CarModel::whereStatus('publish')->whereNull('deleted_at')->get();

            return view('frontend.vehicle.find-a-part', compact('make','model'));

        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function partsSearch(Request $request) {


        try {
            $car = Car::orderBy('id','desc');
            if ($request->make) {
                $car = $car->where('make_id',$request->make);
            }
            if ($request->model) {
                $car = $car->where('car_model_id',$request->model);
            }
            if ($request->year) {
                $car = $car->where('year', 'like', '%' . $request->year . '%');
            }
            if ($request->body2) {
                $car = $car->where('body', 'like', '%' . $request->body2 . '%');
            }
            if ($request->engine2) {
                $car = $car->where('engine', 'like', '%' . $request->engine2 . '%');
            }
            if ($request->Fuel2) {
                $car = $car->where('fuel', 'like', '%' . $request->Fuel2 . '%');
            }
            if ($request->trim2) {
                $car = $car->where('trim', 'like', '%' . $request->trim2 . '%');
            }
            if ($request->gearbox2) {
                $car = $car->where('gearbox', 'like', '%' . $request->gearbox2 . '%');
            }
            $car_ids = $car->orderBy('id','desc')->pluck('id');
            $data = $car->orderBy('id','desc')->first()->toArray();
            //dd($data);
            if ($car_ids){
                $spare_parts = SparePart::whereStatus('publish')->whereIn('id',$car_ids)->get();
                //return view('frontend.sparepart.spare_parts', compact('spare_parts'));
                return view('frontend.vehicle.detail',compact('data','spare_parts'));
            } else {
                return Redirect::back()->withErrors([ 'No record found.']);
            }

        } catch ( \Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors([ 'Sorry Record not inserted.']);
        }
    }
    public function PartTypes()
    {

        try {
            DB::beginTransaction();
            $userprofile = SparePartTypes::whereSparePartId(\request('id'))->get();
            if ($userprofile) {
                DB::commit();
                return $this->apiResponse(JsonResponse::HTTP_OK, 'data', $userprofile);
            } else {
                return $this->apiResponse(JsonResponse::HTTP_NOT_FOUND, 'message', 'User profile not found');
            }

        } catch ( \Exception $e) {
            DB::rollBack();
            return $this->apiResponse(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, 'message', $e->getMessage());
        }
    }
}
