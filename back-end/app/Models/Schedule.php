<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'point_id',
        'datetime'
    ];

    public function register_point(){
        return $this->belongsTo(RegisterPoint::class);
    }
}
