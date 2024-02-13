<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;
    protected $primaryKey = 'inspection_id';

    protected $fillable = [
        'type',
        'inspection_date',
        'status',
        'resolution_time',
        'description',
        'related_id',
    ];

    public function well()
    {
        return $this->belongsTo(Well::class, 'well_code', 'well_code');
    }
    public function tank()
    {
        return $this->belongsTo(Tank::class, 'tank_code', 'tank_code');
    }
    public function concession()
    {
        return $this->belongsTo(Concession::class, 'concession_code', 'concession_id');
    }
}
