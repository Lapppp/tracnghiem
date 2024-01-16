<?php

namespace App\Repositories\Users;

use App\Models\Users\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Carbon\Carbon;

class UserRepository extends BaseRepository
{

    public function model()
    {
        return User::class;
    }

    public function getAll($params = [], $limit = 20)
    {
        $params = array_merge([
            'id' => [],
            'status' => [],
            'parent_id' => [],
            'user_id' => null,
            'search' => null,
        ], $params);

        $result = User::select(
            User::TABLE.'.*'
        );

        if ( !empty($params['search']) ) {
            $sql = "(".User::TABLE.".name LIKE '%".$params['search']."%' OR ".User::TABLE.".email LIKE '%".$params['search']."%')";
            $result->whereRaw($sql);
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $params['status'] = implode(',', $params['status']);
            $result->whereRaw("FIND_IN_SET(".User::TABLE.".status,'".$params['status']."')");
        }

        if ( !empty($params['id']) && is_array($params['id']) ) {
            $result->whereIn(User::TABLE.'.id', $params['id']);
        }

        if ( !empty($params['parent_id']) && is_array($params['parent_id']) ) {
            $result->whereIn(User::TABLE.'.parent_id', $params['parent_id']);
        }


        if ( !empty($params['user_id']) ) {
            $result->where(User::TABLE.'.id', (int) $params['user_id'])
                ->orWhere(User::TABLE.'.parent_id', $params['user_id']);
        }

        $result->orderBy(User::TABLE.'.id', 'desc');

        $per_page = !empty($limit) ? $limit : config('pagination.per_page');

        return empty($limit) ? $result->get() : $result->paginate($per_page);
    }

    public function getByID($id)
    {
        return User::find($id);
    }

    public function getTotal($params = [])
    {
        $params = array_merge([
            'status' => [],
            'search' => null,
            'today' => null,
            'sevenDays' => null,
        ], $params);

        $result = User::select(
            User::TABLE.'.*'
        );

        if ( !empty($params['search']) ) {
            $result->where(User::TABLE.'.name', 'LIKE', '%'.$params['search'].'%');
        }

        if ( !empty($params['status']) && is_array($params['status']) ) {
            $params['status'] = implode(',', $params['status']);
            $result->whereRaw("FIND_IN_SET(".User::TABLE.".status,'".$params['status']."')");
        }

        if ( !empty($params['sevenDays']) ) {
            $result->whereDate('created_at', '>=', Carbon::now()->subDays(7));
        }


        if ( !empty($params['today']) ) {
            $result->whereDate('created_at', '=', date('Y-m-d'));
        }

        $result->orderBy(User::TABLE.'.id', 'desc');

        return $result->get()->count();
    }

    public function getAccountGoogle($google_id)
    {
        return User::where('google_id',$google_id)->first();
    }

    public function getAccountFacebook($facebook_id)
    {
        return User::where('facebook_id',$facebook_id)->first();
    }

    public function getEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
