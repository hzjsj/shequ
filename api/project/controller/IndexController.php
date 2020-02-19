<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\project\controller;

use cmf\controller\RestBaseController;
use think\Validate;
use think\Db;

class IndexController extends RestBaseController
{
    // 
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


        $project_find = Db::name('project_post')
            ->where(['id' => $id])
            ->find();
        if (!isset($project_find)) {
            $this->error('项目不存在!');
        }

        $s = json_decode($project_find['post_content']);

        $header['Access-Control-Allow-Origin'] = 'http://localhost:8601';
        $header['Access-Control-Allow-Credentials'] = 'true';


        $header['Access-Control-Allow-Headers'] = 'X-Requested-With,Content-Type,XX-Device-Type,XX-Token';
        $header['Access-Control-Allow-Methods'] = 'GET,POST,PATCH,PUT,DELETE,OPTIONS';

        $this->returnD($s,$header);

    }

    public function getinfo()
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

        $project_find = Db::name('project_post')
            ->where(['id' => $id])
            ->find();
        if (!isset($project_find)) {
            $this->error('项目不存在!');
        }
        

        $this->success('ok',$project_find);
    }

    public function edit()
    {
        if (!$this->userId) {
            $this->error('异常错误!');
        } 
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
        $post_content = file_get_contents("php://input");


        $r = Db::name('project_post')
            ->where(['id' => $id,'user_id'=>$this->userId])
            ->update(['post_content'=>$post_content]);
        if ($r) {
            $post_content = json_decode($post_content);

            $this->returnD($post_content);
        } 
        
        
    }


    public function create()
    {
        if (!$this->userId) {
            $this->error('异常错误!');
        } 
        $vm = file_get_contents("php://input");
        $post_content = json_encode(json_decode($vm));
        //var_dump($vm);die;
        $data = [
            'user_id' => $this->userId,
            'post_content'=>$post_content
        ];
        Db::name('project_post')->insert($data);
        $projectId = Db::name('project_post')->getLastInsID();
        
        $returnD['autosave-interval'] = 120;
        $returnD['content-name'] = $projectId;
        $returnD['content-title'] = "VW50aXRsZWQtMTI=";
        $returnD['status'] = "ok";

        

        $this->returnD($returnD);
    }



    public function editinfo()
    {
        if (!$this->userId) {
            $this->error('异常错误!');
        } 
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
        $title = $param['title'];
        $thumbnailUrl = $param['thumbnailUrl'];

        if ($thumbnailUrl) {
            $project_post_find = Db::name('project_post')
                ->where(['id' => $id,'user_id'=>$this->userId])
                ->find();
            if ($project_post_find['thumbnail']) {
                $path = '../upload/'.$project_post_find['thumbnail'];
                if (file_exists($path)) {
                    unlink($path);
                }
                
                
            }
        }
        


        Db::name('project_post')
            ->where(['id' => $id,'user_id'=>$this->userId])
            ->update(['post_title'=>$title,'thumbnail'=>$thumbnailUrl]);
        

        $this->success('ok');
    }


    public function projectlist()
    {
        if (!$this->userId) {
            $this->error('异常错误!');
        } 
        $validate = new \think\Validate([
            'page' => 'require',
        ]);
        $validate->message([
            'page.require' => 'page不能为空',
        ]);

        $param = $this->request->param();
        if (!$validate->check($param)) {
            $this->error($validate->getError());
        }

        $data = Db::name('project_post')
            ->where(['user_id'=>$this->userId])
            ->order('id desc')
            ->paginate(9)
            ->toArray();
        
        foreach ($data['data'] as $key => $value) {
            $thumbnail = cmf_get_image_url($value['thumbnail']);
            $data['data'][$key]['thumbnail'] = $thumbnail;
        }


        $this->success('ok',$data);
    }

}
