<?php

namespace App\Listeners;

use App\Events\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\CustomService;

class LoginSuccessful
{
    /**
     * Create the event listener.
     */
    public function __construct(private CustomService $customService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoginHistory $event)//: void
    {
        $userinfo = $event->user;
        $this->customService->loginHistoryLog($userinfo);
    }
}
