<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable

{

    use HasFactory, Notifiable, HasRoles, HasApiTokens;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name',
        'email',
        'phone',
        'password',
        'photo_url',

    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password',

        'remember_token',

    ];



    /**

     * The attributes that should be cast to native types.

     *

     * @var array

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function assistant()
    {
        return $this->hasOne(Assistant::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new TenantScope());

        static::creating(function ($model){
            if (session()->has('tenant_id')) {
                $model->tenant_id = session()->get('tenant_id');
            }
        });
    }

}
