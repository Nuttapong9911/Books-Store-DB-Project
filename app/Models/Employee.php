<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Office;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'job_title',
        'extension',
        'supervisor',
        'office_code'
    ];

    protected $primaryKey = 'emp_num';

    /**
     * One-To-Many relationship
     * 
     * This is Many
     * 
     */
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * One-To-Many relationship
     * 
     * This is Many
     * 
     */
    public function supervisor()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * One-To-Many relationship
     * 
     * This is One
     * 
     */
    public function supervisee()
    {
        return $this->hasMany(Employee::class);
    }


        

}
