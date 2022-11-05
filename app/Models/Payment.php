<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Customer;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_date',
        'amount',
    ];

    protected $primaryKey = [
        'check_num',
        'customer_ID'
    ];

     /**
     * Weak relationship
     * 
     * 
     */
    public function customer()
    {
        return $this->belongsTo(Customer::Class);
    }

    

}
