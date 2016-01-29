<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/26/16
 * Time: 3:39 PM
 */

namespace App\Listeners;


use App\Events\UnSubscribe;

class UnSubscribeListener
{
    public function handle(UnSubscribe $event)
    {
        dd( $event );
    }
}