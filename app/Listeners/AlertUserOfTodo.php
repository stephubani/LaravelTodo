<?php

namespace App\Listeners;

use App\Events\TodoAssigned;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AlertUserOfTodo
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
    public function handle(TodoAssigned $event): bool
    {
        Notification::create([
            'todo_id'=>$event->todo->id,
            'user_id'=>$event->todo->user->id,
        ]);

        return false;
        //
    }
}
