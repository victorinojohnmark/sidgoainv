<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewTotalStock extends Model
{
    public $table = 'view_total_stock';

    public function toner_type() {
        return $this->belongsTo(TonerType::class);
        // return TonerType::where('id', $this->toner_type_id)->first()->name;
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    } 
}
