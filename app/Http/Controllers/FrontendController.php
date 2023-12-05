<?php

namespace App\Http\Controllers;

use App\Enums\Modules\ModuleType;
use App\Helpers\MobileDetectHelper;
use App\Models\Banners\Banner;
use App\Models\Category\Category;
use App\Models\Companies\Company;
use App\Models\Post\Post;
use App\Models\Provinces\Province;
use App\Models\ShowRooms\ShowRoom;
use App\Models\Support\Support;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;
//use View;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class FrontendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $_ref,$footerCompany;
    private $modulesControllerAdminRepos;
    protected $user;

    public function __construct()
    {
        $this->_ref = Request()->get('_ref', null);

        $this->category_id = Request()->get('category_id', null);
        $this->search = Request()->get('search', null);
        $route = Route::current();
        $name = Route::currentRouteName();
        $action = Route::currentRouteAction();

        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        View::share('controller', $controller);
        View::share('action', $action);
        View::share('routeCurrentName', $route);
        View::share('routeName', $name);
        View::share('actionName', $action);

        View::share('category_id', $this->category_id);
        View::share('search', $this->search);

        // Company footer
        $footerCompany = Company::find(1);
        View::share('footerCompany', $footerCompany);

        $title = $footerCompany->meta_title ?? 'Kiwi';
        $keywords = $footerCompany->meta_keywords ?? 'Luyện thi công chức';
        $description = $footerCompany->meta_description ?? 'Kiwi - Luyện thi công chức';

        View::share('title', $title);
        View::share('description', $description);
        View::share('keywords', $keywords);
        View::share('author', 'kenjivietnam.vn');
        View::share('imageSeo', '');


        $textCate = $footerCompany->text_cate ?? '';
        View::share('textCate', $textCate);


        $KienThucChung = Category::find(9);
        View::share('KienThucChung', $KienThucChung);

        $MeoThucChung = Category::find(3);
        View::share('MeoThucChung', $MeoThucChung);



        $menuCategory = Category::where('module_id',ModuleType::Quiz)->get();
        View::share('menuCategory', $menuCategory);


        $menuSupport = Support::find(1);
        View::share('menuSupport', $menuSupport);

        $detect = new MobileDetectHelper();
        $isMobile = 0 ;
        if ( $detect->isMobile() ) {
            $isMobile = 1;
        }
        View::share('isMobile', $isMobile);

    }

    public function errors()
    {
        abort(404);
    }
}
