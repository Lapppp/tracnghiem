<?php

namespace App\Http\Controllers\Frontend\Contact;

use App\Enums\Modules\ModuleType;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\FrontendController;
use App\Http\Requests\Frontend\Contact\ReceiveContactRequest;
use App\Http\Requests\Frontend\Contact\StoreContactRequest;
use App\Repositories\Advises\AdviseRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Support\SupportRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ContactController extends FrontendController
{

    protected $data = [];
    protected $supportRepository,$adviseRepository;
    public function __construct(
        SupportRepository $supportRepository,
        AdviseRepository $adviseRepository
    )
    {
        parent::__construct();
        $this->supportRepository = $supportRepository;
        $this->adviseRepository = $adviseRepository;
    }


    public function index( Request $request )
    {
        $this->data['contact'] = $this->supportRepository->getById(1);
        View::share('title', 'Giới thiệu về KenJi');
        View::share('description', 'Ghế massage KENJI – K8 tự hào là sản phẩm chất lượng được đài truyền hình VTC6 lựa chọn đưa tin trong mục cẩm nang sức khỏe.');
        View::share('keywords', 'Ghế massage KENJI');
        View::share('author', 'KenJi');

        return view('components.frontend.contact.index',$this->data);
    }

    public function store( StoreContactRequest $request ) {

        $firstname = $request->firstname ?? '';
        $lastname = $request->lastname ?? '';
        $full_name = $firstname.' '.$lastname;
        $insert = [
            'full_name'=>$full_name,
            'phone'=>$request->phone ?? '',
            'description'=>$request->message ?? '',
            'email'=>$request->email ?? '',
        ];
        $this->adviseRepository->create($insert);

    }

    /**
     * @param  ReceiveContactRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function receive( ReceiveContactRequest $request): \Illuminate\Http\JsonResponse
    {

        $insert = [
            'description'=>'Khách hàng yêu cầu đăng ký bài kiểm tra',
            'email'=>$request->email ?? '',
        ];
        $this->adviseRepository->create($insert);

       return ResponseHelper::success('Thành công');

    }
}
