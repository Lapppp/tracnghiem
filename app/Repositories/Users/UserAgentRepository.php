<?php

namespace App\Repositories\Users;

use App\Models\Users\UserAdminDepartment;
use App\Models\Users\UserAgent;
use Prettus\Repository\Eloquent\BaseRepository;

class UserAgentRepository extends BaseRepository
{

    public function model()
    {
        return UserAgent::class;
    }


    public function getTotalUserAgentUserId( $params = [] )
    {
         return UserAgent::where('user_id', $params['user_id'])
            ->groupBy('keyVersion')->get()->count();
    }

}
