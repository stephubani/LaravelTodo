<?php

namespace App\Listeners;

use App\Events\CompletedTodo;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MarkNotificationAsRead
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompletedTodo $event): void
    {
        //
       foreach($event->todo->notifications as $notification){
            $notification->update([
                'is_completed'=> true
            ]);
       };
       
    }
}
