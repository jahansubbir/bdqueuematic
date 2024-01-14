<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
class AssignDefaultRoleToUser implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        //
        $user = $event->user;

        //Assign the default role (e.g. 'user') to the registered user
        $role = Role::where('name', 'user')->first();

        if ($role) {
            $user->assignRole($role);
        }
    }
}
