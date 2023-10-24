<?php

namespace App\Http\Controllers\Frontend\Locations;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\FrontendController;
use App\Repositories\Districts\DistrictRepository;
use Illuminate\Http\Request;

class DistrictController extends FrontendController
{
    protected $districtRepository;
    protected $data = [];

    public function __construct(DistrictRepository $districtRepository)
    {
        $this->districtRepository = $districtRepository;
    }

    /**
     * @param  Request  $request
     */
    public function change(Request $request)
    {

        $city_id = $request->city_id ?? 0;
        $params = [
            'city_id' => [$city_id]
        ];
        $district = $this->districtRepository->getAll($params, null);
        $html = view('components.frontend.locations.district', ['district' => $district])->render();
        return ResponseHelper::success('Thành công', ['jsonHTML' => $html]);
    }
}
