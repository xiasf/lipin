<?php
namespace app\index\controller;

use think\Db;
use think\Request;

class Index extends Base
{

    public function test(Request $request)
    {
        if ($request->isPost()) {
            echo '<pre>';
            print_r($_FILES);
            echo '</pre>';
            $file = $request->file('logo');
            if (!empty($file)) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->validate(['ext' => 'jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');

                if ($info) {
                    // $this->success('文件上传成功：' . $info->getRealPath());
                    $data['logo'] = str_replace('\\', '/', $info->getSaveName());
                    echo $info->getRealPath(). '<br />';
                } else {
                    // 上传失败获取错误信息
                    $this->error($file->getError());
                }
            }

            $file2 = $request->file('video');var_dump($file2);
            if (!empty($file2)) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info2 = $file2->validate(['ext' => 'mp4'])->move(ROOT_PATH . 'public' . DS . 'uploads');

                if ($info2) {
                    // $this->success('文件上传成功：' . $info2->getRealPath());
                    $data['video'] = str_replace('\\', '/', $info2->getSaveName());
                    echo $info2->getRealPath();
                } else {
                    // 上传失败获取错误信息
                    $this->error($file2->getError());
                }
            }

        } else {
            return $this->fetch('test');
        }
    }

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

            // return $request->post();
            $data = $request->post();
            if (($data['end'] && $data['begin']) && ($data['end'] > $data['begin'])) {

                // 获取上一批次的最后一个标签号
                $_info = Db::name('info')->field('end')->order('id desc')->find();
                // 开始必须大于上一批次的结束
                if ($data['begin'] <= $_info['end']) {
                    $this->error('必须从上一批次开始！');
                }

            } else {
                $this->error('起止填写错误！');
            }

            // 获取表单上传文件
            $file = $request->file('pic');
            if (!empty($file)) {
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

            $file2 = $request->file('video');
            if (!empty($file2)) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info2 = $file2->validate(['ext' => 'mp4'])->move(ROOT_PATH . 'public' . DS . 'uploads');

                if ($info2) {
                    // $this->success('文件上传成功：' . $info2->getRealPath());
                    $data['video'] = str_replace('\\', '/', $info2->getSaveName());
                } else {
                    // 上传失败获取错误信息
                    $this->error($file2->getError());
                }
            }
            $data['create_time'] = time();
            $res = Db::name('info')->insert($data);
            if ($res) {
                $this->success('添加成功！');
            } else {
                $this->error('添加失败！');
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

            // 获取表单上传文件
            $file2 = $request->file('video');
            if ($file2) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info2 = $file2->validate(['ext' => 'mp4'])->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info2) {
                    // $this->success('文件上传成功：' . $info2->getRealPath());
                    $data['video'] = str_replace('\\', '/', $info2->getSaveName());
                } else {
                    // 上传失败获取错误信息
                    $this->error($file2->getError());
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

    // 查看产品视频
    public function productVideo(Request $request)
    {
        $id = $request->param('id/d');
        $info = Db::name('info')->find($id);
        if (!$info) {
            $this->error('信息不存在！');
        }
        $this->assign('info', $info);
        return $this->fetch('product-video');
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


    public function deviceAdd(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();
            $data['create_time'] = time();
            $res = Db::name('device')->insert($data);
            if ($res) {
                $this->success('添加成功！');
            } else {
                $this->error('添加失败！');
            }
        } else {
            return $this->fetch('device-add');
        }
    }

    public function deviceList()
    {
        $list = Db::name('device')->order('id', 'desc')->paginate(50);
        $this->assign('list',$list);
        return $this->fetch('device-list');
    }

    public function deviceUpdate(Request $request)
    {
        if ($request->isPost()) {
            $data['create_time'] = time();
            $res = Db::name('device')->where('id', $id)->update($data);
            $this->success('更新成功！');
        } else {
            $device = Db::name('device')->find($id);
            if (!$device) {
                $this->error('信息不存在！');
            }
            $this->assign('info',$device);
            return $this->fetch('device-update');
        }
    }


    // 验证日志列表
    public function validationLogList()
    {
        $list = Db::name('validation_log')->order('id', 'desc')->paginate(50);
        $this->assign('list',$list);
        return $this->fetch('validation-log-list');
    }

}
