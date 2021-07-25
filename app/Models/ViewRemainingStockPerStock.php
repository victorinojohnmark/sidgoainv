<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewRemainingStockPerStock extends Model
{
    public $table = "view_remaining_stock_per_stock";

    public function checkIn(){
        return $this->belongsTo(CheckIn::class);
    }

    public function toner() {
        return $this->belongsTo(Toner::class);
    }
}
