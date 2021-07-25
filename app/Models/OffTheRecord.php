<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffTheRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function offTheRecordItems() {
        return $this->hasMany(OffTheRecordItem::class);
    }

    public function offTheRecordActionTaken() {
        return $this->belongsTo(OffTheRecordActionTaken::class);
    }

    public function offTheRecordIssueDescription() {
        return $this->belongsTo(OffTheRecordIssueDescription::class);
    }

    public function offTheRecordSubjectFor() {
        return $this->belongsTo(OffTheRecordSubjectFor::class);
    }

    public function offTheRecordTransactionType() {
        return $this->belongsTo(OffTheRecordTransactionType::class);
    }
    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function getTotalQuantityAttribute() {
        return $this->offTheRecordItems->sum('quantity');
    }

    public function getCreatedByUsernameAttribute(){
        return User::where('id', $this->created_by)->pluck('username')->first();
    }
}
