<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/25/16
 * Time: 3:47 PM
 */

namespace app\Repositories;

use App\Models\Activist;
use App\Models\Activity;


class ActivityRepository{

    public function getById( $id ){

       return Activity::find( $id );
    }

    public function create(String $name, String $type, int $accountId){

        return new Activity( $name, $type, $accountId );
    }

    /**
     * @param $activityId
     * @param $detail
     * @return Activist|bool
     */
    public function addActivist($activityId, $detail ){

        $detail['activity_id'] = $activityId;

        $activist = new Activist();

        if( $activist->fill($detail)->save() )
            return $activist;
        else
            return false;

    }

    public function getLatestActivitists( $activityId, $num){

        return Activist::where('pid', null)->where('activity_id', $activityId)->orderBy('updated_at', 'ase')->paginate( $num );
    }

    public function getTopActivitists( $activityId, $num){

        return Activist::where('pid', null)->where('activity_id', $activityId)->orderBy('vote', 'desc')->paginate( $num );
    }

    /**
     * @param $activityId
     * @param $activistId
     * @param $userId
     * @return Activist|bool
     */
    public function addVote( $activityId, $activistId, $userId ){

        $data= array(
            'activity_id' => $activityId,
            'pid' => $activistId,
            'user_id' => $userId
        );

        $activist = new Activist();
        $activist->fill($data)->save();
        if($activist->fill($data)->save() )
            return $activist;
        else
            return false;
    }


}