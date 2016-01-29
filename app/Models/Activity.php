<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/22/16
 * Time: 6:05 PM
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'desc',
        'account_id',
        'type',
        'created_by',
        'rule',
    ];

}