<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\web\controller;

use cmf\controller\RestBaseController;
use think\Validate;
use think\Db;

use api\article\model\ArticlePostModel;

class TestController extends RestBaseController
{
    // 列表
    public function index()
    {

        $validate = new Validate([
            'page'           => 'require',
        ]);

        $validate->message([
            'page.require'           => '缺少参数page!',
        ]);

        $params = $this->request->param();
        if (!$validate->check($params)) {
            $this->error($validate->getError());
        }
        $params_page        = !empty($params['page']) ? $params['page'] : 1;
        $params_limit       = !empty($params['limit']) ? $params['limit'] : 20;
        $params_categoryIds = !empty($params['categoryIds']) ? $params['categoryIds'] : '';

        $Api_where          = "";
        $Api_limit          = $params_limit;
        $Api_order          = "post.is_top DESC,post.published_time";
        $Api_page           = $params_page;
        $Api_categoryIds    = $params_categoryIds;

        $returnVarName = \app\article\service\ApiService::articles([
            'where'   => $Api_where,
            'limit'   => $Api_limit,
            'order'   => $Api_order,
            'page'    => $Api_page,
            'category_ids'=> $Api_categoryIds
        ]);

            
        $this->success("ok",$returnVarName);
    }



    
    public function addSignInLog()
    {
        if (!$this->request->isPost()) {
            $this->error('404');
        }
    	$validate = new Validate([
            'code'           => 'require',
        ]);

        $validate->message([
            'code.require'           => '缺少参数code!',
        ]);

        $data = $this->request->param();
        if (!$validate->check($data)) {
            $this->error($validate->getError());
        }
        $code 		= $data['code'];
        $remark 	= $data['remark'];

        $findSignIn = Db::name("sign_in")
            		->where('code', $code)
            		->find();

        if(!$findSignIn){
        	$this->error('二维码无效!');
        }

        if($findSignIn['end_time'] < time()){
        	$this->error('已过签到时间!');
        }
        $findSignInLog = Db::name("sign_in_log")
            		->where('sign_in_id', $findSignIn['id'])
            		->where('create_user_id', $this->userId)
            		->find();
        if ($findSignInLog) {
        	$this->error('已签到!');
        }
        
        Db::name("sign_in_log")->insert([
            'sign_in_id'          	=> $findSignIn['id'],
            'create_user_id'        => $this->userId,
            'create_time'     		=> time(),
            'remark'          		=> $remark
        ]);
         $this->success("签到成功!");
    }

}
