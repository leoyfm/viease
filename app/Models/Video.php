<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/28/16
 * Time: 3:11 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $fillable = [
        'title',
        'desc',
        'path',
    ];

}