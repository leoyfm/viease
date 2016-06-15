<?php
/**
 * Created by PhpStorm.
 * User: LEO
 * Date: 1/22/16
 * Time: 12:58 PM
 */

namespace App\Http\Controllers\Activity;

use App\Events\UnSubscribe;
use App\Http\Controllers\Controller;
use app\Models\Activist;
use App\Models\Fan;
use App\Repositories\ActivityRepository;
use App\Services\Account as AccountService;
use App\Services\Activity as ActivityService;
use App\Services\OSS;
use Illuminate\Http\Request;
use Overtrue\Wechat\Js;
use Qiniu\Auth;
use App\Models\Activist as AModel;


class NianHuoController extends Controller
{
	const ACT_NUM = 3;

	private $account;

	/**
	 * @var ActivityService
	 */
	private $service;

	private $js;

	private $auth;

	private $bucket = 'nianhuo';

	/**
	 * @var Fan
	 */
	private $current_user;

	public function __construct(AccountService $as, Request $request)
	{
		$as->chose(3);
		$this->account = $this->account();
		$this->service = new ActivityService(self::ACT_NUM);
		$this->current_user = $request->session()->get('logged_user');
		$this->js = new Js($this->account->app_id, $this->account->app_secret);
//        $this->current_user = Fan::find(6);
		//qiniu
		$this->auth = new Auth('RNzC5Ruc8caDer_YwWux7OMK3jq3GJGf5AxxlIEV', '3C49Pwt3qKh85LLwL_rB81N3ZQKLEalQvBUt8qN5');

	}

	public function index()
	{


		return activity_view('nianhuo.index1', ['participarts' => $this->service->getLatestParticipators(), 'js' => $this->js, 'cuser' => $this->current_user]);
	}

	public function join(Request $request)
	{

		$user = $this->current_user;

		$path = 'activity/nianhuo/img/';
		if ($request->isMethod('post')) {
			$data = array();

			$data['pic'] = $request->input('file1');
			$data['activity_id'] = self::ACT_NUM;
			$data['name'] = $request->input('name');
			$data['tel'] = $request->input('tel');
			$data['user_id'] = $user->id;
			$data['remark'] = $request->input('msg');
			$activist = $this->service->addActivist($data);

			if ($activist) {
				return activity_view('nianhuo.success');
			} else {
				return '上传文件失败';
			}
		}
		return activity_view('nianhuo.join1', ['js' => $this->js, 'cuser' => $this->current_user]);
	}

	public function content($id)
	{
		$js = new Js($this->account->app_id, $this->account->app_secret);

		$voters = $this->service->getLatestVoters($id);

		$c_user_tickets = $this->service->getVoterTicket($this->current_user->id);

		return activity_view('nianhuo.content', ['voters' => $voters, 'user' => $this->service->getParticipator($id), 'js' => $js, 'cuser' => $this->current_user, 'service' => $this->service, 'num_ticket' => $c_user_tickets]);
	}

	public function most()
	{

		$users = $this->service->getTopParticipators(30);
		return activity_view('nianhuo.most', ['users' => $users, 'js' => $this->js, 'cuser' => $this->current_user]);
	}

	public function vote($id, Request $request)
	{
		$result = $this->service->vote($id, $this->current_user->id);

		if ($result) {
			return activity_view('nianhuo.success');
		} else {
			return redirect()->action('Activity\NianHuoController@showTicket', ['id' => $this->current_user->id]);
		}
	}

	public function addTicket($id, Request $request)
	{
		if ($request->ajax()) {
			$result = $this->service->incrementVoteTicket($id);
			if ($request) {
				return response()->json(['result' => true]);
			} else {
				return response()->json(['result' => false]);
			}
		}
	}

	public function showTicket($id)
	{

		$num = $this->service->getVoterTicket($id);
		return activity_view('nianhuo.ticket', ['num' => $num]);
	}

	public function index1()
	{


		return activity_view('nianhuo.index1', ['participarts' => $this->service->getLatestParticipators(), 'js' => $this->js, 'cuser' => $this->current_user]);
	}

	public function test(Request $request)
	{

		$data = AModel::where('pid', null)->where('activity_id', 3)->orderBy('updated_at', 'desc')->paginate(3);

		dd($data);
		return activity_view('nianhuo.index1', ['participarts' => $this->service->getLatestParticipators(), 'js' => $this->js, 'cuser' => $this->current_user]);

		if ($request->isMethod('post')) {
			dd($request->all());
		}

		return activity_view('nianhuo.join1');
	}

	public function uploadUrl()
	{
//        $policy = array(
//            'callbackUrl' => 'http://vi.ponyhelp.com/activities/nianhuo/callback',
//            'callbackBody' => '{"fname":"$(fname)", "fkey":"$(key)", "desc":"$(x:desc)"}'
//        );

//        $upToken = $this->auth->uploadToken($this->bucket, null, 3600, $policy);
		$upToken = $this->auth->uploadToken($this->bucket, null, 3600);

		return response()->json(['uptoken' => $upToken])->header('Access-Control-Allow-Origin', '*');
	}

	public function callBack()
	{
		return 'ss';
	}

	public function statistic(Request $request)
	{
		$type = $request->input('type');

		$data = '';
//        switch( $type){
//            default:
//                Activist::where('activity_id',self::ACT_NUM )
//
//                break;
//        }
	}

	public function winner(Request $request ){
		$result = $this->service->getTopParticipators();

		return activity_view('nianhuo.winner',['users'=> $result]);
	}


}