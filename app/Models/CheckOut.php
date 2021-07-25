<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [    
        'files' => 'array'
    ];

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function releaseItems() {
        return $this->hasMany(ReleaseItem::class);
    }

    public function delivery() {
        return $this->hasOne(Delivery::class);
    }

    public function getItemSpecificsAttribute() {
        $array = [];
        foreach ($this->releaseItems as $item) {
            array_push($array, $item->stock->toner->model_name.'-'.$item->quantity.'Pc/s');
        }

        return $array;
    }

    public function getReferenceNoAttribute() {
        return 'COAU' . str_pad($this->id, 7, '0', STR_PAD_LEFT);
    }

    public function getCreatedByUsernameAttribute(){
        return User::where('id', $this->created_by)->pluck('username')->first();
    }

    public function getEditedByUsernameAttribute(){
        return User::where('id', $this->edited_by)->pluck('username')->first();
    }

    public function getDeliveryStatusAttribute() {
        return DeliveryStatus::where('id', $this->delivery_status_id)->pluck('name')->first();
    }

    public function getTonerCodesAttribute() {
        $tonerCode = [];
        foreach ($this->releaseItems as $releaseItem) {
            array_push($tonerCode, $releaseItem->stock->checkIn->toner_code);
        }

        return $filteredTonerCode = array_unique($tonerCode);
    }

    public function getTotalItemCountAttribute() {
        return $this->releaseItems->sum('quantity');
    }

    public function completingCheckout() {
        return $this->hasOne(Checkout::class, 'parent_checkout_id');
    }

    public function parentCheckout() {
        return $this->belongsTo(Checkout::class, 'parent_checkout_id');
    }

    

    
}
