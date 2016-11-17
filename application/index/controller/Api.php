<?php
namespace app\index\controller;

use think\Db;
use think\Request;

class Api extends \think\Controller
{

    public function recordGetdata(Request $request)
    {
        $imei = $request->get('imei/s');
        $arr = Db::name('validation_log')->field('color,tagid,create_time,result')->where('imei', $imei)->order('id', 'desc')->limit(100)->select();
        foreach ($arr as &$value) {
            $value['tagid'] = $value['tagid'];
            $value['date']  = date('m月d', $value['create_time']);
            $value['time']  = date('H:i', $value['create_time']);
        }
        return json($arr, 200, ['Cache-control' => 'no-cache,must-revalidate']);
    }

    public function ver(Request $request)
    {
        $info = Db::name('release')->order('id', 'desc')->find();
        $arr  = [
          'ver' => $info['ver'],
          'apk' => $request->root(true) . '/ApkRelease/' . $info['url'],
          'size' => $info['size'],
          'text' => $info['text'],
          'imei' => $request->get('imei/s'),
          'tel' => $request->get('tel/s'),
        ];
        return json($arr, 200, ['Cache-control' => 'no-cache,must-revalidate']);
    }

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
            $getID        = $request->post('tagid/s');        //标签ID
            $getImei      = $request->post('imei/s');         //手机序号
            $getToken     = $request->post('token');        //授权码
            $getLatitude  = $request->post('latitude');     //纬度
            $getLongitude = $request->post('longitude');    //经度
            $getTel       = $request->post('tel');    //tel

            if ($this->deviceCheck($getImei)) {
                // 得到满足条件的批次
                if (!empty($getID) && ($info = Db::name('tag')->alias('t')->join('__INFO__ i', 't.pid = i.id')->where(['t.tagid' => $getID, 't.status' => 1])->find())) {
                    $arr = [
                        "logo"    => $request->root(true) . '/uploads/' . $info['logo'],
                        "video"   => $request->root(true) . '/uploads/' . $info['video'],
                        "pic"     => array_map(function($map) use($request) {return $request->root(true) . '/uploads/' . $map;}, explode(',' ,$info['pic'])),
                        "content" => $info['content']
                    ];
                    $arr['result'] = 'PASS（通过）';
                    $arr['color']  = '#1290CF';
                } else {
                    $arr['result']  = 'Failed to pass（不通过）';
                    $arr['color']   = '#C10000';
                    $arr['logo']    = 'http://lipin.uogo8.com/no/logo.png';
                    $arr['pic']     = ['http://lipin.uogo8.com/no/label.jpg'];
                    $arr['content'] = '非常抱歉，该物品暂时找不到验证信息。可能是伪品，请与官方联系！';
                    $arr['video']   = '';
                }
            } else {
                $arr['result']  = '手机未解锁';
                $arr['color']   = '#C10000';
                $arr['logo']    = 'http://lipin.uogo8.com/no/logo.png';
                $arr['pic']     = ['http://lipin.uogo8.com/no/phone.jpg'];
                $arr['content'] = '该手机未经授权，请与官方取得联系授权解锁后方可使用';
                $arr['video']   = '';
            }

            $arr['tagid'] = $getID;
            $arr['imei'] = $getImei;
            $arr['tel'] = $getTel;

            $arr['date'] = date('Y-m-d H:i:s');
            // 记录日志
            Db::name('validation_log')->insert([
                'tagid'       => $getID,
                'imei'        => $getImei,
                'mobile'      => $getTel,
                'latitude'    => $getLatitude,
                'longitude'   => $getLongitude,
                'request_ip'  => $request->ip(true),
                'result'      => $arr['result'],
                'color'       => $arr['color'],
                'create_time' => time()
            ]);

            // 最后活跃时间
            Db::name('device')->where('imei', $getImei)->update(['active_time' => time()]);

            return json($arr, 200, ['Cache-control' => 'no-cache,must-revalidate']);
            // return json($data)->code(201)->header(['Cache-control' => 'no-cache,must-revalidate']);
        }
    }

}
