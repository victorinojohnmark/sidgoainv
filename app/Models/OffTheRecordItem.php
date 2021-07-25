<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffTheRecordItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function offTheRecord() {
        return $this->belongsTo(OffTheRecord::class);
    }

    public function toner() {
        return$this->belongsTo(Toner::class);
    }
}
