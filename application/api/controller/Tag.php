<?php
namespace app\api\controller;

class Tag
{

    public function get($id = 0)
    {
        if ($user) {
            return json($user);
        } else {
            return json(['error' => '用户不存在'], 404);
        }
    }

}
