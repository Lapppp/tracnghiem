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
use App\Repositories\Quiz\TestRepository;
use App\Repositories\ShowRooms\ShowRoomRepository;
use App\Repositories\Videos\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class HomeController extends FrontendController
{
    private $data = [];
    protected $postRepository,
        $bannerRepository,$videoRepository,$categoryRepository,
        $questionRepository,$showRoomRepository,$provinceRepository,
        $productRepository,$adviseRepository,$testRepository;
    public function __construct(
        PostRepository $postRepository,
        BannerRepository $bannerRepository,
        VideoRepository $videoRepository,
        CategoryRepository $categoryRepository,
        QuestionRepository $questionRepository,
        ShowRoomRepository $showRoomRepository,
        ProvinceRepository $provinceRepository,
        ProductRepository $productRepository,
        AdviseRepository $adviseRepository,
        TestRepository $testRepository
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
        $this->testRepository = $testRepository;
    }

    public function  index(Request $request) {

        $this->data['banners'] = $this->bannerRepository->getAll(['status'=>[1]],3);
        $aFeatured = [
            'module_id'=>[ModuleType::Quiz],
            'position'=>[2],
            'status'=>[1]
        ];

        $aTrending = [
            'module_id'=>[ModuleType::Quiz],
            'position'=>[3],
            'status'=>[1]
        ];

        $aNewarrival = [
            'module_id'=>[ModuleType::Quiz],
            'position'=>[1],
            'status'=>[1]
        ];

        $this->data['news'] = $this->postRepository->getAll(['module_id'=>[ModuleType::News],'status'=>[1]],16);
        $this->data['featured'] = $this->testRepository->getAll($aFeatured,25);
        $this->data['trending'] = $this->testRepository->getAll($aTrending,25);
        $this->data['newarrival'] = $this->testRepository->getAll($aNewarrival,25);
        return view('components.frontend.home.tests.index',$this->data);
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
