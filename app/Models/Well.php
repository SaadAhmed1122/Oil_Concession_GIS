<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Well extends Model
{
    use HasFactory;
    protected $primaryKey = 'well_code';

    // public function concession()
    // {
    //     return $this->belongsTo(Concession::class, 'concession_code', 'concession_code');
    // }

    // public function tank()
    // {
    //     return $this->hasOne(Tank::class, 'well_code', 'well_code');
    // }
}
