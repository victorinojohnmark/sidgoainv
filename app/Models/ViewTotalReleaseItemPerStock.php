<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewTotalReleaseItemPerStock extends Model
{
    public $table = "view_total_release_item_per_stock";

    public function stock() {
        return $this->belongsTo(Stock::class);
    }

    public function checkOut() {
        return $this->belongsTo(CheckOut::class);
    }
}
