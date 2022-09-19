<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorOrderProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // accessors
    public function getTotalAttribute()
    {
        return $this->product->mrp * $this->quantity;
    }

    public function getFreeIssueAttribute($quantity)
    {
        $freeIssue = null;

        if ($this->product->linefree) {
            if ($this->product->linefree->type == "Flat") {
                if ($this->product->linefree->lower_limit <= $this->quantity and $this->quantity <= $this->product->linefree->uper_limit) {
                    $freeIssue =  $this->product->linefree->free_quantity;
                } else {
                    $freeIssue = "No free issue";
                }
            } elseif ($this->product->linefree->lower_limit <= $this->quantity and $this->quantity <= $this->product->linefree->uper_limit) {
                $freeIssue = intval($this->quantity / $this->product->linefree->purchase_quantity * $this->product->linefree->free_quantity);
            } else {
                $freeIssue = "No free issue";
            }
        } else {
            $freeIssue = "Free Issue Not Created";
        }

        return $freeIssue;
    }

    //scopes
    public function scopeOfThisDistributor(Builder $query, User $distributor)
    {
        $query->whereHas('order', function (Builder $query) use ($distributor) {
            $query->where('user_id', $distributor->id);
        });
    }
}
