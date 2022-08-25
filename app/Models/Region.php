<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    // relationships
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function territories()
    {
        return $this->hasMany(Territory::class);
    }
}
