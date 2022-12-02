<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Veelasky\LaravelHashId\Eloquent\HashableId;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; // get roles from this trait

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HashableId;

    /**
     * User instance
     * @property int $id
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'name',
        'email',
        'phone',
        'password',
        'team_id',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        // 'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $appends = [
    //     'hash'
    // ];

    /**
     * Relation to teams model
     * With relation belongsTo
     */
    public function teams(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
