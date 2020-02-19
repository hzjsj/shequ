<?php
namespace app\index\controller;
use cmf\controller\HomeBaseController;
use think\Db;
class IndexController extends HomeBaseController 
{   

    public function index(){
        $project=Db::name('project')
        ->alias('a')->join('__USER__ b ','b.id= a.uid')
        ->field('a.*,b.user_nickname,b.avatar')->limit(8)
        ->order('id desc')->select();
        $this->assign('project',$project);
        //$this->assign('dhxz',1);
        return $this->fetch();
    }
     public function project(){
      $param = $this->request->param();
         
        $project=Db::name('project')
        ->alias('a')->join('__USER__ b ','b.id= a.uid')
        ->field('a.*,b.user_nickname,b.avatar')
        ->where('a.id',$param['id'])->find();
        $project['create_date']= date('Y-m-d H:i:s', $project['create_time']); 

        $comment=Db::name('comment')
        ->alias('a')->join('__USER__ b ','b.id= a.uid')
        ->field('a.*,b.user_nickname,b.avatar')->where('a.pid',$param['id'])
        ->order('id desc')->select();
        foreach ($comment as $key => $value) {
         $comment[$key]['create_date']= date('Y-m-d H:i:s', $value['create_time']); 
        }
        
        $browse=$project['browse']+1;
        Db::name('project')->where('id', $project['id'])->update(['browse'=>$browse]);
        //p($comment);die;
        $this->assign('comment',$comment);
        $this->assign('project',$project);
        return $this->fetch();
    }

  
    public function projectlist()
    {
        $projectlist=Db::name('project')
        ->alias('a')->join('__USER__ b ','b.id= a.uid')
        ->field('a.*,b.user_nickname,b.avatar')
        ->order('id desc')->select();
        $this->assign('projectlist',$projectlist);
        //$this->assign('dhxz',1);
        return $this->fetch();
    }
}
