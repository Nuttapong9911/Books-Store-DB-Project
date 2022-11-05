<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Employee;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'address_line1',
        'address_line2',
        'country',
        'state',
        'city',
        'territory',
        'postel_code'
    ];

    protected $primaryKey = 'office_code';

    /**
     * One-To-Many relationship
     * 
     * This is One
     * 
     */
    public function employees()
    {
        return $this->hasMany(Employees::class);
    }

}
