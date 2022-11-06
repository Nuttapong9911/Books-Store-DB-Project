<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'address_line1',
        'address_line2',
        'country',
        'state',
        'city',
        'postel_code',

        'user_ID'
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

    /**
     * One-To-Many relationship
     * 
     * This is Many
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
