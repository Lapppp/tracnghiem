<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Enums\Modules\ModuleType;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\FrontendController;
use App\Mail\ContactMail;
use App\Repositories\Advises\AdviseRepository;
use App\Repositories\Banners\BannerRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Provinces\ProvinceRepository;
use App\Repositories\Questions\QuestionRepository;
use App\Repositories\ShowRooms\ShowRoomRepository;
use App\Repositories\Videos\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class xHomeController extends FrontendController
{
    private $data = [];
    protected $postRepository,
        $bannerRepository,$videoRepository,$categoryRepository,
        $questionRepository,$showRoomRepository,$provinceRepository,
        $productRepository,$adviseRepository;
    public function __construct(
        PostRepository $postRepository,
        BannerRepository $bannerRepository,
        VideoRepository $videoRepository,
        CategoryRepository $categoryRepository,
        QuestionRepository $questionRepository,
        ShowRoomRepository $showRoomRepository,
        ProvinceRepository $provinceRepository,
        ProductRepository $productRepository,
        AdviseRepository $adviseRepository
    )
    {
        parent::__construct();
        $this->postRepository = $postRepository;
        $this->bannerRepository = $bannerRepository;
        $this->videoRepository = $videoRepository;
        $this->categoryRepository = $categoryRepository;
        $this->questionRepository = $questionRepository;
        $this->showRoomRepository = $showRoomRepository;
        $this->provinceRepository = $provinceRepository;
        $this->productRepository = $productRepository;
        $this->adviseRepository = $adviseRepository;
    }

    public function  index(Request $request) {

        $this->data['about'] = $this->postRepository->getByID(66);
        $this->data['videoHome'] = $this->videoRepository->getAll([],null);
        $this->data['messageCategory'] = $this->categoryRepository->getByID(14);
        $this->data['treadmillCategory'] = $this->categoryRepository->getByID(39);
        $this->data['bikeCategory'] = $this->categoryRepository->getByID(15);
        $this->data['bedCategory'] = $this->categoryRepository->getByID(36);
        $this->data['questions'] = $this->questionRepository->getAll([]);
        $this->data['news'] = $this->postRepository->getAll(['module_id'=>[ModuleType::News],'category_id'=>[9],'status'=>[1]], 3);
        $this->data['activity'] = $this->postRepository->getAll(['module_id'=>[ModuleType::News],'category_id'=>[3],'status'=>[1]], 3);
        $this->data['showroom'] = $this->showRoomRepository->getAll([],3);
        $this->data['numberShowRoom'] = $this->showRoomRepository->getTotal();
        $this->data['province'] = $this->provinceRepository->getAll([],null);
        $this->data['hotProduct'] = $this->productRepository->getAll(['options'=>[2],'status'=>[1]], 9);
        $this->data['otherProduct'] = $this->productRepository->getAll(['category_id'=>[40]], 8);

        $this->data['cookiesProduct'] = [];
        if(Cookie::get('products')){
            $products = Cookie::get('products');
            $ids = json_decode($products,true);
            $this->data['cookiesProduct'] = $this->productRepository->getAll(['ids'=>$ids], 9);
        }

        return view('components.frontend.home.index',$this->data);
    }

    public function ajaxShowRoom(Request $request) {
        $params = [
            'district_id'=>$request->district_id ?? 0,
            'province_id'=>$request->province_id ?? 0,
        ];
        $searchShowRoom = $this->showRoomRepository->getAll($params);
        $html = view('components.frontend.home.ajax.ajaxShowRoom',['searchShowRoom'=>$searchShowRoom])->render();
        return ResponseHelper::success('Thành công',['dataHtml'=>$html,'totalShowRoom'=>count($searchShowRoom)]);
    }

    public function ajaxSendAdvise(Request $request) {
        $params = $request->all();

        $customer_name = $request->full_name ?? '';
        $details = [
            'title' =>'Khách hàng '.$customer_name.' muốn tư vấn về các sản phẩm',
            'customer_name' =>$customer_name,
            'phone' =>$request->phone ?? '',
            'description' =>$request->description ?? '',
        ];
        $email = env('MAIL_FROM_ADDRESS');
        Mail::to($email)->send(new ContactMail($details));
        $advise = $this->adviseRepository->create($params);
        return ResponseHelper::success('Thành công',$advise);
    }

}
