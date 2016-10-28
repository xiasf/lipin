<?php
namespace app\index\controller;

use think\Db;
use think\Request;

class Base extends \think\Controller
{
    public function _initialize()
    {
    	var_dump($_GET);exit;
        if (!is_login() && (trim($_SERVER['PATH_INFO'], '/') != 'index/index/api')) {
			$this->error('请先登录哦！', 'User/login');
        }
    }
}
