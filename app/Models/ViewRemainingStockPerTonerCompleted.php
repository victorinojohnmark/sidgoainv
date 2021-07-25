<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewRemainingStockPerTonerCompleted extends Model
{
    // use HasFactory;

    public $table = 'view_remaining_stock_per_toner_completed';

    public function stock() {
        return $this->belongsTo(Stock::class, 'id');
    }

    public function checkIn() {
        return $this->belongsTo(CheckIn::class);
    }

    public function toner() {
        return $this->belongsTo(Toner::class);
    }
}
