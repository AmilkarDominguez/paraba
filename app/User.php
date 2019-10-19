<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
////
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'state',
        'gender',
        'photo',
        'role_id',
        'nro_document',
        'country_id',
        'document_type_id',
        'occupation_id',
        'language_id',

    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function authorizeRol($roles) {
        if($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Acción no Autorizada.');
    }
    public function hasAnyRole($roles) {
        if($this->hasRole($roles)) {
            return true;
        }
        return false;
    }

    public function hasRole($role) {
        if($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
