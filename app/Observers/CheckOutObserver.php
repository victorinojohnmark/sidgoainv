<?php

namespace App\Observers;

use App\Models\CheckOut;
use App\Models\Delivery;

class CheckOutObserver
{

    public function creating(CheckOut $checkOut) {
        
    }

    /**
     * Handle the CheckOut "created" event.
     *
     * @param  \App\Models\CheckOut  $checkOut
     * @return void
     */
    public function created(CheckOut $checkOut)
    {
        // $checkOut->dr_no = str_pad($checkOut->id + 2300, 5, '0', STR_PAD_LEFT);
        $checkOut->reference_no = 'COAU' . str_pad($checkOut->id, 7, '0', STR_PAD_LEFT);
        $checkOut->update();

        
    }

    /**
     * Handle the CheckOut "updated" event.
     *
     * @param  \App\Models\CheckOut  $checkOut
     * @return void
     */
    public function updated(CheckOut $checkOut)
    {
        //
    }

    /**
     * Handle the CheckOut "deleted" event.
     *
     * @param  \App\Models\CheckOut  $checkOut
     * @return void
     */
    public function deleted(CheckOut $checkOut)
    {
        //
    }

    /**
     * Handle the CheckOut "restored" event.
     *
     * @param  \App\Models\CheckOut  $checkOut
     * @return void
     */
    public function restored(CheckOut $checkOut)
    {
        //
    }

    /**
     * Handle the CheckOut "force deleted" event.
     *
     * @param  \App\Models\CheckOut  $checkOut
     * @return void
     */
    public function forceDeleted(CheckOut $checkOut)
    {
        //
    }
}
