<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Toner extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $casts = [
    //     'status' => 'boolean',
    // ];

    public function toner_type() {
        return $this->belongsTo(TonerType::class);
        // return TonerType::where('id', $this->toner_type_id)->first()->name;
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    public function getStocksCompletedAttribute() {
        return Stock::where('toner_id', $this->id)
                        ->whereHas('checkIn', function($query){
                            $query->where('check_ins.status', '1');
                        })->get();
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function getStockPerTonerAttribute() {
        return $this->hasMany(ViewRemainingStockPerToner::class);
    }

    public function getTonerStocksAttribute() {
        return $this->hasMany(Stock::class);
    }

    public function getCurrentStockAttribute() {
        $count = 0;
        foreach ($this->StocksCompleted as $stock) {
            //$count += $stock->quantity - $stock->ReleaseItemCompleted->sum('quantity');
			$count += $stock->RemainingStock;
        }

        return $count;
    }
    
}
