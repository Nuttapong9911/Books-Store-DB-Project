<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Producttype extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_description',
        'text_description'
    ];

    protected $primaryKey = 'type_ID';

    /**
     * One-To-Many relationship
     * 
     * This is One
     * 
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
