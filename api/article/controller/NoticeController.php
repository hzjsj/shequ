<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\article\controller;

use cmf\controller\RestBaseController;
use think\Validate;
use think\Db;
use api\article\model\ArticlePostModel;
use api\article\model\ArticleCategoryModel;
use api\article\service\PostService;
use api\article\service\ApiService;

class NoticeController extends RestBaseController
{
    /**
     * 公告列表
     */
    public function index()
    {
        $validate = new Validate([
            'page'              => 'number',
            'limit'             => 'number'
        ]);

        $validate->message([
            'page.number'          => 'page必须为正整数!',
            'limit.number'         => 'limit必须为正整数!',
        ]);

        $params = $this->request->param();
        if (!$validate->check($params)) {
            $this->error($validate->getError());
        }
        $params_page        = !empty($params['page']) ? $params['page'] : 1;
        $params_limit       = !empty($params['limit']) ? $params['limit'] : 20;
        $params_categoryIds = !empty($params['categoryIds']) ? $params['categoryIds'] : '';
        $params_keyword     = !empty($params['keyword']) ? $params['keyword'] : '';

        $Api_keyword        = $params_keyword;
        $Api_limit          = $params_limit;
        $Api_page           = $params_page;
        $Api_categoryIds    = $params_categoryIds;

        $returnVarName = \app\article\service\ApiService::notice([
            'keyword'       => $Api_keyword,
            'limit'         => $Api_limit,
            'page'          => $Api_page,
            'category_ids'  => $Api_categoryIds
        ]);

            
        $this->success("ok",$returnVarName);
    }

    /**
     * 公告详情
     */
    public function article()
    {

        $articleCategoryModel = new ArticleCategoryModel();
        $postService         = new PostService();
        $apiService = new ApiService();


        $validate = new Validate([
            'id'              => 'number|require',
            'cid'             => 'number'
        ]);

        $validate->message([
            'id.require'            => 'id为必填!',
            'id.number'             => 'id必须为正整数!',
            'cid.number'            => 'cid必须为正整数!',
        ]);

        $params = $this->request->param();
        if (!$validate->check($params)) {
            $this->error($validate->getError());
        }

        $articleId  = $this->request->param('id', 0, 'intval');
        $categoryId = $this->request->param('cid', 0, 'intval');

        // $article    = $postService->publishedArticle($articleId, $categoryId);
        $article    = $apiService->article($articleId);

        if (empty($article)) {
            $this->error('公告不存在!');
        }




        if (empty($categoryId)) {
            $categories = $article['categories'];

            if (count($categories) > 0) {
                $category = $categories[0];
            } else {
                $this->error('公告未指定分类!');
            }

        } else {
            $category = $articleCategoryModel->where('id', $categoryId)->where('status', 1)->find();

            if (empty($category)) {
                $this->error('公告不存在!');
            }

        }

        Db::name('article_post')->where('id', $articleId)->setInc('post_hits');

        $this->success('ok',['article'=>$article]);
    }



}
