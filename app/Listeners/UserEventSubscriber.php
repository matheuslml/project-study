<?php

namespace App\Listeners;

use App\Models\Audit;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) {
        try {
            DB::beginTransaction();
            $data = [
                'user_type' => "App\Models\User",
                'user_id' => auth()->user()->id,
                'event'      => "Logged In",
                'auditable_type' => "Logged In",
                'auditable_id' => auth()->user()->id,
                'url'        => request()->fullUrl(),
                'ip_address' => request()->getClientIp(),
                'user_agent' => request()->userAgent(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            //create audit trail data
            Audit::create($data);
            DB::commit();
        }catch (\Throwable $throwable){
            DB::rollBack();

        }
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {
        try {
            DB::beginTransaction();
            $data = [
                'user_type' => "App\Models\User",
                'user_id' => auth()->user()->id,
                'event'      => "Logged Out",
                'auditable_type' => "Logged Out",
                'auditable_id' => auth()->user()->id,
                'url'        => request()->fullUrl(),
                'ip_address' => request()->getClientIp(),
                'user_agent' => request()->userAgent(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            //create audit trail data
            Audit::create($data);
            DB::commit();
        }catch (\Throwable $throwable){
            DB::rollBack();

        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@handleUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@handleUserLogout'
        );
    }
}
