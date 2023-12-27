<?php

// app/Models/Sector.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function __commitments()
    {
        return $this->hasMany(Commitment::class);
    }

    public function commitments($year)
    {
        return $this->__commitments->where('year',$year);
    }

}
