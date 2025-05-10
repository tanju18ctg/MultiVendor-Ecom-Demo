<?php

namespace App\Listeners;

// use App\Events\Laravel\Passport\Events\AccessTokenCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Passport\Token;
use Laravel\Passport\Events\AccessTokenCreated;


class RevokeOldTokens
{
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
     * @param  \App\Events\Laravel\Passport\Events\AccessTokenCreated  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        Token::where([
            ['user_id', $event->userId],
            ['id', '<>', $event->tokenId]
        ])->delete();
    }
}
