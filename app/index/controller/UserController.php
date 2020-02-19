<?php
namespace app\index\controller;
use cmf\controller\HomeBaseController;
use think\Db;
use cmf\lib\Upload;
class UserController extends HomeBaseController 
{   
    public function _initialize(){


        $user_info = session('user_info');
        if (empty($user_info)) {
           $this->error("请先登入",url("index/login/login"));
           //$this-> redirect(url("index/login/login"));
         }
    }

        public function addproject()
    {
        if ($this->request->isPost()) {
          
            $param = $this->request->param();
            $project = ['title'=>$param['title'],
            'url'=>$param['url'],'content'=>$param['content']
            ,'desc'=>$param['desc'],'image'=>$param['image'],'create_time'=>time(),'update_time'=>time(),'uid'=>session('user_info')['id']];
            $r = Db::name('project')->insert($project);
            if($r){
                $this->success('发布成功！');
            } else {
                $this->error('发布失败！');
            }
        }else{
          return $this->fetch();   
        }    
    }

           public function editproject()
    {
        $param = $this->request->param();
        if ($this->request->isPost()) {
            $project = ['id'=>$param['id'],'title'=>$param['title'],
            'url'=>$param['url'],'content'=>$param['content']
            ,'desc'=>$param['desc'],'image'=>$param['image'],'update_time'=>time()];
            $r = Db::name('project')->update($project);
            if($r){
                $this->success('修改成功！');
            } else {
                $this->error('修改失败！');
            }
        }else{
            $data=Db::name('project')->where('id',$param['id'])->find();
            $this->assign('data',$data);
          return $this->fetch();   
        }    
    }
      //删除作品
         public function delproject(){
            $param = $this->request->param();
            $result =  Db::name('project')->delete($param['id']);
                if ($result) {
                    $this->success('删除成功');// code = 1 
                }else{
                    $this->error('删除失败');// code = 0
                }
            }

     public function addly()
    {
        if ($this->request->isPost()) {
          
            $param = $this->request->param();
            $comment = ['comment'=>$param['comment'],
            'pid'=>$param['pid'],'status'=>1,'create_time'=>time(),'uid'=>session('user_info')['id']];
            $r = Db::name('comment')->insert($comment);
            if($r){
                $this->success('留言成功！');
            } else {
                $this->error('留言失败！');
            }
        }else{
          return $this->fetch();   
        }    
    }



     public function my()
    {   
         $project=Db::name('project')->where('uid',session('user_info')['id'])->select();
          foreach ($project as $key => $value) {
         $project[$key]['update']= date('Y-m-d H:i:s', $value['update_time']); 
        }
        $this->assign('project',$project);
        return $this->fetch();
    }


    public function info(){
         $user_info=session('user_info');
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $info = ['id'=>$user_info['id'],'user_nickname'=>$param['nickname'],'sex'=>$param['sex'],'avatar'=>$param['image'],'mobile'=>$param['cellphone'],'user_email'=>$param['email'],'signature'=>$param['remarks']];
            $r = Db::name('user')->update($info);
            if($r){
                $this->success('修改成功！');
            } else {
                $this->error('修改失败！');
            }
        }else{
          $this->assign('user_info',$user_info);
          return $this->fetch();   
        }    
    }



     public function password()
    {
        if ($this->request->isPost()) {
          
            $param = $this->request->param();
            $user_info=session('user_info');
            if (cmf_password($param['oldPassword'])==$user_info['user_pass']) {
            $r=Db::name('user')->where('id', $user_info['id'])->update(['user_pass'=>cmf_password($param['password'])]);
            if($r){
                $this->success('修改成功！');
            } else {
                $this->error('修改失败！');
            }
        }else{
             $this->error('旧密码错误！');
        }
        }else{
          return $this->fetch();   
        }    
    }


        /**
     * webuploader 上传
     */
    public function webuploader()
    {
        if ($this->request->isPost()) {
            $uploader = new Upload();

            $result = $uploader->upload();

            if ($result === false) {
                $this->error($uploader->getError());
            } else {
                $this->success("上传成功!",'',$result);
            }

        } 
    }
}
