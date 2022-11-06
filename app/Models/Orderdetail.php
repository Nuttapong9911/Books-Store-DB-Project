<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Order;
use App\Models\Product;

class Orderdetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'ISBN',
        'order_num',
        'price_each',
        'quantity'
    ];

}
