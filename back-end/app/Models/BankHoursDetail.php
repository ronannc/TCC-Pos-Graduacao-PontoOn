<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankHoursDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'point_id',
        'minutes',
        'type_overtime',
        'bank_id',
    ];

    public function bank_hours(){
        return $this->belongsTo(BankHour::class);
    }
}
