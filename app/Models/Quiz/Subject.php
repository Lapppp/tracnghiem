<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    const TABLE = 'subjects';
    protected $table = self::TABLE;
    protected $fillable = [
        'title',
        'description',
        'status'
    ];
}
