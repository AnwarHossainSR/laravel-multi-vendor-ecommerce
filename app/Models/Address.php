<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'address'.
        'postcode',
        'state',
        'country',
        /* 'scity',
        'saddress',
        'spostcode',
        'sstate',
        'scountry' */
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
