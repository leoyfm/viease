<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/25/16
 * Time: 7:19 PM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'account_id',
        'activity_id',
        'option_name',
        'option_value',
        'option_type',
    ];

}