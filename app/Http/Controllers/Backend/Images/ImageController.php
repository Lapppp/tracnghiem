<?php

namespace App\Http\Controllers\Backend\Images;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use App\Repositories\Images\ImageRepository;
use Illuminate\Http\Request;

class ImageController extends BackendController
{
    protected $imageRepository;
    public function __construct(ImageRepository $imageRepository)
    {
        parent::__construct();
        $this->imageRepository = $imageRepository;
    }

    public function destroy( $id ) {

        $image = $this->imageRepository->getByID($id);
        $image->delete();
        return ResponseHelper::success('Thành công');
    }

}
