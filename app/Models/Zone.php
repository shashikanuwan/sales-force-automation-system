<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    // relationships
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
