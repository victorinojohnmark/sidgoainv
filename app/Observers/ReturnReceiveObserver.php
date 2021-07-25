<?php

namespace App\Observers;

use App\Models\ReturnReceive;

class ReturnReceiveObserver
{
    //

    public function created(ReturnReceive $returnReceive) {
        $returnReceive->reference_no = 'RRC' . str_pad($returnReceive->id, 7, '0', STR_PAD_LEFT);
        $returnReceive->update();
    }
}
