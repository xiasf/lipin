<?php
namespace app\index\controller;

use think\Db;
use think\Request;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome()
    {
        return $this->fetch();
    }

    public function productAdd(Request $request)
    {
    	if ($request->isPost()) {

    		// var_dump($res);

    		// return $request->post();
			$data = $request->post();
			if (($data['end'] && $data['begin']) && ($data['end'] > $data['begin'])) {

			} else {
				$this->error('起止填写错误！');
			}

			// 获取表单上传文件
	        $file = $request->file('pic');
	        if (empty($file)) {
	            $this->error('请选择上传文件');
	        }
	        // 移动到框架应用根目录/public/uploads/ 目录下
	        $info = $file->validate(['ext' => 'jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
	        if ($info) {
	            // $this->success('文件上传成功：' . $info->getRealPath());
				$data['pic'] = str_replace('\\', '/', $info->getSaveName());
				$data['create_time'] = time();
    			$res = Db::name('info')->insert($data);
    			$this->success('添加成功！');
	        } else {
	            // 上传失败获取错误信息
	            $this->error($file->getError());
	        }
    	} else {
    		return $this->fetch('product-add');
    	}
    }

    public function productUpdate(Request $request)
    {
    	$id = $request->param('id/d');

    	if ($request->isPost()) {
			$data                = [];
			$data['name']        = $request->post('name');
			$data['content']     = $request->post('content');
			$data['update_time'] = time();

			// 获取表单上传文件
	        $file = $request->file('pic');

	        if ($file) {
	        	// 移动到框架应用根目录/public/uploads/ 目录下
	        	$info = $file->validate(['ext' => 'jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
	        	if ($info) {
		            // $this->success('文件上传成功：' . $info->getRealPath());
					$data['pic'] = str_replace('\\', '/', $info->getSaveName());
		        } else {
		            // 上传失败获取错误信息
		            $this->error($file->getError());
		        }
		    }

			$data['create_time'] = time();
    		$res = Db::name('info')->where('id', $id)->update($data);
    		$this->success('更新成功！');
    	} else {
			$info = Db::name('info')->find($id);
			if (!$info) {
				$this->error('信息不存在！');
			}
    		$this->assign('info',$info);
        	return $this->fetch('product-update');
    	}
    }

    public function productList()
    {
    	// $list = UserModel::paginate(3);

    	$list = Db::name('info')->order('id', 'desc')->paginate(50);
    	$this->assign('list',$list);
        return $this->fetch('product-list');
    }

    public function productSend(Request $request)
    {
    	$id = $request->post('id/a');
    	if (!empty($id)) {
    		$db = Db::name('info');
    		// 把先前所有发布中的变成已发布
    		$db->where(['status' => 1])->update(['status' => 2, 'release_time' => time()]);
    		// 把当前所有选中的变成发布中……
	    	foreach ($id as $value) {
	    		$db->where(['id' => $value, 'status' => 0])->update(['status' => 1, 'release_time' => time()]);
	    	}
	    	// 版本+1
	    	ver();
    		return ['status' => 1, 'info' => '发布成功'];
    	}
    }

    public function api() {
    	$db = Db::name('info');
    	// 获取所有发布中的
    	$res = $db->where('status', 1)->select();
    	// 加入当前版本号
    	$ver = include 'ver.php';
    	$res = array_merge($ver, $res);
    	return json($res);
    }
}
