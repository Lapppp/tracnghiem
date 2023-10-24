<?php

namespace App\Repositories\Roles;

use App\Models\Roles\Role;
use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository
{

    public function model()
    {
        return Role::class;
    }

}
