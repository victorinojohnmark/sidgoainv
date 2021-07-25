<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnReceive extends Model
{
    use HasFactory;

    protected $guarded =  [];

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function reasonOfReturn() {
        return $this->belongsTo(ReasonOfReturn::class);
    }

    public function subjectFor() {
        return $this->belongsTo(SubjectFor::class);
    }

    public function returnReissue() {
        return $this->hasOne(ReturnReissue::class);
    }

    public function returnItems() {
        return $this->hasMany(ReturnItem::class);
    }

    public function getProcessedByAttribute() {
        return User::where('id', $this->created_by)->pluck('username')->first();
    }

    public function getUpdatedByAttribute() {
        return User::where('id', $this->updated_by)->pluck('username')->first();
    }

    public function getCheckOutReferencesAttribute() {
        $array = [];
        foreach ($this->returnItems as $returnItem) {
            array_push($array, $returnItem->releaseItem->checkout->reference_no);
        }

        return array_unique($array);
    }

    public function getTonerModelsAttribute() {
        $array = [];
        foreach($this->returnItems as $returnItem) {
            array_push($array, $returnItem->releaseItem->stock->toner->model_name);
        }

        //clean duplicate element in array and return
        return array_unique($array);
    }
}
