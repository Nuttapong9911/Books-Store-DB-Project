<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Office;
use App\Models\User;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_title',
        'extension',
        'supervisor',
        'office_code',

        'user_ID'
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
