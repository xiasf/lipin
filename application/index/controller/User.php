<?php
namespace app\index\controller;

use think\Db;
use think\Request;

class User extends \think\Controller
{

    public function login(Request $request)
    {
    	if ($request->isPost()) {
    		$userName = $request->post('userName');
    		$password = $request->post('password');
    		if ($userName == 'root' && $password == 'root') {
    			$auth = array(
                    'uid'             => 1,
		            'username'        => $userName,
		            'last_login_time' => time(),
		        );
    			session('user_auth', $auth);
        		session('user_auth_sign', data_auth_sign($auth));
                $this->redirect('Index/index');
    		} else {
                $this->error('用户名或密码错误！');
            }
    	} else {
    		return $this->fetch();
    	}
    }

    public function logout() {
        session('user_auth', null);
        session('user_auth_sign', null);
        $this->success('已安全退出！', 'login');
    }
}
