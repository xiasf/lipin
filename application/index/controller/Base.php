<?php
namespace app\index\controller;

use think\Db;
use think\Request;

class Base extends \think\Controller
{
    public function _initialize()
    {
        if (!is_login()) {
			$this->redirect('User/login');
        }
    }
}
