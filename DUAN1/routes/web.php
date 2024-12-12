<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminQrController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\search\searchController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\OderController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Client\ClientCategoryController;
use App\Http\Controllers\Client\ProPopulationController;
use App\Http\Controllers\pa\PaymentController;
use App\Http\Controllers\VNPayController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
//route đang ky, login
//route login
Route::get('/login', [AuthController::class, 'ShowFormLogin'])->name('login'); // Hiển thị form đăng nhập
Route::post('/Checklogin', [AuthController::class, 'Login'])->name('loginUser');    // Xử lý đăng nhập

//route đang ký tài khoản user
Route::get('/dang-ky', [AuthController::class, 'ShowFrom_dangky'])->name('dangky');
Route::Post('/dang-ky', [AuthController::class, 'dangky'])->name('dangkyUser');
//route khôi phục mật khẩu
// route nội dung email
//route::get('email',[ForgotPasswordController::class,'resesst'])->name('resesst');

route::post('checkform', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('sendResetLinkEmail');
// route show form khôi phục mật khẩu
route::get('khôi-phuc-mat-khau-moi', [ForgotPasswordController::class, 'ShowFormResetPasswoek'])->name('ShowFormResetPasswoek');
route::post('check-form-khoi-phuc', [ForgotPasswordController::class, 'passwordupdate'])->name('passwordupdate');

route::get('ShowFormForpassWork', [ForgotPasswordController::class, 'ShowFormForpassWork'])->name('khoiphucmatkhau');
// logou tài khaoanr
route::post('logout', [AuthController::class, 'UseLogout'])->name('logout');
//show form thông tin tài khoản
route::get('My-acc', [AuthController::class, 'ShowFormMyAcc'])->middleware('checkLoginForPurchase')->name('ShowFormMyAcc');

// route user

Route::get('/', [UserController::class, 'indexUser'])->name('index');
Route::get('by-category/{id}', [ClientCategoryController::class, 'byCategory'])->name('byCategory');




Route::get('/', [UserController::class, 'indexUser'])->name('index');
// route tìm kiếm
route::get('searchProducts', [searchController::class, 'searchProducts'])->name('searchProducts');
// route trả kết quả tìm kiếm

// route cart

Route::get('list-cart', [CartController::class, 'listCart'])->name('listCart');
Route::post('add-to-cart', [CartController::class, 'addCart'])->name('addCart');
Route::post('update-to-cart', [CartController::class, 'updateCart'])->name('updateCart');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('checkout', [CartController::class, 'checkout'])->middleware('checkLoginForPurchase')->name('checkout');
// route đặt hàng
route::post('dat-hang', [OderController::class, 'process'])->name('dathang');


// thanh toán online

 Route::get('/payment/create/{order_id}', [PaymentController::class, 'createCheckoutSession'])->name('payment.create');
 //route trả về
 Route::get('/payment-success/{orderId}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment-cancel/{orderId}', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
//Route::Post('/payment/create', [VNPayController::class, 'createPayment'])->name('paymentcreate1');

// Route::get('/vnpay-return', [VNPayController::class, 'returnPayment'])->name('returnPayment');
// router xác nhận
Route::post('/order/cancel/{orderId}', [AdminQrController::class, 'cancelOrder'])->name('ordercancel');
Route::post('/order/confirm/{orderId}', [AdminQrController::class, 'confirmPayment'])->name('orderconfirm');







//route admin
Route::middleware(['auth', 'isAdmin'])->prefix('admins')
    ->as('admins.')
    ->group(function () {
        // route trang chủ index
        // Giao diện admin
        //Route người dùng
        Route::resource('users', AdminUserController::class);
        Route::get('statistical', [AdminController::class, 'statistical'])->name('statistical');
        Route::put('My-acc/update-profile', [AdminUserController::class, 'update'])->name('doithongtin');

        // Các route khác cho admin
        Route::prefix('products')
            ->as('products.')
            ->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('create', [ProductController::class, 'create'])->name('create');
                Route::post('store', [ProductController::class, 'store'])->name('store');
                Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [ProductController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
            });



        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::get('create', [CategoryController::class, 'create'])->name('create');
                Route::post('store', [CategoryController::class, 'store'])->name('store');
                Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
                Route::get('category-by-product/{id}', [CategoryController::class, 'categoryByProduct'])->name('categoryByProduct');
            });

        Route::prefix('authors')
            ->as('authors.')
            ->group(function () {
                Route::get('/', [AuthorController::class, 'index'])->name('index');
                Route::get('create', [AuthorController::class, 'create'])->name('create');
                Route::post('store', [AuthorController::class, 'store'])->name('store');
                Route::get('{id}/edit', [AuthorController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [AuthorController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [AuthorController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('publishers')
            ->as('publishers.')
            ->group(function () {
                Route::get('/', [PublisherController::class, 'index'])->name('index');
                Route::get('create', [PublisherController::class, 'create'])->name('create');
                Route::post('store', [PublisherController::class, 'store'])->name('store');
                Route::get('{id}/edit', [PublisherController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [PublisherController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [PublisherController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('banner')
            ->as('banner.')
            ->group(function () {
                Route::get('/', [BannerController::class, 'index'])->name('index');
                Route::get('create', [BannerController::class, 'create'])->name('create');
                Route::post('store', [BannerController::class, 'store'])->name('store');
                Route::get('{id}/edit', [BannerController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [BannerController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [BannerController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('orders')
            ->as('orders.')
            ->group(function () {

                Route::get('/', [OderController::class, 'index'])->name('index');
                Route::get('{id}/edit', [OderController::class, 'edit'])->name('edit');
                Route::put('update/{id}', [OderController::class, 'update'])->name('update');
                Route::delete('destroy/{id}', [OderController::class, 'destroy'])->name('destroy');
                Route::put('My-acc/order-update/{id}', [OderController::class, 'updateForClient'])->name('updateClient');
            });
        Route::prefix('anh')
            ->as('anh.')
            ->group(function () {

                Route::get('/', [AdminQrController::class, 'showlist'])->name('index');
                Route::get('create', [AdminQrController::class, 'them'])->name('create');
                Route::post('createa', [AdminQrController::class, 'store'])->name('store');
                Route::post('/qr-images/toggle/{id}', [AdminQrController::class, 'updateStatus'])->name('toggleVisibility');
                route::get('toggleVisibility/{id}', [AdminQrController::class, 'formedit'])->name('edit');
            });
    });


// route::get('My-acc/doi-mk',function(){
//     return view('client.layouts.partials.change-account');

// });


Route::middleware(['Auth'])->prefix('user')->name('user.')->group(function () {
    Route::prefix('cart')
        ->as('cart.')
        ->group(function () {

        });
});

// Route::view('/checkout','client.layouts.partials.forgot-password');
route::get('product/detail/{id}', [UserController::class, 'detailProduct'])->name('detailProduct');
Route::resource('acc', ProfileController::class);
Route::get('My-acc/doi-mk', [ProfileController::class, 'editPass'])->name('doimatkhau');
Route::put('My-acc/update-pass/{user}', [ProfileController::class, 'updatePass'])->name('update-pass');
Route::get('My-acc/profile', [ProfileController::class, 'profile'])->name('profile');
Route::put('My-acc/update-profile/{user}', [ProfileController::class, 'updateProfile'])->name('update-profile');

Route::get('top-10',[ProPopulationController::class,'index'])->name('productPopulation');

Route::get('/chinhsach', function () {
    return view('client.layouts.partials.chinhsach');
})->name('abc');
