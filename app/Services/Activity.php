<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/25/16
 * Time: 4:38 PM
 */

namespace App\Services;


use App\Models\Activist;
use App\Repositories\ActivityRepository;
use App\Repositories\OptionRepository;
use App\Models\Option;

class Activity{

    private $activity_id;

    private $actRepo;

    /**
     * Activity constructor.
     * @param null $id activity id
     */
    public function __construct( $id=null ){
        if( $id )
            $this->activity_id = $id;

        $this->actRepo = new ActivityRepository();
    }


    public function setActivityId( $id ){
        $this->activity_id = $id;
    }
    public function getActivityId(){
        return $this->activity_id;
    }

    /**
     * @param $id
     * @return Activist
     */
    public function getParticipator( $id ){
        return Activist::find( $id );
    }

    /**
     * @param array $data 活动者attr
     * @return \App\Models\Activity 活动者
     */
    public function addActivist( $data ){

        return $this->actRepo->addActivist( $this->activity_id, $data );
    }

    public function getLatestParticipators(){


        return $this->actRepo->getLatestActivitists( $this->activity_id, 4 );
    }

    public function getTopParticipators( $num = 30){
        return $this->actRepo->getTopActivitists( $this->activity_id, $num );
    }

    public function getLatestVoters( $participatorId, $num = 10){

        return Activist::join('fans', 'activists.user_id', '=', 'fans.id')->where('pid', $participatorId)->take( $num)->get();
    }


    public function vote($participatorId, $voterId ){

        $num = $this->getVoterTicket($voterId);

        if( $num <= 0 ){
            return false;
        }


        $voter = new Activist();
        $voter->user_id = $voterId;
        $voter->activity_id = $this->activity_id;
        $participator = $this->getParticipator( $participatorId );
        $voter = $participator->voters()->save( $voter );
        if( $voter ){
            $participator->vote++;
            $participator->save();
            $this->decrementVoteTicket($voterId);
            return true;
        }else{
            return false;
        }

    }

    /**
     * @param int $user_id
     */
    public function incrementVoteTicket( $user_id ){

        $option = Option::firstOrNew(array('activity_id' => $this->activity_id, 'option_name'=> $user_id, 'option_type'=> 'vote_ticket'));

        if( $option->option_value == null ){
            $option->option_value = 0;

        }
        $option->option_value++;

        return $option->save();

    }

    public function decrementVoteTicket( $user_id ){

        $option = Option::firstOrNew(array('activity_id' => $this->activity_id, 'option_name'=> $user_id, 'option_type'=> 'vote_ticket'));
        if( $option->option_value == null ){
            $option->option_value = 0;

        }else{
            $option->option_value--;
        }

        return $option->save();

    }



    /**
     * @param int $user_id
     * @param int $num
     */
    public function setVoteTicket( $user_id , $num ){

        $option = Option::firstOrNew(array('activity_id' => $this->activity_id, 'option_name'=> $user_id, 'option_type'=> 'vote_ticket'));

        $option->option_value = $num;

        $option->save();
    }

    public function getVoterTicket( $user_id ){
        $option = Option::firstOrNew(array('activity_id' => $this->activity_id, 'option_name'=> $user_id, 'option_type'=> 'vote_ticket'));
        if( $option->option_value == null ){
            $option->option_value = 0;
            $option->save();
        }
        return $option->option_value;

    }


}