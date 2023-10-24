<?php

namespace App\Models\Questions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    const TABLE = 'questions';
    protected $table = self::TABLE;
    protected $fillable = [
        'name',
        'answer',
        'status'
    ];

}
