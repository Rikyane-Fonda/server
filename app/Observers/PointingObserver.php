<?php

namespace App\Observers;

use App\Models\Pointing;

class PointingObserver
{
    /**
     * Handle the Pointing "created" event.
     */
    public function created(Pointing $pointing): void
    {
        //
    }

    /**
     * Handle the Pointing "updated" event.
     */
    public function updated(Pointing $pointing): void
    {
        //
    }

    /**
     * Handle the Pointing "deleted" event.
     */
    public function deleted(Pointing $pointing): void
    {
        //
    }

    /**
     * Handle the Pointing "restored" event.
     */
    public function restored(Pointing $pointing): void
    {
        //
    }

    /**
     * Handle the Pointing "force deleted" event.
     */
    public function forceDeleted(Pointing $pointing): void
    {
        //
    }

    public function saved(Pointing $pointing)
    {
        $pointing->calculateHours();
    }
}
