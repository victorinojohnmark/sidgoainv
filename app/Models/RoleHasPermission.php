<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;

    public function roles() {
        return $this->belongsTo(Roles::class);
    }

    public function permission() {
        return $this->belongsTo(Permission::class);
    }

    // public function permission(){
    //     return $this->hasOne(Permission::class);
    // }
}
