<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 6/03/2016
 * Time: 4:53 PM
 */

namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity as Activity;
class ActivityController extends Controller
{

    private $account;

    public function __construct()
    {

        $this->account = $this->account();
    }

    public function getIndex(){


        $activities = Activity::whereAccountId( $this->account->id )->get();
        

        return admin_view('activity.index', ['activities'=> $activities]);
    }

    public function getCreate(){
        return admin_view("activity.form");
    }

    public function postCreate( Request $request ){

        $activity = new Activity();

        $attr = $request->all();
        $attr['account_id'] = $this->account()->id;
        $attr['enable'] = 'yes';
        $activity->fill( $attr );

        $activity->save();

        return redirect(admin_url('activity'))->withMessage('添加成功！');
    }

    public function getUpdate( $id ){

        $activity = Activity::find( $id );

        return admin_view("activity.form", ["activity" => $activity]);
    }

    public function postUpdate( $id , Request $request){

        $activity = Activity::find( $id );

        $attr = $request->all();
        $attr['account_id'] = $this->account()->id;
        $activity->fill( $attr );

        $activity->update();

        return redirect(admin_url('activity'))->withMessage('更新成功！');

    }

    public function getDelete( $id ){
        $activity = Activity::find( $id );

        $activity->delete();
        return redirect(admin_url('activity'))->withMessage('删除成功！');
    }

    public function getEnable( $id ){
        $activity = Activity::find( $id );

        $activity->enable = "yes";
        $activity->update();
        return redirect(admin_url('activity'))->withMessage('开启成功！');
    }

    public function getDisable( $id ){
        $activity = Activity::find( $id );

        $activity->enable = "no";
        $activity->update();
        return redirect(admin_url('activity'))->withMessage('停止成功！');
    }

}