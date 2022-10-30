<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    use HasFactory;
    protected $guarded = [];

    // declare const of role
    public const TYPE_SUPERVISOR = 'Supervisor';
    public const TYPE_OPERATOR = 'Operator';


    public static function getTypeRoles(): array
    {
        return [
            self::TYPE_SUPERVISOR,
            self::TYPE_OPERATOR
        ];
    }
}
