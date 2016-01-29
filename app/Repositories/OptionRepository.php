<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/25/16
 * Time: 7:21 PM
 */

namespace App\Repositories;

use App\Models\Option;

class OptionRepository
{
    public function addOption( $data ){

        return Option::create( $data);

    }


}