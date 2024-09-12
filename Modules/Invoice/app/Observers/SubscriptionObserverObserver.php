<?php

namespace Modules\Invoice\Observers;

use Modules\Invoice\Models\Subscription;
use Modules\Invoice\app\Models\SubscriptionObserver;
use Illuminate\Support\Facades\Auth;

class SubscriptionObserverObserver
{
    /**
     * Handle the SubscriptionObserver "created" event.
     */
    public function creating(Subscription $subscription)
    {
        $subscription->created_by = Auth::id();
        $subscription->updated_by = Auth::id();
    }

    public function updating(Subscription $subscription)
    {
        $subscription->updated_by = Auth::id();
    }

    public function deleting(Subscription $subscription)
    {
        $subscription->deleted_by = Auth::id();
        $subscription->save();
    }

    /**
     * Handle the SubscriptionObserver "restored" event.
     */
    // public function restored(SubscriptionObserver $subscriptionobserver): void
    // {
    //     //
    // }

    // /**
    //  * Handle the SubscriptionObserver "force deleted" event.
    //  */
    // public function forceDeleted(SubscriptionObserver $subscriptionobserver): void
    // {
    //     //
    // }
}
