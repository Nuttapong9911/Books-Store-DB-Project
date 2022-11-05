<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'password',
        'email',
        'phone',
        'address_line1',
        'address_line2',
        'country',
        'state',
        'city',
        'postel_code'
    ];

    protected $primaryKey = 'customer_ID';
}
