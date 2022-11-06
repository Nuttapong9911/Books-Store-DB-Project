<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;
use App\Models\Orderdetail;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'shipped_date',
        'order_date',
        'comments',
        'customer_ID'
    ];

    protected $primaryKey = 'order_num';

    /**
     * One-To-Many relationship
     * 
     * This is Many
     * 
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Many-to-Many relationship
     * this is one of Many
     * 
     */
    public function products(){
        return $this->belongsToMany(Products::class,'orderdetails');
    }

}
