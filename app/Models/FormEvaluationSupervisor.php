<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormEvaluationSupervisor extends Model
{
    use HasFactory;
    protected $fillable = [
        'tools',
        'unit',
        'test_material',
        'competence_test',
        'result',
        'description',
        'average_minimum_value'
    ];
}
