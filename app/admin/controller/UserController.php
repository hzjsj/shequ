<?php

namespace app\admin\controller;

use cmf\controller\AdminBaseController;

use think\Db;

use cmf\lib\Upload;

class UserController extends AdminBaseController
{

        public function index(){
        $param = $this->request->param();
        if (isset($param['is_ajax'])) {
            /*$org_info = session('org_info');
            $groups = Db::name('group_user')->where(array('org_id'=>1))->select();
            $groups_arr = k_array_sonArr($groups,$param['group_id'],'parent_id');
            if ($param['group_id'] == -1) {
                $where = array('id'=>array('gt',0));
            } else {
                $where = array('group_id'=>array('in',$groups_arr));
            }*/

            if ($param['limit']>100) {
                $limit = 100;
            } else {
                $limit = $param['limit'];
            }
            
            // $where['status'] = 1;
             // $where['user_type'] = 1;
             $where['id'] = ['>',0];
            if (isset($param['keywords'])) {
                $keywords = $param['keywords'];
                $where['user_login|user_nickname'] = ['like','%'.$keywords.'%'];
            }

            $user_select = Db::name('user')
                ->where($where)
                ->order('id desc')
                ->paginate($limit)
                ->toArray();
            foreach ($user_select['data'] as $key => $value) {
                $user_select['data'][$key]['avatar_new'] =$value['avatar']? cmf_get_user_avatar_url($value['avatar']):'';
                switch ($value['sex']) {
                    case '0':
                        $user_select['data'][$key]['sex_new'] = '未知';
                        break;
                    case '1':
                        $user_select['data'][$key]['sex_new'] = '男';
                        break;
                    case '2':
                        $user_select['data'][$key]['sex_new'] = '女';
                        break;
                    
                    default:
                        $user_select['data'][$key]['sex_new'] = '未知';
                        break;
                }
            }
            $return_data = array(
                'code'=>0,
                'count'=>$user_select['total'],
                'data'=>$user_select['data']
            );
            return json($return_data);
        } else {
            return $this->fetch();
        }
            
    }

      //添加管理员
    public function addguanli()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $user = ['user_nickname'=>$param['nickname'],
            'user_pass'=>cmf_password($param['pass']),'user_login'=>$param['login'],'user_email'=>$param['email']
            ,'sex'=>$param['sex'],'user_type'=>'1'];
            $r = Db::name('user')->insert($user);
            if($r){
                $this->success('添加成功！');
            } else {
                $this->error('添加失败！');
            }
        }else{
          return $this->fetch();   
        }    
    }

    //个人中心
    public function grzx()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();

            $user = ['id'=>$param['id'],'user_nickname'=>$param['nickname']
            ,'user_email'=>$param['email'],'avatar'=>$param['image']];
            $r = Db::name('user')->update($user);
            if($r){
                $this->success('修改成功！');
            } else {
                $this->error('修改失败！');
            }
        }else{
          return $this->fetch();   
        }    
    }

    //用户修改密码
    public function xgmm()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if($param['pass']==cmf_password($param['pass1'])){
            if($param['password']==$param['password1']){
             $user = ['id'=>$param['id'],
            'user_pass'=>cmf_password($param['password'])];
            $r = Db::name('user')->update($user);
            if($r){
                $this->success('修改成功！');
            } else {
                $this->error('修改失败！');
            }
        }else{
            $this->error('两次密码不一样！');
            }
        }
    }else{
        return $this->fetch();   
        }    
    }


     //修改更新管理员信息
     public function editguanli()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $user = ['id'=>$param['id'],'sex'=>$param['sex'],'user_nickname'=>$param['nickname'],'user_login'=>$param['login'],'user_email'=>$param['email']];
            if (!empty($param['pass'])) {

               $user['user_pass']=cmf_password($param['pass']);
            }
            $r = Db::name('user')->update($user);
        if (!empty($param['group_id'])) {
            $x=   Db::name('group_access')->where('uid',$param['id'])->find();
            if ($x) {
            $y=   Db::name('group_access')->where('uid',$param['id'])->update(['group_id' => $param['group_id']]);
            }else{
            $y=   Db::name('group_access')->insert(['group_id' => $param['group_id'],'uid' => $param['id']]);
           }
        }
           if ($r or $y) {
               $this->success('修改成功！');
           }else{
               $this->error('修改失败！');
           }

                
        }else{
            $param = $this->request->param();
            $data=Db::name('user')->where('id',$param['id'])->find();
            $group_id = Db::name('group_access')->where('uid',$param['id'])->value('group_id');
            $this->assign('data',$data);
            $this->assign('group_id',$group_id);
            $this->getrole();
          return $this->fetch();   
        }    
    }

    //删除管理员和其对应权限
     public function delguanli(){
        $param = $this->request->param();
        $result =  Db::name('user')->delete($param['id']);
        Db::name('group_access')->where('uid',$param['id'])->delete();
            if ($result) {
                $this->success('删除成功');// code = 1 
            }else{
                $this->error('删除失败');// code = 0
            }
        }
        public function getrole(){
        $group=Db::name('group')->select();
        $this->assign('group',$group);
    }

    //基本资料
    public function info()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();

            $user = ['id'=>$this->admin_user_info['id'],'user_nickname'=>$param['user_nickname'],'mobile'=>$param['mobile'],'signature'=>$param['signature']
            ,'user_email'=>$param['user_email'],'avatar'=>$param['image']];
            $r = Db::name('user')->update($user);
            if($r){
                $this->success('修改成功！');
            } else {
                $this->error('修改失败！');
            }
        }else{            
             $info=Db::name('user')->where(['id'=>$this->admin_user_info['id']])->find();
            $info['avatar_src']=cmf_get_user_avatar_url($info['avatar']);
            $this->assign('info',$info);
          return $this->fetch();   
        }  
    }

    //修改密码
    public function password()
    {
        return $this->fetch();     
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