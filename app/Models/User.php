<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    // 1 -----------------------------------> *
    //  UN USUARIO TIENE MUCHOS POSTS
    //
    // 1 <----------------------------------- 1
    //  UN POST PERTENECE A SOLO UN USUARIO
    //
    //  RELACION UNO A MUCHOS - ONE TO MANY   OR  (HAS MANY)
    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function getNameUppercaseAttribute() {
        return strtoupper($this->name);
    }

    public function setNameAttribute($value) {
        $this->attributes['Name'] = strtolower($value);
    }
}
