<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteOperator extends Model
{
    use HasFactory;
    protected $fillable = [
        'competency_id',
        'note'
    ];
}
