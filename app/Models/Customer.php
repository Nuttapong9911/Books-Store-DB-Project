<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

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

    /**
     * One-To-Many relationship
     * 
     * This is One
     * 
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
