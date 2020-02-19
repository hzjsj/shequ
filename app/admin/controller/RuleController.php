<?php

namespace app\Admin\controller;

use cmf\controller\AdminBaseController;

use think\Db;


class RuleController extends AdminBaseController
{

    
     public function index()
    {
        $param = $this->request->param();
        if (isset($param['is_ajax'])) {
            if ($param['limit']>100) {
                $limit = 100;
            } else {
                $limit = $param['limit'];
            }
            

            $where['id'] = ['>',0];
            if (isset($param['keywords'])) {
                $keywords = $param['keywords'];
                $where['yx_name'] = ['like','%'.$keywords.'%'];
            }

            $auth_rule_select = Db::name('rule')
                ->where($where)
                ->paginate($limit)
                ->toArray();
            $return_data = array(
                'code'=>0,
                'count'=>$auth_rule_select['total'],
                'data'=>$auth_rule_select['data']
            );
            return json($return_data);
        } else {
            return $this->fetch();
        }
            
    }

   //添加节点
    public function addrule()
    {
        $param = $this->request->param();
        if ($this->request->isPost()) {
            $auth_rule = ['name'=>$param['name'],'title'=>$param['title'],'pid'=>$param['pid']];
            $r = Db::name('rule')->insert($auth_rule);
            if($r){
                $this->success('添加成功');
            } else {
                $this->error('添加失败');
            }
        }else{
            $id = $param['id'];
            $auth_rule=Db::name('rule')->where('id',$id)->find();
            $getauth_rule=Db::name('rule')->select();
            $this->assign('auth_rule',$auth_rule);
            $this->assign('getauth_rule',$getauth_rule);
            return $this->fetch('addrule');   
        }    
    }


    public function editrule()
    {
        $param = $this->request->param();
        if ($this->request->isPost()) {
            $id = $param['id'];
            $data[$param['field']] = $param['value'];
            $update_return = Db::name("rule")
                    ->where('id', $id)
                    ->update($data);
            if (!$update_return) {
                $this->error('修改失败!');
            } else {
                $this->success('修改成功!');
            }
        } 
    }


    public function delrule()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $id = $param['id'];
            $count=Db::name('rule')->where('pid',$id)->count();
            if ($count>0) {
               $this->error('该分类下还有子分类，无法删除！!');
            }else{
            $delete_return = Db::name("rule")->delete($id);
            if (!$delete_return) {
                $this->error('删除失败!');
            } else {
                $this->success('删除成功!');
            }
            }
        }
    }

    //用户组
     public function role()
    {
        $param = $this->request->param();
        if (isset($param['is_ajax'])) {
            if ($param['limit']>100) {
                $limit = 100;
            } else {
                $limit = $param['limit'];
            }
            

            $where['id'] = ['>',0];
            if (isset($param['keywords'])) {
                $keywords = $param['keywords'];
                $where['yx_name'] = ['like','%'.$keywords.'%'];
            }

            $auth_rule_select = Db::name('group')
                ->where($where)
                ->paginate($limit)
                ->toArray();
              foreach ($auth_rule_select['data'] as $key => $value) {
              switch ($value['status']) {
                    case '0':
                        $auth_rule_select['data'][$key]['zt']='禁用';
                        break;
                    case '1':
                        $auth_rule_select['data'][$key]['zt']='正常';
                        break;
                   }
            }
            $return_data = array(
                'code'=>0,
                'count'=>$auth_rule_select['total'],
                'data'=>$auth_rule_select['data']
            );
            return json($return_data);
        } else {
            return $this->fetch();
        }
            
    }


    //获取权限表
    public function hqqx(){
       
        $data=Db::name('rule')->field('id,title')->where(['pid'=>0])->select();
        foreach ($data as $key => $value) {
            $data[$key]['children']=Db::name('rule')->field('id,title')->where(['pid'=>$value['id']])->select();
           foreach ($data[$key]['children'] as $keys => $values) {
            $data[$key]['children'][$keys]['children']=Db::name('rule')->field('id,title')->where(['pid'=>$values['id']])->select();
           }
        }

         $return = array(
            'code'=>0,
            'info'=>'ok',
            'data'=>$data
        );
         return json($return);  
    }

    //添加角色
     public function addrole()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $data=$param['role'];
            unset($param['role']);
            $data['rules']=implode(',', $param);
            $r = Db::name('group')->insert($data);
            if($r){
                $this->success('添加成功！');
            } else {
                $this->error('添加失败！');
            }
        }else{
          return $this->fetch();   
        }    
    }

    //修改更新角色
    public function editrole(){
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $data=$param['role'];
            unset($param['role']);
            $data['rules']=implode(',', $param);
            $r = Db::name('group')->update($data);
            if($r){
                $this->success('修改成功！');
            } else {
                $this->error('修改失败！');
            }
        }else{
            $param = $this->request->param();
            $data=Db::name('group')->where('id',$param['id'])->find();
            $this->assign('data',$data);
            return $this->fetch();   
        }    
    }

     //删除角色
    public function deleterole(){
         $param = $this->request->param();
        $result =  Db::name('group')->delete($param['id']);
        if ($result) {
            $this->success('删除成功');// code = 1 
        }else{
            $this->error('删除失败');// code = 0
        }
    }
}