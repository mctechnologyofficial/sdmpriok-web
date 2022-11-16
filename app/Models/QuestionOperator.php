<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOperator extends Model
{
    use HasFactory;
    protected $fillable = [
        'competency',
        'category',
        'sub_category',
        'lesson',
        'reference',
        'lesson_plan',
        'processing_time',
        'realization',
        'total_time',
    ];
}
