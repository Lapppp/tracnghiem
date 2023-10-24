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


class xFrontendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $_ref,$footerCompany;
    private $modulesControllerAdminRepos;
    protected $user;

    public function __construct()
    {
        $this->_ref = Request()->get('_ref', null);


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

        // Company footer
        $footerCompany = Company::find(1);
        View::share('footerCompany', $footerCompany);

        $title = $footerCompany->meta_title ?? 'KenJi';
        $keywords = $footerCompany->meta_keywords ?? 'Ghế massage KENJI';
        $description = $footerCompany->meta_description ?? 'Ghế massage KENJI – K8 tự hào là sản phẩm chất lượng được đài truyền hình VTC6 lựa chọn đưa tin trong mục cẩm nang sức khỏe.';

        View::share('title', $title);
        View::share('description', $description);
        View::share('keywords', $keywords);
        View::share('author', 'kenjivietnam.vn');
        View::share('imageSeo', '');


        $textCate = $footerCompany->text_cate ?? '';
        View::share('textCate', $textCate);


        $footerSupport = Support::find(1);
        View::share('footerSupport', $footerSupport);

        $bannerPosition = Banner::where('position',1)->where('status',1)->orderBy('id','Desc')->limit(10)->get();
        View::share('bannerPosition', $bannerPosition);

        $bannerPositionTwo = Banner::where('position',2)->where('status',1)->orderBy('id','Desc')->limit(1)->first();
        View::share('bannerPositionTwo', $bannerPositionTwo);


        $bannerPositionThree = Banner::where('position',3)->where('status',1)->orderBy('id','Desc')->limit(1)->first();
        View::share('bannerPositionThree', $bannerPositionThree);

        $footerNews = Post::where('module_id',ModuleType::Terms)->orderBy('id','Desc')->limit(5)->get();
        View::share('footerNews', $footerNews);

        $searchCategory = Category::where('module_id',ModuleType::Product)->where('status','=',1)->get();
        View::share('searchCategory', $searchCategory);


        $menuCategory = Category::where('module_id',ModuleType::Product)->where('category_id','=',0)->get();
        View::share('menuCategory', $menuCategory);


        $showroom = ShowRoom::all();
        View::share('showroom', $showroom);

        $numberShowRoom = ShowRoom::count();
        View::share('numberShowRoom', $numberShowRoom);

        $province = Province::all();
        View::share('province', $province);

        $menuHome =  Category::where('module_id',ModuleType::Product)->whereIn('id', [14,36,39, 40, 41])->orderBy('position','asc')->get();
        View::share('menuHome', $menuHome);

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
