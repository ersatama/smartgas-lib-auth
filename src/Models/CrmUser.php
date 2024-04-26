<?php

declare(strict_types=1);

namespace Ruslan_sgs\SmartgasLibAuth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CrmUser extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $table = "crm_users";
    protected $guarded = [];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'is_test' => 'boolean',
    ];

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}