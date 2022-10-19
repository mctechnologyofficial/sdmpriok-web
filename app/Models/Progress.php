<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';
    protected $fillable = [
        'user_id',
        'team_id',
        'competency_id',
        'submit_time',
        'progress'
    ];
}
