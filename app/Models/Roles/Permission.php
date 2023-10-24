<?php

namespace App\Models\Roles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    const TABLE = 'permissions';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'parent_id',
        'route',
        'weight',
        'customize_name',
        'icon',
        'action',
        'controller',
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
}
