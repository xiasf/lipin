<?php
namespace app\index\controller;

use think\Db;
use think\Request;

class Api extends \think\Controller
{

    public function api()
    {
        $db = Db::name('info');
        // 获取所有发布中的
        $res = $db->where('status', 1)->select();
        if ($res) {
            // 加入当前版本号
            $ver = include 'ver.php';
            $res = array_merge($ver, $res);
        }
        return json($res);
    }

    public function deviceCheck($imei)
    {
        if ($info = Db::name('device')->where(['imei' => $imei, 'status' => 1])->find()) {
            return true;
        } else {
            return false;
        }
    }

    public function validPost(Request $request)
    {
        if ($request->isPost()) {
            $getID        = $request->post('tagid/d');        //标签ID
            $getImei      = $request->post('imei/s');         //手机序号
            $getToken     = $request->post('token');        //授权码
            $getLatitude  = $request->post('latitude');     //纬度
            $getLongitude = $request->post('longitude');    //经度

            if ($this->deviceCheck($getImei)) {
                // 得到满足条件的批次
                if ($info = Db::name('info')->where('end', '>=', $getID)->order('id', 'asc')->find()) {
                    $arr['result'] = 'PASS(通过）';
                    $arr['color']  = '#1290CF';
                    $arr = [
                        "video"   => $info['video'],
                        "pic"     => explode(',' ,$info['pic']),
                        "content" => $info['content']
                    ];
                } else {
                    $arr['result'] = 'Failed to pass（不通过）';
                    $arr['color']  = '#C10000';
                    $arr['logo']   = 'http://lipin.uogo8.com/no/logo.png';
                    $arr['pic']    = ['http://lipin.uogo8.com/no/label.jpg'];
                    $arr['content'] = 'Failed to pass（不通过）';
                    $arr['video'] = '';
                }
            } else {
                $arr['result'] = '手机非官方指定';
                $arr['color']  = '#C10000';
                $arr['logo']   = 'http://lipin.uogo8.com/no/logo.png';
                $arr['pic']    = ['http://lipin.uogo8.com/no/phone.jpg'];
                $arr['content'] = '手机非官方指定，请与官方取得联系授权';
                $arr['video'] = '';
            }

            $arr['tagid'] = $getID;
            $arr['imei'] = $getImei;

            $arr['date'] = date('Y-m-d H:i:s');
            // 记录日志
            Db::name('validation_log')->insert([
                'tagid'       => $getID,
                'imei'        => $getImei,
                'latitude'    => $getLatitude,
                'longitude'   => $getLongitude,
                'request_ip'  => $request->ip(),
                'result'      => $arr['result'],
                'create_time' => time()
            ]);

            return json($arr, 200, ['Cache-control' => 'no-cache,must-revalidate']);
            // return json($data)->code(201)->header(['Cache-control' => 'no-cache,must-revalidate']);
        }
    }

}
