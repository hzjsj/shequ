<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\library\controller;

use cmf\controller\RestBaseController;
use think\Validate;
use think\Db;

use api\library\model\LibraryPostModel;

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


        $library_find = Db::name('library_post')
            ->where(['post_id' => $id])
            ->field('post_id,file_path,suffix')
            ->find();
        if (!isset($library_find)) {
            echo "404";die;
        }

        switch ($library_find['suffix']) {
          case 'wav':
            $ContentType = 'audio/wav';
            $type = 'audio';
            break;
          case 'svg':
            $ContentType = 'image/svg+xml';
            $type = 'image';
            break;
          case 'png':
            $ContentType = 'image/png';
            $type = 'image';
            break;
          case 'jpg':
            $ContentType = 'image/jpeg';
            $type = 'image';
            break;
          case 'jpeg':
            $ContentType = 'image/jpeg';
            $type = 'image';
            break;
        }
        
        $post_content = file_get_contents('../upload/'.$library_find['file_path']);
        $returnD = $post_content;
        $header['Content-Type'] = $ContentType;
        $header['Accept-Ranges'] = 'bytes';
        $header['Content-Length'] = strlen($returnD);

        $this->returnD($returnD,$header,$type);
    }

    public function create()
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
        $idInfo = explode('.',$id);
        $post_content = file_get_contents("php://input");

        $date = date('Ymd');

        $save_path = 'library/'.$date.'/'.$id;

        $path = '../upload/'.$save_path;



        $pathmk = '../upload/library/'.$date;
        if (!file_exists($pathmk)) {
            mkdir ( $pathmk, 0777, true );
        }

        $myfile = fopen($path, "w");
        fwrite($myfile, $post_content);
        fclose($myfile);


        $data = [
            'user_id' => $this->userId,
            'post_id' => $id,
            //'post_content'=>$post_content,
            'suffix'=>$idInfo[1],
            'file_path'=>$save_path
        ];

        Db::name('library_post')->insert($data);
        
        $returnD['status'] = 'ok';
        $returnD['content-name'] = $id;

        $this->returnD($returnD);
    }


    public function libraryList()
    {
        if (!$this->userId) {
            $this->error('异常错误!');
        } 

        $validate = new \think\Validate([
            'type' => 'require',
        ]);
        $validate->message([
            'type.require' => 'type不能为空',
        ]);
        $param = $this->request->param();
        if (!$validate->check($param)) {
            $this->error($validate->getError());
        }

        $type = $param['type'];
        //$tag = $param['tag'];
        //$keywords = $param['keywords'];

        $library_select = Db::name('library_post')
            ->where(['post_type'=>$type,'post_status'=>1])
            ->paginate(30)
            ->toArray();
        foreach ($library_select['data'] as $key => $value) {
            $data_arr[] = json_decode($value['more']);
        }

        $library_select['data'] = !empty($data_arr) ? $data_arr : [] ;

        $this->success('ok',$library_select);

    }


    public function libraryTagList()
    {
        if (!$this->userId) {
            $this->error('异常错误!');
        } 

        $validate = new \think\Validate([
            'type' => 'require',
        ]);
        $validate->message([
            'type.require' => 'type不能为空',
        ]);
        $param = $this->request->param();
        if (!$validate->check($param)) {
            $this->error($validate->getError());
        }

        $type = $param['type'];

        $library_tag_select = Db::name('library_tag')
            ->where(['tag_type'=>$type,'tag_status'=>1,'status'=>1])
            ->select();


        $this->success('ok',$library_tag_select);
    }

}
