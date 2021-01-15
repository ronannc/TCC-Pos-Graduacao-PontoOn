<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_entry',
        'first_exit',
        'second_entry',
        'second_exit',
        'third_entry',
        'third_exit',
        'day',
        'quantity_hours_day',
        'time_table_id'
    ];

    public function time_table_description(){
        return $this->belongsTo(TimeTablesDescription::class, 'time_table_id');
    }
}

