<?php

namespace App\Repositories\Comments;

use App\Models\Post\Comment;
use Prettus\Repository\Eloquent\BaseRepository;

class CommentRepository extends BaseRepository
{

    public function model()
    {
        return Comment::class;
    }

    public function getAll( $params = [], $limit = 20 )
    {
        $params = array_merge([
            'user_id' => null,
            'search' => null,
            'status' => null,
        ], $params);

        $result = Comment::select(
            Comment::TABLE . '.*'
        );

        if(!empty( $params['status']) && is_array($params['status'])) {
            $result->whereIn('status',$params['status']);
        }

        if ( !empty($params['search']) ) {
            $result->where(Comment::TABLE.'.name', 'LIKE', '%'.$params['search'].'%');
            $result->orWhere(Comment::TABLE.'.email', 'LIKE', '%'.$params['search'].'%');
            $result->orWhere(Comment::TABLE.'.phone', 'LIKE', '%'.$params['search'].'%');
        }

        $result->orderBy(Comment::TABLE . '.id', 'desc');
        return empty($limit) ? $result->get() : $result->paginate($limit);
    }

    public function getById( $id )
    {
        return Comment::find($id);
    }
}
