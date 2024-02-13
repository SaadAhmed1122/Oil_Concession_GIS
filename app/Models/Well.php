<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Well extends Model
{
    use HasFactory;
    protected $primaryKey = 'well_code';

    protected $fillable = [
        'concession_code',
        'monthly_production',
        'longitude',
        'latitude',
    ];

    public function concession()
    {
        return $this->belongsTo(Concession::class, 'concession_code', 'concession_id');
    }

    public function tank()
    {
        return $this->hasOne(Tank::class, 'well_code', 'well_code');
    }
}
