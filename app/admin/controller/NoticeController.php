<?php

namespace app\admin\controller;

use cmf\controller\AdminBaseController;

use think\Db;


class NoticeController extends AdminBaseController
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
            

            $where['a.id'] = ['>',0];
            if (isset($param['keywords'])) {
                $keywords = $param['keywords'];
                $where['a.title'] = ['like','%'.$keywords.'%'];
            }

            $notice_select = Db::name('notice')
                ->alias('a')
                ->join('__USER__ b ',' a.create_user_id = b.id')
                ->where($where)
                ->field('a.*,b.user_nickname')
                ->paginate($limit)
                ->toArray();
            foreach ($notice_select['data'] as $key => $value) {
                $notice_select['data'][$key]['create_date'] = date('Y-m-d H:i',$value['create_time']);
            }
            $return_data = array(
                'code'=>0,
                'count'=>$notice_select['total'],
                'data'=>$notice_select['data']
            );
            return json($return_data);
        } else {
            return $this->fetch();
        }
            
    }

    public function addNotice()
    {
        $param = $this->request->param();
        if ($this->request->isPost()) {
            $insert_return = Db::name("notice")->insert([
                'title'                 => $param['title'],
                'create_time'           => time(),
                'create_user_id'        => $this->admin_user_info['id'],
                'status'                => 1,
                'content'               => $param['content'],
            ]);
            if (!$insert_return) {
                $this->error('添加失败!');
            } else {
                $this->success('添加成功!');
            }
        } else {
            return $this->fetch('addNotice');
        }
    }

    public function editNotice()
    {
        $param = $this->request->param();
        if ($this->request->isPost()) {
            $id = $param['id'];
            $update_return = Db::name("notice")
                    ->where('id', $id)
                    ->update([
                        'title'                 => $param['title'],
                        'content'               => $param['content']
                    ]);
            if (!$update_return) {
                $this->error('修改失败!');
            } else {
                $this->success('修改成功!');
            }
        } else {
            $id = $param['id'];

            $notice_find = Db::name('notice')->where(['id'=>$id])->find();

            $this->assign('notice_find',$notice_find);
            return $this->fetch('editNotice');
        }
    }


    public function delNotice()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            $id = $param['id'];

            $delete_return = Db::name("notice")->delete($id);
            if (!$delete_return) {
                $this->error('删除失败!');
            } else {
                $this->success('删除成功!');
            }
        }
    }


}