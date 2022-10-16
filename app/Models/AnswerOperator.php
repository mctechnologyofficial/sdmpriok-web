<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerOperator extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'competency_id',
        'question_id',
        'essay',
        'file'
    ];
}
