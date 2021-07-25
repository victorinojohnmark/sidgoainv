<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function checkOut() {
        return $this->belongsTo(CheckOut::class);
    }

    public function stock() {
        return $this->belongsTo(Stock::class);
    }

    public function getIDNoAttribute() {
        return 'R' . str_pad($this->id, 7, '0', STR_PAD_LEFT);
    }
}
