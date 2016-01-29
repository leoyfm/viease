<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Menu\CreateRequest;
use Overtrue\Wechat\MenuItem;
use App\Http\Controllers\Controller;
use App\Services\LuckMoney;
use Overtrue\Wechat\Auth;
use Illuminate\Http\Request;

/**
 * 菜单管理.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class HongBaoController extends Controller
{


    /**
     * construct.
     *
     * @param MenuRepository $menu
     */

    /** * 菜单. */
    public function getIndex() {
        return admin_view('hongbao.index');
    }


    public function getSendHongbao(LuckMoney $service){

        $service->send('oQQ2Ctwsn4_7DLMnxK6jsrxkHLlg',32,1, $this->account() );

    }

    public function getAuth(){

        $auth = new Auth( $this->account()->app_id, $this->account()->app_secret);

        session_start();
        if (empty($_SESSION['logged_user'])) {

            dd('dd');
            $user = $auth->authorize(); // 返回用户 Bag
            $_SESSION['logged_user'] = $user->all();
            // 跳转到其它授权才能访问的页面
        } else {
            $user = $_SESSION['logged_user'];
        }

        var_dump($user['openid']);

    }




}
