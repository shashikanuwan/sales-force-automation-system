<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relationships
    public function sku()
    {
        return $this->hasOne(Sku::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function linefree()
    {
        return $this->hasOne(LineFree::class);
    }

    // accessors
    public function getFreeIssueAttribute($quantity)
    {
        if ($this->linefree) {
            if ($this->linefree->type == "Flat") {
                if ($this->linefree->lower_limit <= $quantity and $quantity <= $this->linefree->uper_limit) {
                    return response()->json($this->Linefree->free_quantity);
                }
                return response("No free issue");
            }
            if ($this->linefree->lower_limit <= $quantity and $quantity <= $this->linefree->uper_limit) {
                return intval($quantity / $this->linefree->purchase_quantity * $this->linefree->free_quantity);
            }
            return response("No free issue");
        }
        return response("Free Issue Not Created");
    }

    public function getFreeQuantityAttribute()
    {
        if ($this->linefree) {
            return response()->json($this->linefree->free_quantity);
        }
        return  response("-");
    }

    public function getTypeAttribute()
    {
        if ($this->linefree) {
            return response()->json($this->linefree->type);
        }
        return  response("-");
    }

    public function getPurchaseQuantityAttribute()
    {
        if ($this->linefree) {
            return response()->json($this->linefree->purchase_quantity);
        }
        return  response("-");
    }
}
