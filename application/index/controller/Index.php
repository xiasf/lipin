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
            $file = $request->file('logo');var_dump($file);
            if (!empty($file)) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->validate(['ext' => 'jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');

                if ($info) {
                    // $this->success('文件上传成功：' . $info->getRealPath());
                    $data['logo'] = str_replace('\\', '/', $info->getSaveName());
                    echo '<br />'.$info->getRealPath(). '<br />';
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
	public function mapBaidu(Request $request){
		$data = [];
		$data["longitude"] = $request->param('longitude');
		$data["latitude"] = $request->param('latitude');
		$this->assign('data',$data);
		return $this->fetch("map-baidu");
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

            /*
             * 暂时停用起止
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
            */

            /*
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
            */

            // 获取表单上传文件
            $picList = request()->file('pic');
            if (!empty($picList)) {
                foreach ($picList as $file) {
                    // 移动到框架应用根目录/public/uploads/ 目录下
                    $info = $file->validate(['ext' => 'jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
                    if ($info) {
                        // 成功上传后 获取上传信息
                        // echo $info->getSaveName() . '<br />';
                        $data['pic'][] = str_replace('\\', '/', $info->getSaveName());
                    } else {
                        // 上传失败获取错误信息
                        // echo $file->getError() . '<br />';
                        $this->error($file->getError());
                    }
                }
                $data['pic'] = implode(',', $data['pic']);
            }

            $logoFile = $request->file('logo');
            if (!empty($logoFile)) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $logoFile->validate(['ext' => 'jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');

                if ($info) {
                    // $this->success('文件上传成功：' . $info->getRealPath());
                    $data['logo'] = str_replace('\\', '/', $info->getSaveName());
                } else {
                    // 上传失败获取错误信息
                    $this->error($logoFile->getError());
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
            $file = $request->file('logo');
            if ($file) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->validate(['ext' => 'jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
                if ($info) {
                    // $this->success('文件上传成功：' . $info->getRealPath());
                    $data['logo'] = str_replace('\\', '/', $info->getSaveName());
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

            $data['update_time'] = time();
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
        foreach ($list as $key => $value) {
            $list[$key] = array_merge($list[$key], ['cover' => (strpos($list[$key]['pic'], ',') !== false ? strstr($list[$key]['pic'], ',', true) : $list[$key]['pic']), 'pic_num' => substr_count($list[$key]['pic'], ',') + 1]);
        }

        $this->assign('list', $list);
        return $this->fetch('product-list');
    }

    public function productPic(Request $request)
    {
        $id = $request->param('id/d');
        $info = Db::name('info')->field('pic')->where('id', $id)->find();
        if (!$info) {
            $this->error('信息不存在！');
        }
        if (!empty($info['pic'])) {
            $picList = explode(',', $info['pic']);
        } else {
            $picList = [];
        }
        $this->assign('pic', $picList);
        $this->assign('id', $id);
        return $this->fetch('product-pic');
    }

    public function picUpload(Request $request)
    {

        // if ($request->isPost()) {
        //     // 获取表单上传文件
        //     $picList = request()->file('Filedata');
        //     if (!empty($picList)) {
        //         foreach ($picList as $file) {
        //             // var_dump( $file);
        //             // 移动到框架应用根目录/public/uploads/ 目录下
        //             $info = $file->validate(['ext' => 'gif,jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        //             if ($info) {
        //                 // 成功上传后 获取上传信息
        //                 // echo $info->getSaveName() . '<br />';
        //                 $picList[] = str_replace('\\', '/', $info->getSaveName());
        //             } else {
        //                 // 上传失败获取错误信息
        //                 // echo $file->getError() . '<br />';
        //                 $this->error($file->getError());
        //             }
        //         }
        //     }

        $logoFile = $request->file('Filedata');
        if (!empty($logoFile)) {
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $logoFile->validate(['ext' => 'jpg,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                // $this->success('文件上传成功：' . $info->getRealPath());
                $picList = str_replace('\\', '/', $info->getSaveName());
            } else {
                // 上传失败获取错误信息
                $this->error($logoFile->getError());
            }
        }
        echo $picList;
    }

    public function savePic(Request $request)
    {
        if ($request->isPost()) {
            $id = $request->post('id/d');
            $pic = $request->post('pic/s');
            Db::name('info')->where(['id' => $id])->update(['pic' => $pic, 'update_time' => time()]);
            return ['status' => 1, 'info' => '保存成功'];
        }
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
        return '停用';
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


    public function tagSend(Request $request)
    {
        if ($request->isPost()) {
            $id = $request->post('id/a');
            if (!empty($id)) {
                $db = Db::name('tag');
                foreach ($id as $value) {
                    $db->where(['id' => $value, 'status' => 0])->update(['status' => 1, 'update_time' => time()]);
                }
                return ['status' => 1, 'info' => '发布成功'];
            }
        }
    }



    public function tagAdd(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->post();

            if (!Db::name('info')->where('id', $data['pid'])->find()) {
                $this->error('资料库ID非法！');
            }

            if (Db::name('tag')->where('tagid', $data['tagid'])->find()) {
                $this->error('NFC标签ID已经存在！');
            }

            $data['create_time'] = time();
            $res = Db::name('tag')->insert($data);
            if ($res) {
                $this->success('添加成功！');
            } else {
                $this->error('添加失败！');
            }
        } else {
            $list = Db::name('info')->field('id,name')->order('id', 'desc')->limit(10)->select();
            $this->assign('list', $list);
            return $this->fetch('tag-add');
        }
    }

    public function tagList()
    {
        $list = Db::name('tag')->order('id', 'desc')->paginate(50);
        $this->assign('list',$list);
        return $this->fetch('tag-list');
    }

    public function tagUpdate(Request $request)
    {
        if ($request->isPost()) {
            $data['create_time'] = time();
            $res = Db::name('tag')->where('id', $id)->update($data);
            $this->success('更新成功！');
        } else {
            $tag = Db::name('tag')->find($id);
            if (!$tag) {
                $this->error('信息不存在！');
            }
            $this->assign('info',$tag);
            return $this->fetch('tag-update');
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
	public function deviceMaps(){
        $list = Db::name('device')->order('id', 'desc')->paginate(50);
        $this->assign('list',$list);
		return $this->fetch("device-maps");
	}
    public function deviceUpdate(Request $request)
    {
        $id = $request->param('id/d');
        if ($request->isPost()) {
            $data = $request->post();
            $data['create_time'] = time();
            $res = Db::name('device')->where('id', $id)->update($data);
            $this->success('更新成功！');
        } else {
            $device = Db::name('device')->find($id);
            if (!$device) {
                $this->error('信息不存在！');
            }
            $this->assign('info', $device);
            return $this->fetch('device-update');
        }
    }

    public function deviceDelete(Request $request)
    {
        if ($request->isPost()) {
            $id = $request->post('id/d');
            Db::name('device')->where('id', $id)->delete();
            return ['status' => 1, 'info' => '删除成功'];
        }
    }


    // 验证日志列表
    public function validationLogList()
    {
        $list = Db::name('validation_log')->order('id', 'desc')->paginate(50);
        $this->assign('list', $list);
        return $this->fetch('validation-log-list');
    }


    // 软件发布
    public function release(Request $request)
    {
        if ($request->isPost()) {

            $data = $request->post();

            // 获取表单上传文件
            $file = $request->file('apk');
            if (!empty($file)) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->validate(['ext' => 'apk'])->move(ROOT_PATH . 'public' . DS . 'ApkRelease');

                if ($info) {
                    $fileInfo = $info->getInfo();
                    // $this->success('文件上传成功：' . $info->getRealPath());
                    $data['url'] = str_replace('\\', '/', $info->getSaveName());
                    $data['size'] = $fileInfo['size'];
                    $data['md5'] = $info->md5();
                } else {
                    // 上传失败获取错误信息
                    $this->error($file->getError());
                }
            }

            $data['create_time'] = time();
            $res = Db::name('release')->insert($data);
            if ($res) {
                $this->success('发布成功！');
            } else {
                $this->error('发布失败！');
            }
        } else {
            return $this->fetch('release');
        }
    }


    // 软件发布记录
    public function releaseLog()
    {
        $list = Db::name('release')->order('id', 'desc')->paginate(50);
        $this->assign('list', $list);
        return $this->fetch('release-log-list');
    }

}
