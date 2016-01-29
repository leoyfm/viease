<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/22/16
 * Time: 6:26 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Activist extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'activity_id',
        'user_id',
        'name',
        'tel',
        'pic',
        'remark',
        'pid',
        'vote'
    ];

    public function voters(){
        return $this->hasMany('App\Models\Activist', 'pid', 'id');
    }

}