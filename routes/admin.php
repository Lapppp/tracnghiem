<?php

use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:backend')->group(function () {
//    //Route::get('/', [HomeController::class, 'index'])->name('dashboard');
//});


Route::prefix('adminkiwi')->group(function () {

    Route::group(['middleware' => 'backend'], function () {
        Route::get('/', [\App\Http\Controllers\Backend\Dashboard\DashboardController::class, 'index'])->name('backend.dashboard.index');

        //Auth
        Route::prefix('auth')->group(function () {
            Route::get('/logout', [\App\Http\Controllers\Auth\BackendLoginController::class, 'logout'])->name('backend.auth.logout');
        });

        // Users
        Route::prefix('users')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\User\UserController::class, 'index'])->name('backend.users.index');
            Route::get('/deactivated', [\App\Http\Controllers\Backend\User\UserController::class, 'deactivated'])->name('backend.deactivated.index');
            Route::get('/test', [\App\Http\Controllers\Backend\User\UserController::class, 'test'])->name('backend.test.userxx.index');
            Route::get('/test-export', [\App\Http\Controllers\Backend\User\UserController::class, 'exportTest'])->name('backend.user.exportTest.index');
            Route::get('/locked', [\App\Http\Controllers\Backend\User\UserController::class, 'locked'])->name('backend.locked.index');
            Route::get('/export', [\App\Http\Controllers\Backend\User\UserController::class, 'export'])->name('backend.users.export');
            Route::get('/search', [\App\Http\Controllers\Backend\User\UserController::class, 'search'])->name('backend.users.search');
            Route::post('/ajax', [\App\Http\Controllers\Backend\User\UserController::class, 'ajaxLoadApprovedUsers'])->name('backend.users.ajax');
            Route::post('/update-ajax', [\App\Http\Controllers\Backend\User\UserController::class, 'updateAdminDepartment'])->name('backend.users.update-ajax');
            Route::get('/create', [\App\Http\Controllers\Backend\User\UserController::class, 'create'])->name('backend.users.create');
            Route::get('import', [\App\Http\Controllers\Backend\User\UserController::class, 'import'])->name('backend.users.import');
            Route::post('insertImport', [\App\Http\Controllers\Backend\User\UserController::class, 'insertImport'])->name('backend.users.insertImport');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'edit'])->name('backend.users.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'update'])->name('backend.users.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'destroy'])->name('backend.users.destroy');
            Route::post('/updateVip/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'updateVip'])->name('backend.users.updateVip');
            Route::delete('/active/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'active'])->name('backend.users.active');
            Route::delete('/lockedAccount/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'lockedAccount'])->name('backend.users.lockedAccount');
            Route::post('/ajaxLoadPreviewWebsite/{id}', [\App\Http\Controllers\Backend\User\UserController::class, 'ajaxLoadPreviewWebsite'])->name('backend.users.ajaxLoadPreviewWebsite');
            Route::post('/store', [\App\Http\Controllers\Backend\User\UserController::class, 'store'])->name('backend.users.store');
            Route::post('/showTest', [\App\Http\Controllers\Backend\User\UserController::class, 'showTest'])->name('backend.users.showTest');
        });

        // Admin
        Route::prefix('admin')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'index'])->name('backend.admin.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'create'])->name('backend.admin.create');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'edit'])->name('backend.admin.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'update'])->name('backend.admin.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'destroy'])->name('backend.destroy.update');
            Route::post('/store', [\App\Http\Controllers\Backend\Admin\AdminController::class, 'store'])->name('backend.admin.store');
        });

        // Role
        Route::prefix('role')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Role\RoleController::class, 'index'])->name('backend.role.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Role\RoleController::class, 'create'])->name('backend.role.create');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Role\RoleController::class, 'edit'])->name('backend.role.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Role\RoleController::class, 'update'])->name('backend.role.update');
            Route::post('/store', [\App\Http\Controllers\Backend\Role\RoleController::class, 'store'])->name('backend.role.store');
        });

        // Customer Role
        Route::prefix('customer-role')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Role\CustomerRoleController::class, 'index'])->name('backend.customer_role.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Role\CustomerRoleController::class, 'create'])->name('backend.customer_role.create');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Role\CustomerRoleController::class, 'edit'])->name('backend.customer_role.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Role\CustomerRoleController::class, 'update'])->name('backend.customer_role.update');
            Route::post('/store', [\App\Http\Controllers\Backend\Role\CustomerRoleController::class, 'store'])->name('backend.customer_role.store');
        });

        // Category
        Route::prefix('category')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Category\CategoryController::class, 'index'])->name('backend.category.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Category\CategoryController::class, 'create'])->name('backend.category.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Category\CategoryController::class, 'store'])->name('backend.category.store');
        });


        // News
        Route::prefix('news')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Post\NewsController::class, 'index'])->name('backend.news.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Post\NewsController::class, 'create'])->name('backend.news.create');
            Route::get('/category', [\App\Http\Controllers\Backend\Post\NewsController::class, 'category'])->name('backend.news.category');
            Route::get('/category/create', [\App\Http\Controllers\Backend\Post\NewsController::class, 'createCategory'])->name('backend.news.category.create');
            Route::get('/category/edit/{id}', [\App\Http\Controllers\Backend\Post\NewsController::class, 'editCategory'])->name('backend.news.category.edit');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Post\NewsController::class, 'edit'])->name('backend.news.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Post\NewsController::class, 'update'])->name('backend.news.update');
            Route::put('/category/update/{id}', [\App\Http\Controllers\Backend\Post\NewsController::class, 'updateCategory'])->name('backend.news.category.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Post\NewsController::class, 'destroy'])->name('backend.news.destroy');
            Route::delete('/category/delete/{id}', [\App\Http\Controllers\Backend\Post\NewsController::class, 'destroyCategory'])->name('backend.news.category.destroy');
            Route::post('/store', [\App\Http\Controllers\Backend\Post\NewsController::class, 'store'])->name('backend.news.store');
            Route::post('category/store', [\App\Http\Controllers\Backend\Post\NewsController::class, 'storeCategory'])->name('backend.news.category.store');
            Route::post('updateImageDefault', [\App\Http\Controllers\Backend\Post\NewsController::class, 'updateImageDefault'])->name('backend.news.updateImageDefault');
        });

        // News
        Route::prefix('questions')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'index'])->name('backend.questions.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'create'])->name('backend.questions.create');
            Route::get('/createEnglish', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'createEnglish'])->name('backend.questions.createEnglish');
            Route::get('/category', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'category'])->name('backend.questions.category');
            Route::get('/import', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'import'])->name('backend.questions.import');
            Route::get('/category/create', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'createCategory'])->name('backend.questions.category.create');
            Route::get('/category/edit/{id}', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'editCategory'])->name('backend.questions.category.edit');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'edit'])->name('backend.questions.edit');
            Route::get('/editEnglish/{id}', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'editEnglish'])->name('backend.questions.editEnglish');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'update'])->name('backend.questions.update');
            Route::put('/updateCreateEnglish/{id}', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'updateCreateEnglish'])->name('backend.questions.updateCreateEnglish');
            Route::put('/category/update/{id}', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'updateCategory'])->name('backend.questions.category.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'destroy'])->name('backend.questions.destroy');
            Route::delete('/deleteAnswer/{id}', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'destroyAnswer'])->name('backend.questions.destroyAnswer');
            Route::delete('/category/delete/{id}', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'destroyCategory'])->name('backend.questions.category.destroy');
            Route::post('/store', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'store'])->name('backend.questions.store');
            Route::post('category/store', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'storeCategory'])->name('backend.questions.category.store');
            Route::post('updateImageDefault', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'updateImageDefault'])->name('backend.questions.updateImageDefault');
            Route::post('storeAnswer', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'storeAnswer'])->name('backend.questions.storeAnswer');
            Route::post('insertImport', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'insertImport'])->name('backend.questions.insertImport');
            Route::post('storeCreateEnglish', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'storeCreateEnglish'])->name('backend.questions.storeCreateEnglish');
            Route::post('addQuestionEnglish', [\App\Http\Controllers\Backend\Quiz\QuestionsController::class, 'addQuestionEnglish'])->name('backend.questions.addQuestionEnglish');
        });


        // Research
        Route::prefix('research')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'index'])->name('backend.research.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'create'])->name('backend.research.create');
            Route::get('/category', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'category'])->name('backend.research.category');
            Route::get('/category/create', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'createCategory'])->name('backend.research.category.create');
            Route::get('/category/edit/{id}', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'editCategory'])->name('backend.research.category.edit');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'edit'])->name('backend.research.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'update'])->name('backend.research.update');
            Route::put('/category/update/{id}', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'updateCategory'])->name('backend.research.category.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'destroy'])->name('backend.research.destroy');
            Route::delete('/category/delete/{id}', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'destroyCategory'])->name('backend.research.category.destroy');
            Route::post('/store', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'store'])->name('backend.research.store');
            Route::post('category/store', [\App\Http\Controllers\Backend\Post\ResearchController::class, 'storeCategory'])->name('backend.research.category.store');
        });


        // Guide
        Route::prefix('guide')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Post\GuideController::class, 'index'])->name('backend.guide.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Post\GuideController::class, 'create'])->name('backend.guide.create');
            Route::get('/category', [\App\Http\Controllers\Backend\Post\GuideController::class, 'category'])->name('backend.guide.category');
            Route::get('/category/create', [\App\Http\Controllers\Backend\Post\GuideController::class, 'createCategory'])->name('backend.guide.category.create');
            Route::get('/category/edit/{id}', [\App\Http\Controllers\Backend\Post\GuideController::class, 'editCategory'])->name('backend.guide.category.edit');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Post\GuideController::class, 'edit'])->name('backend.guide.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Post\GuideController::class, 'update'])->name('backend.guide.update');
            Route::put('/category/update/{id}', [\App\Http\Controllers\Backend\Post\GuideController::class, 'updateCategory'])->name('backend.guide.category.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Post\GuideController::class, 'destroy'])->name('backend.guide.destroy');
            Route::delete('/category/delete/{id}', [\App\Http\Controllers\Backend\Post\GuideController::class, 'destroyCategory'])->name('backend.guide.category.destroy');
            Route::post('/store', [\App\Http\Controllers\Backend\Post\GuideController::class, 'store'])->name('backend.guide.store');
            Route::post('category/store', [\App\Http\Controllers\Backend\Post\GuideController::class, 'storeCategory'])->name('backend.guide.category.store');
        });


        // Terms
        Route::prefix('terms')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Post\TermsController::class, 'index'])->name('backend.terms.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Post\TermsController::class, 'create'])->name('backend.terms.create');
            Route::get('/category', [\App\Http\Controllers\Backend\Post\TermsController::class, 'category'])->name('backend.terms.category');
            Route::get('/category/create', [\App\Http\Controllers\Backend\Post\TermsController::class, 'createCategory'])->name('backend.terms.category.create');
            Route::get('/category/edit/{id}', [\App\Http\Controllers\Backend\Post\TermsController::class, 'editCategory'])->name('backend.terms.category.edit');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Post\TermsController::class, 'edit'])->name('backend.terms.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Post\TermsController::class, 'update'])->name('backend.terms.update');
            Route::put('/category/update/{id}', [\App\Http\Controllers\Backend\Post\TermsController::class, 'updateCategory'])->name('backend.terms.category.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Post\TermsController::class, 'destroy'])->name('backend.terms.destroy');
            Route::delete('/category/delete/{id}', [\App\Http\Controllers\Backend\Post\TermsController::class, 'destroyCategory'])->name('backend.terms.category.destroy');
            Route::post('/store', [\App\Http\Controllers\Backend\Post\TermsController::class, 'store'])->name('backend.terms.store');
            Route::post('category/store', [\App\Http\Controllers\Backend\Post\TermsController::class, 'storeCategory'])->name('backend.terms.category.store');
        });


        // News
        Route::prefix('document')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'index'])->name('backend.document.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'create'])->name('backend.document.create');
            Route::get('/category', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'category'])->name('backend.document.category');
            Route::get('/category/create', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'createCategory'])->name('backend.document.category.create');
            Route::get('/category/edit/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'editCategory'])->name('backend.document.category.edit');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'edit'])->name('backend.document.edit');
            Route::any('/show/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'show'])->name('backend.document.show');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'update'])->name('backend.document.update');
            Route::put('/changeStatus/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'changeStatus'])->name('backend.document.changeStatus');
            Route::put('/category/update/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'updateCategory'])->name('backend.document.category.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'destroy'])->name('backend.document.destroy');
            Route::delete('/category/delete/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'destroyCategory'])->name('backend.document.category.destroy');
            Route::post('/store', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'store'])->name('backend.document.store');
            Route::post('category/store', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'storeCategory'])->name('backend.document.category.store');
            Route::get('/download/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'download'])->name('backend.document.download');
            Route::post('/deleteImage/{id}', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'deleteImage'])->name('backend.document.deleteImage');
            Route::post('/uploadImage', [\App\Http\Controllers\Backend\Post\DocumentController::class, 'uploadImage'])->name('backend.document.uploadImage');
        });

        // Banner
        Route::prefix('banner')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Banner\BannerController::class, 'index'])->name('backend.banner.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Banner\BannerController::class, 'create'])->name('backend.banner.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Banner\BannerController::class, 'store'])->name('backend.banner.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Banner\BannerController::class, 'edit'])->name('backend.banner.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Banner\BannerController::class, 'update'])->name('backend.banner.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Banner\BannerController::class, 'destroy'])->name('backend.banner.destroy');
        });


        // Banner
        Route::prefix('bgbanner')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\BGBanner\BGBannerController::class, 'index'])->name('backend.bgbanner.index');
            Route::get('/create', [\App\Http\Controllers\Backend\BGBanner\BGBannerController::class, 'create'])->name('backend.bgbanner.create');
            Route::post('/store', [\App\Http\Controllers\Backend\BGBanner\BGBannerController::class, 'store'])->name('backend.bgbanner.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\BGBanner\BGBannerController::class, 'edit'])->name('backend.bgbanner.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\BGBanner\BGBannerController::class, 'update'])->name('backend.bgbanner.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\BGBanner\BGBannerController::class, 'destroy'])->name('backend.bgbanner.destroy');
        });


        // Department
        Route::prefix('department')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Department\DepartmentController::class, 'index'])->name('backend.department.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Department\DepartmentController::class, 'create'])->name('backend.department.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Department\DepartmentController::class, 'store'])->name('backend.department.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Department\DepartmentController::class, 'edit'])->name('backend.department.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Department\DepartmentController::class, 'update'])->name('backend.department.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Department\DepartmentController::class, 'destroy'])->name('backend.department.destroy');
        });


        // Department
        Route::prefix('region')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Region\RegionController::class, 'index'])->name('backend.region.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Region\RegionController::class, 'create'])->name('backend.region.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Region\RegionController::class, 'store'])->name('backend.region.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Region\RegionController::class, 'edit'])->name('backend.region.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Region\RegionController::class, 'update'])->name('backend.region.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Region\RegionController::class, 'destroy'])->name('backend.region.destroy');
        });


        // News
        Route::prefix('wisdom')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'index'])->name('backend.wisdom.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'create'])->name('backend.wisdom.create');
            Route::get('/category', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'category'])->name('backend.wisdom.category');
            Route::get('/category/create', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'createCategory'])->name('backend.wisdom.category.create');
            Route::get('/category/edit/{id}', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'editCategory'])->name('backend.wisdom.category.edit');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'edit'])->name('backend.wisdom.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'update'])->name('backend.wisdom.update');
            Route::put('/category/update/{id}', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'updateCategory'])->name('backend.wisdom.category.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'destroy'])->name('backend.wisdom.destroy');
            Route::delete('/category/delete/{id}', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'destroyCategory'])->name('backend.wisdom.category.destroy');
            Route::post('/store', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'store'])->name('backend.wisdom.store');
            Route::post('category/store', [\App\Http\Controllers\Backend\Post\WisdomController::class, 'storeCategory'])->name('backend.wisdom.category.store');
        });


        // Brand
        Route::prefix('brand')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Brand\BrandController::class, 'index'])->name('backend.brand.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Brand\BrandController::class, 'create'])->name('backend.brand.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Brand\BrandController::class, 'store'])->name('backend.brand.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Brand\BrandController::class, 'edit'])->name('backend.brand.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Brand\BrandController::class, 'update'])->name('backend.brand.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Brand\BrandController::class, 'destroy'])->name('backend.brand.destroy');
        });

        // Unit
        Route::prefix('unit')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Unit\UnitController::class, 'index'])->name('backend.unit.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Unit\UnitController::class, 'create'])->name('backend.unit.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Unit\UnitController::class, 'store'])->name('backend.unit.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Unit\UnitController::class, 'edit'])->name('backend.unit.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Unit\UnitController::class, 'update'])->name('backend.unit.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Unit\UnitController::class, 'destroy'])->name('backend.unit.destroy');
        });


        // Subject
        Route::prefix('subject')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Subject\SubjectController::class, 'index'])->name('backend.subject.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Subject\SubjectController::class, 'create'])->name('backend.subject.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Subject\SubjectController::class, 'store'])->name('backend.subject.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Subject\SubjectController::class, 'edit'])->name('backend.subject.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Subject\SubjectController::class, 'update'])->name('backend.subject.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Subject\SubjectController::class, 'destroy'])->name('backend.subject.destroy');
        });


        // Product
        Route::prefix('product')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Product\ProductController::class, 'index'])->name('backend.product.index');
            Route::post('/export', [\App\Http\Controllers\Backend\Product\ProductController::class, 'export'])->name('backend.product.export');
            Route::get('/create', [\App\Http\Controllers\Backend\Product\ProductController::class, 'create'])->name('backend.product.create');
            Route::get('/category', [\App\Http\Controllers\Backend\Product\ProductController::class, 'category'])->name('backend.product.category');
            Route::get('/category/create', [\App\Http\Controllers\Backend\Product\ProductController::class, 'createCategory'])->name('backend.product.category.create');
            Route::get('/category/edit/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'editCategory'])->name('backend.product.category.edit');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'edit'])->name('backend.product.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'update'])->name('backend.product.update');
            Route::put('/category/update/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'updateCategory'])->name('backend.product.category.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'destroy'])->name('backend.product.destroy');
            Route::delete('/category/delete/{id}', [\App\Http\Controllers\Backend\Product\ProductController::class, 'destroyCategory'])->name('backend.product.category.destroy');
            Route::post('/store', [\App\Http\Controllers\Backend\Product\ProductController::class, 'store'])->name('backend.product.store');
            Route::post('category/store', [\App\Http\Controllers\Backend\Product\ProductController::class, 'storeCategory'])->name('backend.product.category.store');
            Route::post('updateImageDefault', [\App\Http\Controllers\Backend\Product\ProductController::class, 'updateImageDefault'])->name('backend.product.updateImageDefault');
            Route::post('updateCategoryImageDefault', [\App\Http\Controllers\Backend\Product\ProductController::class, 'updateCategoryImageDefault'])->name('backend.product.updateCategoryImageDefault');
        });


        // Order
        Route::prefix('order')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Order\OrderController::class, 'index'])->name('backend.order.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Order\OrderController::class, 'create'])->name('backend.order.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Order\OrderController::class, 'store'])->name('backend.order.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Order\OrderController::class, 'edit'])->name('backend.order.edit');
            Route::get('/show/{id}', [\App\Http\Controllers\Backend\Order\OrderController::class, 'show'])->name('backend.order.show');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Order\OrderController::class, 'update'])->name('backend.order.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Order\OrderController::class, 'destroy'])->name('backend.order.destroy');
        });


        // Advise
        Route::prefix('advise')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Advise\AdviseController::class, 'index'])->name('backend.advise.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Advise\AdviseController::class, 'create'])->name('backend.advise.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Advise\AdviseController::class, 'store'])->name('backend.advise.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Advise\AdviseController::class, 'edit'])->name('backend.advise.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Advise\AdviseController::class, 'update'])->name('backend.advise.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Advise\AdviseController::class, 'destroy'])->name('backend.advise.destroy');
        });


        // Video
        Route::prefix('video')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Video\VideoController::class, 'index'])->name('backend.video.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Video\VideoController::class, 'create'])->name('backend.video.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Video\VideoController::class, 'store'])->name('backend.video.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Video\VideoController::class, 'edit'])->name('backend.video.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Video\VideoController::class, 'update'])->name('backend.video.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Video\VideoController::class, 'destroy'])->name('backend.video.destroy');
        });


        // ShowRoom
        Route::prefix('showroom')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\ShowRoom\ShowRoomController::class, 'index'])->name('backend.showroom.index');
            Route::get('/create', [\App\Http\Controllers\Backend\ShowRoom\ShowRoomController::class, 'create'])->name('backend.showroom.create');
            Route::get('/districts', [\App\Http\Controllers\Backend\ShowRoom\ShowRoomController::class, 'districts'])->name('backend.showroom.districts');
            Route::post('/store', [\App\Http\Controllers\Backend\ShowRoom\ShowRoomController::class, 'store'])->name('backend.showroom.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\ShowRoom\ShowRoomController::class, 'edit'])->name('backend.showroom.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\ShowRoom\ShowRoomController::class, 'update'])->name('backend.showroom.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\ShowRoom\ShowRoomController::class, 'destroy'])->name('backend.showroom.destroy');
        });

        // Questions
        Route::prefix('question')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Question\QuestionController::class, 'index'])->name('backend.question.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Question\QuestionController::class, 'create'])->name('backend.question.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Question\QuestionController::class, 'store'])->name('backend.question.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Question\QuestionController::class, 'edit'])->name('backend.question.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Question\QuestionController::class, 'update'])->name('backend.question.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Question\QuestionController::class, 'destroy'])->name('backend.question.destroy');
        });


        // Company
        Route::prefix('company')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Company\CompanyController::class, 'index'])->name('backend.company.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Company\CompanyController::class, 'create'])->name('backend.company.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Company\CompanyController::class, 'store'])->name('backend.company.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Company\CompanyController::class, 'edit'])->name('backend.company.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Company\CompanyController::class, 'update'])->name('backend.company.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Company\CompanyController::class, 'destroy'])->name('backend.company.destroy');
        });


        // Support
        Route::prefix('support')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Support\SupportController::class, 'index'])->name('backend.support.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Support\SupportController::class, 'create'])->name('backend.support.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Support\SupportController::class, 'store'])->name('backend.support.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Support\SupportController::class, 'edit'])->name('backend.support.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Support\SupportController::class, 'update'])->name('backend.support.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Support\SupportController::class, 'destroy'])->name('backend.support.destroy');
        });


        // Video
        Route::prefix('images')->group(function () {
            Route::delete('/destroy/{id}', [\App\Http\Controllers\Backend\Images\ImageController::class, 'destroy'])->name('backend.images.destroy');
        });

        // Comment
        Route::prefix('comments')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Comment\CommentController::class, 'index'])->name('backend.comments.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Comment\CommentController::class, 'create'])->name('backend.comments.create');
            Route::post('/store', [\App\Http\Controllers\Backend\Comment\CommentController::class, 'store'])->name('backend.comments.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Comment\CommentController::class, 'edit'])->name('backend.comments.edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Comment\CommentController::class, 'update'])->name('backend.comments.update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Comment\CommentController::class, 'destroy'])->name('backend.comments.destroy');
        });


        // Test
        Route::prefix('test')->group(function () {
            Route::get('/', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'index'])->name('backend.test.index');
            Route::get('/create', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'create'])->name('backend.test.create');
            Route::post('/createPart', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'createPart'])->name('backend.test.createPart');
            Route::post('/updatePart', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'updatePart'])->name('backend.test.updatePart');
            Route::post('/addQuestionPart', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'addQuestionPart'])->name('backend.test.addQuestionPart');
            Route::get('/createEnglish', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'createEnglish'])->name('backend.test.createEnglish');
            Route::post('/search-question', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'searchQuestion'])->name('backend.test.search.question');
            Route::post('/load-question', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'loadQuestion'])->name('backend.test.load.question');
            Route::post('/store', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'store'])->name('backend.test.store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'edit'])->name('backend.test.edit');
            Route::get('/editEnglish/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'editEnglish'])->name('backend.test.editEnglish');
            Route::get('/next/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'next'])->name('backend.test.next');
            Route::get('/question/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'question'])->name('backend.test.question');
            Route::post('/updateSortQuestion/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'updateSortQuestion'])->name('backend.test.updateSortQuestion');
            Route::put('/update/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'update'])->name('backend.test.update');

            Route::put('/updateEnglish/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'updateEnglish'])->name('backend.test.updateEnglish');
            Route::post('/updateQuestionPart/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'updateQuestionPart'])->name('backend.test.updateQuestionPart');
            Route::post('/duplicate/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'duplicate'])->name('backend.test.duplicate');
            Route::post('/duplicateEnglish/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'duplicateEnglish'])->name('backend.test.duplicateEnglish');
            Route::post('/updateText/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'updateText'])->name('backend.test.updateText');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Backend\Quiz\TestsController::class, 'destroy'])->name('backend.test.destroy');
        });
    });
});



//Route::get('/{slug}', [\App\Http\Controllers\Frontend\Products\ProductController::class, 'show'])->middleware('minHTML')
//    ->name('frontend.product.edit')
//    ->where(['name' => '[A-Za-z\d\-\_.]+']);
