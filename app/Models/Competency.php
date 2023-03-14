<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Competency extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'competencies';

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

    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class, 'competency_id', 'id');
    }
}
