<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syndicate extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'type_week',
      'type_sat',
      'type_sun',
      'type_holiday',
      'company_id'
    ];
}

