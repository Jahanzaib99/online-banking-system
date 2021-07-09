<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MakeController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\SparePartsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BreakerController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeneficiaryController;
use Twilio\Rest\Client;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('supplier/join', [SupplierController::class, 'join'])->name('supplier.join');
Route::post('supplier/join', [SupplierController::class, 'register'])->name('supplier.register');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('about-us', [App\Http\Controllers\HomeController::class, 'aboutUs'])->name('about');
Route::get('contact-us', [App\Http\Controllers\HomeController::class, 'contactUs'])->name('contact');
Route::get('/vehicel/detai/{reg_number}', [App\Http\Controllers\HomeController::class, 'vehicleDetail'])->name('vehicle.detail');
Route::post('/find/model', [App\Http\Controllers\HomeController::class, 'findModel'])->name('find.model');
Route::get('/find/car/spareparts', [App\Http\Controllers\HomeController::class, 'getCarSpareParts'])->name('find.model.spareparts');
Route::get('find-a-part', [App\Http\Controllers\HomeController::class, 'findParts'])->name('find.parts');
Route::get('parts/search', [App\Http\Controllers\HomeController::class, 'partsSearch'])->name('partsfilter');
Route::get('car/spareparts/{make_id}', [\App\Http\Controllers\HomeController::class, 'getSpareParts']);
Route::get('spareparts/detail/{id}', [\App\Http\Controllers\HomeController::class, 'sparePartsDetail'])->name('product.detail');
Route::get('add-to-cart/{id}', [\App\Http\Controllers\HomeController::class, 'addToCart'])->name('add.to.cart');
Route::post('purchase/', [\App\Http\Controllers\HomeController::class, 'purchase'])->name('purchase');
Route::get('cart/items', [\App\Http\Controllers\HomeController::class, 'cartItems'])->name('cart.items');
Route::get('parts/type', [\App\Http\Controllers\HomeController::class, 'PartTypes'])->name('parts.type');

Auth::routes();
Route::group(['middleware' => ['auth', 'supplier'], 'prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.home');
    Route::get('order', [SupplierController::class, 'order'])->name('supplier.order');
    Route::get('send/offer/{id}', [SupplierController::class, 'sendOffer'])->name('send.offer');
    Route::get('offers', [SupplierController::class, 'allOffers'])->name('offer.list');
    Route::post('send/offer/{id}', [SupplierController::class, 'sendOfferStore'])->name('send.offer.store');
});
Route::get('profile/{user_id}', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile.index');
Route::put('profile/update/{user_id}', [\App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.home');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user');
        Route::get('delete/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        Route::post('update', [UserController::class, 'update'])->name('admin.user.update');
        Route::post('register', [UserController::class, 'register'])->name('user.register');
        Route::post('transaction', [UserController::class, 'transfer'])->name('admin.user.transaction');
    });
});
Route::group(['prefix' => 'beneficiary', 'middleware' => 'auth'], function () {
    Route::get('/', [BeneficiaryController::class, 'index'])->name('beneficiary.show');
    Route::get('delete/{id}', [BeneficiaryController::class, 'destroy'])->name('beneficiary.destroy');
    Route::post('update', [BeneficiaryController::class, 'update'])->name('beneficiary.update');
    Route::post('transaction', [BeneficiaryController::class, 'transfer'])->name('beneficiary.transaction');
});
Route::group(['middleware' => ['auth'],'prefix' => 'user'], function () {

    Route::get('/', [CustomerController::class, 'index'])->name('user.home');
    Route::group(['prefix' => 'beneficiary'], function () {
       Route::get('/', [BeneficiaryController::class, 'index'])->name('beneficiary.index');
       Route::post('store', [BeneficiaryController::class, 'store'])->name('beneficiary.store');
       Route::post('update', [BeneficiaryController::class, 'update'])->name('beneficiary.update');
       Route::get('delete', [BeneficiaryController::class, 'index'])->name('beneficiary.destroy');
    });
});

Route::get('send-mail', function () {
    $data = [];
    \Illuminate\Support\Facades\Mail::send('email.message', $data, function($message) use ($data) {
        $message->to('jk@gmail.com', '')->subject
        ("Testing email by Spareparts");
        $message->from('admin@admin.com','Spareparts');
    });
});

Route::get('send-twilio-sms', function () {

    $account_sid = config("app.TWILIO_ACCOUNT_SID");
    $auth_token = config("app.TWILIO_AUTH_TOKEN");
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
//    $twilio_number = "+15017122661";

    $client = new Client($account_sid, $auth_token);

    $client->messages->create(
    // Where to send a text message (your cell phone?)
        '+923002656488',
        array(
            'from' => '+18508765040',
            'body' => 'I sent this message in under 10 minutes!'
        )
    );
//    $sid = config("app.TWILIO_ACCOUNT_SID");
//    $token = config("app.TWILIO_AUTH_TOKEN");
//    $twilio = new Client($sid, $token);
//
//    $message = $twilio->messages
//        ->create("+923002656488", // to
//            ["body" => "Hi there!", "from" => "+18508765040"]
//        );
//
//    print($message->sid);
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
