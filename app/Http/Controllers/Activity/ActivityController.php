<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 6/03/2016
 * Time: 7:51 PM
 */

namespace app\Http\Controllers\Activity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Activity as Activity;
use App\Services\Account as AccountService;
use App\Repositories\AccountRepository as AccRepo;


class ActivityController extends Controller
{
    private $activity;

    private $account;

    private $current_user;
//    public function __construct( $id, AccRepo $repo )
//    {
//
//        dd('dd');
//        $this->activity = Activity::find( $id );
//        $this->account = $repo->getById( $this->activity->account_id );
//        if( $this->activity != "yes" || $this->activity == null || $this->account == null )
//            return redirect(activity_view('activity.error'));
//
//
//    }

    public function getIndex( ){

        return 'dddd';
    }

    public function getUpdate( $id){
        dd( $id );
    }

    public function init( $id, AccRepo $repo, Request $request){

        $this->activity = Activity::find( $id );
        $this->account = $repo->getById( $this->activity->account_id );
        $this->current_user = $request->session()->get('logged_user');

        if( $this->activity->enable != "yes" || $this->activity == null || $this->account == null )
            return activity_view('error');
        else{


            return redirect($this->activity->url)->with('account',$this->account)->with("activity", $this->activity )->with('current_user', $this->current_user);

        }

        return "init";
    }

}