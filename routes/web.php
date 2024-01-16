<?php

use App\Http\Controllers\Frontend\Posts\NewsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::any('/', [\App\Http\Controllers\Frontend\Home\HomeController::class, 'index'])->name('frontend.home.index');

//Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//    ->name('ckfinder_connector');
//
//Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//    ->name('ckfinder_browser');

Route::any('test', [\App\Http\Controllers\Frontend\Test\TestController::class, 'index'])->name('frontend.test.index');
Route::any('login', [\App\Http\Controllers\Auth\FrontendLoginController::class, 'login'])->name('frontend.auth.login');
Route::any('forgot-password', [\App\Http\Controllers\Frontend\User\UserController::class, 'forgotPassword'])->name('frontend.auth.forgotPassword');
Route::any('account.html', [\App\Http\Controllers\Frontend\User\UserController::class, 'index'])->name('frontend.users.index');
Route::post('storeForgotPassword', [\App\Http\Controllers\Frontend\User\UserController::class, 'storeForgotPassword'])->name('frontend.auth.storeForgotPassword');
Route::post('storeResetPassword', [\App\Http\Controllers\Frontend\User\UserController::class, 'storeResetPassword'])->name('frontend.auth.storeResetPassword');
Route::any('reset-password', [\App\Http\Controllers\Frontend\User\UserController::class, 'resetPassword'])->name('frontend.auth.resetPassword');
Route::any('facebookLogin', [\App\Http\Controllers\Auth\FacebookLoginController::class, 'redirect'])->name('frontend.auth.facebookLogin');
Route::any('facebookCallback', [\App\Http\Controllers\Auth\FacebookLoginController::class, 'callback'])->name('frontend.auth.facebookCallback');
Route::any('googleLogin', [\App\Http\Controllers\Auth\GoogleLoginController::class, 'redirect'])->name('frontend.auth.googleLogin');
Route::any('googleCallback', [\App\Http\Controllers\Auth\GoogleLoginController::class, 'callback'])->name('frontend.auth.googleCallback');
Route::any('login.html', [\App\Http\Controllers\Auth\FrontendLoginController::class, 'ajaxLogin'])->name('frontend.auth.ajaxLogin');
Route::get('register', [\App\Http\Controllers\Auth\FrontendLoginController::class, 'register'])->name('frontend.auth.register');
Route::get('logout', [\App\Http\Controllers\Auth\FrontendLoginController::class, 'logout'])->name('frontend.user.logout');
Route::post('store', [\App\Http\Controllers\Auth\FrontendLoginController::class, 'store'])->name('frontend.auth.store');

//Route::any('test', [\App\Http\Controllers\Frontend\User\UserController::class, 'index'])->name('frontend.user.index');
Route::any('adminkiwi/login', [\App\Http\Controllers\Auth\BackendLoginController::class, 'login'])->name('backend.admin.login');


Route::any('download', [\App\Http\Controllers\Frontend\Posts\NewsController::class, 'index'])->name('frontend.download.index');

// Tin tức

Route::get('/news', [NewsController::class, 'index'])->name('frontend.news.index');
Route::prefix('tin-tuc')->group(function () {

    Route::get('/danh-muc/{id}-{name}', [NewsController::class, 'category'])
        ->name('frontend.news.category')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/{id}-{name}', [NewsController::class, 'show'])
        ->name('frontend.news.show')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/', [NewsController::class, 'index'])->name('frontend.news.all.index');

});


// Bài kiểm tra

Route::get('/tests', [\App\Http\Controllers\Frontend\Test\TestsController::class, 'index'])->name('frontend.tests.index');
Route::prefix('bai-kiem-tra')->group(function () {


    Route::get('/chuyen-de/{id}-{name}', [\App\Http\Controllers\Frontend\Test\TestsController::class, 'subject'])
        ->name('frontend.tests.chuyende')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/danh-muc/{id}-{name}', [\App\Http\Controllers\Frontend\Test\TestsController::class, 'category'])
        ->name('frontend.tests.category')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/tieng-anh/{id}-{name}', [\App\Http\Controllers\Frontend\Test\TestsController::class, 'showEnglish'])
        ->name('frontend.tests.showEnglish')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/ket-qua-bai-kiem-tra-tieng-anh/{id}-{name}', [\App\Http\Controllers\Frontend\Test\TestsController::class, 'resultEnglish'])
        ->name('frontend.tests.resultEnglish')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::post('/update-bai-kiem-tra-tieng-anh/{id}-{name}', [\App\Http\Controllers\Frontend\Test\TestsController::class, 'updateEnglish'])
        ->name('frontend.tests.updateEnglish')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/{id}-{name}', [\App\Http\Controllers\Frontend\Test\TestsController::class, 'show'])
        ->name('frontend.tests.show')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/', [\App\Http\Controllers\Frontend\Test\TestsController::class, 'index'])->name('frontend.tests.all.index');
    Route::get('/ket-qua/{id}',[\App\Http\Controllers\Frontend\Test\TestsController::class, 'result'])->name('frontend.tests.result');
    Route::post('/{id}',[\App\Http\Controllers\Frontend\Test\TestsController::class, 'store'])->name('frontend.tests.store');
    Route::post('/next/{id}',[\App\Http\Controllers\Frontend\Test\TestsController::class, 'next'])->name('frontend.tests.next');
    Route::post('/previous/{id}',[\App\Http\Controllers\Frontend\Test\TestsController::class, 'previous'])->name('frontend.tests.previous');


});

/*
// Hướng dẫn
Route::get('/huong-dan.html', [\App\Http\Controllers\Frontend\Posts\GuideController::class, 'index'])->name('frontend.guide.index');
Route::prefix('huong-dan')->group(function () {

    Route::get('/danh-muc/{id}-{name}', [\App\Http\Controllers\Frontend\Posts\GuideController::class, 'category'])
        ->name('frontend.guide.category')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/{id}-{name}', [\App\Http\Controllers\Frontend\Posts\GuideController::class, 'show'])
        ->name('frontend.guide.show')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/', [\App\Http\Controllers\Frontend\Posts\GuideController::class, 'index'])->name('frontend.guide.all.index');

});


// Nghiên cứu
Route::get('/mua-ban-trao-doi.html', [\App\Http\Controllers\Frontend\Posts\ReSearchController::class, 'index'])->name('frontend.research.index');
Route::prefix('research')->group(function () {

    Route::get('/danh-muc/{id}-{name}', [\App\Http\Controllers\Frontend\Posts\ReSearchController::class, 'category'])
        ->name('frontend.research.category')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/{id}-{name}', [\App\Http\Controllers\Frontend\Posts\ReSearchController::class, 'show'])
        ->name('frontend.research.show')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/', [\App\Http\Controllers\Frontend\Posts\ReSearchController::class, 'index'])->name('frontend.research.all.index');

});

*/

// Quy định
Route::get('/chinh-sach', [\App\Http\Controllers\Frontend\Posts\TermsController::class, 'index'])->name('frontend.terms.index');
Route::prefix('terms')->group(function () {

    Route::get('/danh-muc/{id}-{name}', [\App\Http\Controllers\Frontend\Posts\TermsController::class, 'category'])
        ->name('frontend.terms.category')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/{id}-{name}', [\App\Http\Controllers\Frontend\Posts\TermsController::class, 'show'])
        ->name('frontend.terms.show')
        ->where(['id'=>'[0-9]+','name'=>'[A-Za-z\d\-\_.]+']);

    Route::get('/', [\App\Http\Controllers\Frontend\Posts\TermsController::class, 'index'])->name('frontend.terms.all.index');

});


Route::prefix('cart')->group(function () {

    Route::get('/', [\App\Http\Controllers\Frontend\Products\CartController::class, 'index'])->name('frontend.cart.index');
    Route::post('/addCart', [\App\Http\Controllers\Frontend\Products\CartController::class, 'addCart'])->name('frontend.cart.addCart');
    Route::post('/destroy', [\App\Http\Controllers\Frontend\Products\CartController::class, 'destroy'])->name('frontend.cart.destroy');
    Route::post('/load', [\App\Http\Controllers\Frontend\Products\CartController::class, 'load'])->name('frontend.cart.load');
    Route::post('/update/{id}', [\App\Http\Controllers\Frontend\Products\CartController::class, 'update'])->name('frontend.update.destroy');
});




Route::prefix('product')->group(function () {

    Route::post('/store', [\App\Http\Controllers\Frontend\Products\ProductController::class, 'store'])->name('frontend.product.store');
    Route::get('/{slug}', [\App\Http\Controllers\Frontend\Products\ProductController::class, 'show'])
        ->name('frontend.product.view')
        ->where(['name' => '[A-Za-z\d\-\_.]+']);
});


Route::prefix('products')->group(function () {
    Route::get('/', [\App\Http\Controllers\Frontend\Products\ProductController::class, 'index'])->name('frontend.products.all.index');
    Route::get('/category/{id}', [\App\Http\Controllers\Frontend\Products\ProductController::class, 'category'])->name('frontend.products.category');

    Route::get('/{slug}', [\App\Http\Controllers\Frontend\Products\ProductController::class, 'categorySubSub'])
        ->name('frontend.products.something')
        ->where(['name' => '[A-Za-z\d\-\_.]+']);
});

Route::prefix('location')->group(function () {

    Route::post('/changeDistrict', [\App\Http\Controllers\Frontend\Locations\DistrictController::class, 'change'])->name('frontend.location.changeDistrict');
    Route::post('/changeShowRoom', [\App\Http\Controllers\Frontend\Home\HomeController::class, 'ajaxShowRoom'])->name('frontend.location.ajaxShowRoom');
    Route::post('/sendAdvise', [\App\Http\Controllers\Frontend\Home\HomeController::class, 'ajaxSendAdvise'])->name('frontend.location.ajaxSendAdvise');
});

Route::prefix('orders')->group(function () {
    Route::post('/store', [\App\Http\Controllers\Frontend\Orders\OrderController::class, 'store'])->name('frontend.orders.store');
    Route::get('/thank-you', [\App\Http\Controllers\Frontend\Orders\OrderController::class, 'show'])->name('frontend.orders.show');
});

Route::prefix('users')->group(function () {
    Route::get('/', [\App\Http\Controllers\Frontend\User\UserController::class, 'index'])->name('frontend.users.index');
    Route::get('/orders', [\App\Http\Controllers\Frontend\User\UserController::class, 'order'])->name('frontend.users.orders');
    Route::get('/favorite', [\App\Http\Controllers\Frontend\User\UserController::class, 'favorite'])->name('frontend.users.favorite');
    Route::get('/favorite', [\App\Http\Controllers\Frontend\User\UserController::class, 'favorite'])->name('frontend.users.favorite');
    Route::post('/update', [\App\Http\Controllers\Frontend\User\UserController::class, 'update'])->name('frontend.users.update');
    Route::post('/addFavorite', [\App\Http\Controllers\Frontend\User\UserController::class, 'addFavorite'])->name('frontend.users.addFavorite');
    Route::post('/removeFavorite', [\App\Http\Controllers\Frontend\User\UserController::class, 'removeFavorite'])->name('frontend.users.removeFavorite');
    Route::get('/change', [\App\Http\Controllers\Frontend\User\UserController::class, 'change'])->name('frontend.users.change');
});


Route::get('/showroom', [\App\Http\Controllers\Frontend\ShowRooms\ShowRoomController::class, 'index'])->name('frontend.showroom.index');
Route::get('/about', [\App\Http\Controllers\Frontend\About\AboutController::class, 'index'])->name('frontend.about.index');
Route::get('/lien-he.html', [\App\Http\Controllers\Frontend\Contact\ContactController::class, 'index'])->name('frontend.contact.index');
Route::get('/contact/store', [\App\Http\Controllers\Frontend\Contact\ContactController::class, 'store'])->name('frontend.contact.store');
Route::post('/contact/receive', [\App\Http\Controllers\Frontend\Contact\ContactController::class, 'receive'])->name('frontend.contact.receive');



Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
});

