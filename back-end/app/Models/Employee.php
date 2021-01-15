<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * @package App\Models
 */
class  Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'time_table_id',
        'name',
        'mother_name',
        'date_admission',
        'email',
        'telephone',
        'date_resignation',
        'cpf',
        'salary',
        'syndicate_id',
        'company_id',
    ];

    public function time_table_description(){
        return $this->belongsTo(TimeTablesDescription::class, 'time_table_id');
    }

    public function syndicate(){
        return $this->belongsTo(Syndicate::class);
    }
}
