<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSupervisor extends Model
{
    use HasFactory;
    protected $fillable = [
        'competency',
        'category',
        'sub_category',
        'reference',
        'lesson_plan',
        'processing_time',
        'realization',
        'total_time',
    ];
}
