<?php

namespace App\Models\Images;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    const TABLE = 'images';
    protected $table = self::TABLE;
    protected $fillable = [
        'url',
        'imageable_type',
        'imageable_id',
        'created_at',
        'updated_at',
        'is_default',
        'filename',
        'images',
        'device',
    ];

    public function imageable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
