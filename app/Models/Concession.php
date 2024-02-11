<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Geometry;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;


class Concession extends Model
{
    use HasFactory;
    use HasSpatial;
    protected $table = 'concessions';

    protected $primaryKey = 'concession_id';

    protected $fillable = [
        'concession_name',
        'geometry',

    ];

    protected $casts = [
        'geometry' => LineString::class,
    ];


    public function wells()
    {
        return $this->hasMany(Well::class, 'concession_code', 'concession_code');
    }

    public function tanks()
    {
        return $this->hasMany(Tank::class, 'concession_code', 'concession_code');
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class, 'concession_code', 'concession_code');
    }
}
