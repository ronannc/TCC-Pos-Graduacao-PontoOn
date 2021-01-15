<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTablesDescription extends Model
{
    use HasFactory;

    protected $table = "time_tables_description";

    protected $fillable = [
        'description',
        'company_id'
    ];

    public function time_tables(){
        return $this->hasMany(TimeTable::class, 'time_table_id');
    }
}
