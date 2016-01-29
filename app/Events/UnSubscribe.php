<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/26/16
 * Time: 3:30 PM
 */

namespace App\Events;

use App\Models\Account;
use Illuminate\Queue\SerializesModels;
class UnSubscribe extends Event
{
    use SerializesModels;
    public $account;
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

}