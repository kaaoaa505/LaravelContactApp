<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'bio',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $with = ['contacts', 'companies'];

    public function contacts(){
        return $this->hasMany(Contact::class);
    }

    public function companies(){
        return $this->hasMany(Company::class);
    }

    public function fullName(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function profileUrl(){
        // return !empty($this->image) ? asset('storage/' . $this->image) : asset('img/profile.png');
        return Storage::exists($this->image) ? Storage::url($this->image) : asset('img/profile.png');
    }
}
