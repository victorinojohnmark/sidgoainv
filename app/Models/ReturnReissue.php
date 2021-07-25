<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnReissue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function returnReceive() {
        return $this->belongsTo(ReturnReceive::class);
    }

    public function reissueType() {
        return $this->belongsTo(ReissueType::class);
    }

    public function getProcessedByAttribute() {
        return User::where('id', $this->created_by)->pluck('username')->first();
    }

    public function getUpdatedByAttribute() {
        return User::where('id', $this->edited_by)->pluck('username')->first();
    }

}
