<?php

namespace App\Http\Controllers\Frontend\ShowRooms;

use App\Http\Controllers\FrontendController;
use App\Repositories\ShowRooms\ShowRoomRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ShowRoomController extends FrontendController
{

    protected $data = [];
    protected $showRoomRepository;
    public function __construct(ShowRoomRepository $showRoomRepository)
    {
        parent::__construct();
        $this->showRoomRepository = $showRoomRepository;
    }

    public function index( Request $request ) {

        $this->data['provinceHoChiMinh'] = $this->showRoomRepository->getAll(['province_id'=>79]);
        $this->data['provinceHaNoi'] = $this->showRoomRepository->getAll(['province_id'=>1]);
        $mienbac = [1,10,15,11,17,12,14,2,4,6,20,8,19,25,24,22,27,35,30,31,33,36,37,34,26];
        $mientrung = [38,40,42,44,45,46,62,64,66,67,68,48,49,51,52,54,56,58,60];
        $miennam = [79,70,74,75,72,77,80,87,82,89,83,86,84,93,91,94,95,96,92];

        $this->data['provinceMienBac'] = $this->showRoomRepository->getAll(['province_ids'=>$mienbac]);
        $this->data['provinceMienTrung'] = $this->showRoomRepository->getAll(['province_ids'=>$mientrung]);
        $this->data['provinceMienNam'] = $this->showRoomRepository->getAll(['province_ids'=>$miennam]);

        // Seo key word
        View::share('title', 'Liên hệ với KenJi');
        View::share('description', 'Ghế massage KENJI – K8 tự hào là sản phẩm chất lượng được đài truyền hình VTC6 lựa chọn đưa tin trong mục cẩm nang sức khỏe.');
        View::share('keywords', 'Ghế massage KENJI');
        View::share('author', 'KenJi');
        View::share('imageSeo', '');

        return view('components.frontend.showroom.index',$this->data);
    }
}
