<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellProduction extends Model
{
    use HasFactory;

    protected $fillable = ['well_id', 'monthly_production', 'month'];

    // Define the relationship with the Well model
    public function well()
    {
        return $this->belongsTo(Well::class, 'well_id', 'well_code');
    }
}
