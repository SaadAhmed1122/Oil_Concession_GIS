<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concession extends Model
{
    use HasFactory;

    protected $table = 'concessions';

    protected $primaryKey = 'concession_id';

    protected $fillable = [
        'concession_name',
        'geometry',

    ];

    protected $casts = [
        'geometry' => 'geometry',
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
