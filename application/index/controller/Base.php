<?php
namespace app\index\controller;

use think\Db;
use think\Request;

class Base extends \think\Controller
{
    public function _initialize()
    {
        if (!is_login()) {
        	if (!empty($_SERVER['PATH_INFO']) && trim($_SERVER['PATH_INFO'], '/') != 'index/index/api') {
        		// api无需登录
        	} else {
				$this->error('请先登录哦！', 'User/login');
			}
        }
    }
}
