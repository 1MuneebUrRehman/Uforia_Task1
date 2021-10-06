<?php

namespace App\Observers;

use App\Models\RoleUser;

class RoleUserObserver
{
    /**
     * Handle the RoleUser "created" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function created(RoleUser $roleUser)
    {
        dd("Created");

    }

    /**
     * Handle the RoleUser "updated" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function updated(RoleUser $roleUser)
    {
        dd("Updated");
    }

    /**
     * Handle the RoleUser "deleted" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function deleted(RoleUser $roleUser)
    {
        dd("deleted");
    }

    /**
     * Handle the RoleUser "restored" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function restored(RoleUser $roleUser)
    {
        dd("restored");
    }

    /**
     * Handle the RoleUser "force deleted" event.
     *
     * @param  \App\Models\RoleUser  $roleUser
     * @return void
     */
    public function forceDeleted(RoleUser $roleUser)
    {
        dd("forceDeleted");
    }
}
