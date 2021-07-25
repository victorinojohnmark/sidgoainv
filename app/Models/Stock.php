<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function checkIn() {
        return $this->belongsTo(CheckIn::class);
    }

    public function toner() {
        return $this->belongsTo(Toner::class);
    }

    public function releaseItems() {
        return $this->hasMany(ReleaseItem::class);
    }

    public function getReleaseItemCompletedAttribute() {
        return ReleaseItem::where('stock_id', $this->id)
        ->whereHas('checkOut', function($query){
            $query->where('check_outs.status', '1');
        })->get();
    }

    public function getRemainingStockAttribute() {
        return ($this->quantity) - ($this->ReleaseItemCompleted->sum('quantity'));
    }

    public function getIDNoAttribute() {
        return 'S' . str_pad($this->id, 7, '0', STR_PAD_LEFT);
    }
}
