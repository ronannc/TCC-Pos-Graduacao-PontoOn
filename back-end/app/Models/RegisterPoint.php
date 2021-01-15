<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterPoint extends Model
{
    use HasFactory;

    /**
     * type
     */
    const HOLIDAY     = 1;
    const FOUL        = 2;
    const WORKED      = 3;
    const VACATION    = 4;
    const MISSING     = 5;
    const DAY_OFF     = 6;
    const DAY_OF_BANK = 7;

    protected $fillable = [
        'id',
        'date',
        'type',
        'overtime',
        'type_overtime',
        'minutes_worked',
        'employee_id',
    ];

    public function schedule()
    {
        return $this->hasMany( Schedule::class, 'point_id' );
    }
}
