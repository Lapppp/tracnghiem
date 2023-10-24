<?php

namespace App\Repositories\Images;

use App\Models\Images\Image;
use Prettus\Repository\Eloquent\BaseRepository;

class ImageRepository extends BaseRepository
{

    public function model()
    {
        return Image::class;
    }

    public function getByID($id)
    {
        return Image::find($id);
    }

    public function updateImageDefault(){
        return Image::where('votes', '>', 100)->update(array('status' => 2));
    }

}
