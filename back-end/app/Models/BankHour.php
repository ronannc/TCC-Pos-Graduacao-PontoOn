<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'company_id'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function bank_details(){
        return $this->hasMany(BankHoursDetail::class, 'bank_id');
    }
}
