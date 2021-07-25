<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function stocks(){
        return $this->hasMany(Stock::class);
    }

    public function returnReissue() {
        return $this->belongsTo(ReturnReissue::class);
    }

    public function getReferenceNoAttribute() {
        return 'CIAU' . str_pad($this->id, 7, '0', STR_PAD_LEFT);
    }

    public function getTotalQuantityAttribute() {
        return $this->stocks()->sum('quantity');
    }

    public function getCreatedByUsernameAttribute(){
        return User::where('id', $this->created_by)->pluck('username')->first();
    }

    public function getEditedByUsernameAttribute(){
        return User::where('id', $this->edited_by)->pluck('username')->first();
    }

    
}


