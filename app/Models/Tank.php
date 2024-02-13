<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    protected $primaryKey = 'tank_code';

    protected $fillable = [
        'concession_code',
        'well_code',
        'capacity',
        'longitude',
        'latitude',
        'polyline',
    ];

    public function concession()
    {
        return $this->belongsTo(Concession::class, 'concession_code', 'concession_id');
    }

    public function well()
    {
        return $this->belongsTo(Well::class, 'well_code', 'well_code');
    }
}
