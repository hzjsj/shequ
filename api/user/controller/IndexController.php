<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\user\controller;

use cmf\controller\RestBaseController;
use think\Validate;
use think\Db;
use api\user\model\UserModel;

class IndexController extends RestBaseController
{
    // 用户信息
    public function index()
    {
        $validate = new \think\Validate([
            'id' => 'require',
        ]);
        $validate->message([
            'id.require' => 'ID不能为空',
        ]);

        $param = $this->request->param();
        if (!$validate->check($param)) {
            $this->error($validate->getError());
        }
        $id = $param['id'];
        $user_find = Db::name('user')
            ->where(['id' => $id])
            ->field('user_pass',true)
            ->find();
        if (!isset($user_find)) {
            $this->error('用户不存在!');
        }
        $user_find['avatar'] = cmf_get_image_url($user_find['avatar']);

        unset($user_find['user_pass']);
        unset($user_find['user_name']);
        $this->success('ok',$user_find);
    }

    public function project()
    {
        $param = $this->request->param();
        
        if ($param) {
            $s = json_encode($param);
        } else {
            $s = '{"targets":[{"isStage":true,"name":"Stage","variables":{"`jEk@4|i[#Fk?(8x)AV.-my variable":["my variable",0]},"lists":{},"broadcasts":{},"blocks":{},"comments":{},"currentCostume":0,"costumes":[{"assetId":"cd21514d0531fdffb22204e0ec5ed84a","name":"backdrop1","md5ext":"cd21514d0531fdffb22204e0ec5ed84a.svg","dataFormat":"svg","rotationCenterX":240,"rotationCenterY":180}],"sounds":[{"assetId":"83a9787d4cb6f3b7632b4ddfebf74367","name":"pop","dataFormat":"wav","format":"","rate":48000,"sampleCount":1123,"md5ext":"83a9787d4cb6f3b7632b4ddfebf74367.wav"}],"volume":100,"layerOrder":0,"tempo":60,"videoTransparency":50,"videoState":"on","textToSpeechLanguage":null},{"isStage":false,"name":"Sprite1","variables":{},"lists":{},"broadcasts":{},"blocks":{},"comments":{},"currentCostume":0,"costumes":[{"assetId":"38d26eb1505eea192d9aa55672901e0a","name":"costume1","bitmapResolution":1,"md5ext":"38d26eb1505eea192d9aa55672901e0a.svg","dataFormat":"svg","rotationCenterX":47.67898252524472,"rotationCenterY":82.03457799759067},{"assetId":"e6ddc55a6ddd9cc9d84fe0b4c21e016f","name":"costume2","bitmapResolution":1,"md5ext":"e6ddc55a6ddd9cc9d84fe0b4c21e016f.svg","dataFormat":"svg","rotationCenterX":46,"rotationCenterY":53}],"sounds":[{"assetId":"83c36d806dc92327b9e7049a565c6bff","name":"Meow","dataFormat":"wav","format":"","rate":48000,"sampleCount":40681,"md5ext":"83c36d806dc92327b9e7049a565c6bff.wav"}],"volume":100,"layerOrder":1,"visible":true,"x":-143,"y":62,"size":100,"direction":90,"draggable":false,"rotationStyle":"all around"}],"monitors":[],"extensions":[],"meta":{"semver":"3.0.0","vm":"0.2.0-prerelease.20190430163103","agent":"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36"}}';
        }
        

        

        $s = json_decode($s);
        //header("Access-Control-Allow-Origin: http://localhost:8601");
        $header['Access-Control-Allow-Origin'] = 'http://localhost:8601';
        $header['Access-Control-Allow-Credentials'] = 'true';


        $header['Access-Control-Allow-Headers'] = 'X-Requested-With,Content-Type,XX-Device-Type,XX-Token';
        $header['Access-Control-Allow-Methods'] = 'GET,POST,PATCH,PUT,DELETE,OPTIONS';

        

        $this->returnD($s,$header);
    }

    public function getAvatarList()
    {
        $default = [
            'avatar/default/avatar_1.png',
            'avatar/default/avatar_2.png',
            'avatar/default/avatar_3.png',
            'avatar/default/avatar_4.png',
            'avatar/default/avatar_5.png',
            'avatar/default/avatar_6.png'
        ];
        foreach ($default as $value) {
            $def[] = cmf_get_image_url($value);
        }
        $this->success('ok',$def);
    }

}
