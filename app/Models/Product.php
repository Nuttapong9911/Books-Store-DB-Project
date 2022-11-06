<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Producttype;
use App\Models\Order;
use App\Models\Orderdetail;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_description',
        'pages_num',
        'publisher',
        'published_date',
        'author_name',
        'image',

        'quantity_stock',
        'buy_price',

        'type_ID'
    ];

    protected $primaryKey = 'ISBN';

    /**
     * One-To-Many relationship
     * 
     * This is One
     * 
     */
    public function product_type()
    {
        return $this->belongsTo(Producttype::class);
    }

    /**
     * Many-to-Many relationship
     * this is one of Many
     * 
     */
    public function orders(){
        return $this->belongsToMany(Order::class,'orderdetails');
    }

}
