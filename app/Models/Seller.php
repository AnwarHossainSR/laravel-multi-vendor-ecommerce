<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Seller extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'full_name',
        'username',
        'photo',
        'phone',
        'email',
        'password',
    ];

    protected $guards = 'sellers';

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
