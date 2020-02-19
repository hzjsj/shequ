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

class ArticleController extends RestBaseController
{
    /**
     * 文章列表
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
        
        $params_isNotice        = !empty($params['isNotice']) ? $params['isNotice'] : 0;
        $params_page        = !empty($params['page']) ? $params['page'] : 1;
        $params_limit       = !empty($params['limit']) ? $params['limit'] : 20;
        $params_categoryIds = !empty($params['categoryIds']) ? $params['categoryIds'] : '';
        $params_keyword     = !empty($params['keyword']) ? $params['keyword'] : '';

        $Api_keyword        = $params_keyword;
        $Api_limit          = $params_limit;
        $Api_page           = $params_page;
        $Api_categoryIds    = $params_categoryIds;
        $Api_isNotice    = $params_isNotice;

        $returnVarName = \api\article\service\ApiService::articles([
            'keyword'       => $Api_keyword,
            'limit'         => $Api_limit,
            'page'          => $Api_page,
            'category_ids'  => $Api_categoryIds,
            'isNotice'      => $Api_isNotice
        ]);
        $this->success("ok",$returnVarName);
    }

    /**
     * 文章详情
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
            $this->error('文章不存在!');
        }

        $article['user']['avatar'] = isset($article['user']['avatar']) ? cmf_get_image_url($article['user']['avatar']):'';


        if (empty($categoryId)) {
            $categories = $article['categories'];

            if (count($categories) > 0) {
                $category = $categories[0];
            } else {
                $this->error('文章未指定分类!');
            }

        } else {
            $category = $articleCategoryModel->where('id', $categoryId)->where('status', 1)->find();

            if (empty($category)) {
                $this->error('文章不存在!');
            }

        }

        Db::name('article_post')->where('id', $articleId)->setInc('post_hits');
        $article= json_decode(json_encode($article), true);
        p((array)$article);die;
        $this->success('ok',['article'=>$article]);
    }


    /**
     *  添加文章
     * Array
        (
            [post] => Array
                (
                    [categories] => 1,2
                    [post_title] => 22222
                    [post_keywords] => 
                    [post_source] => 
                    [post_excerpt] => 
                    [more] => Array
                        (
                            [audio] => 
                            [video] => 
                            [thumbnail] => 
                            [template] => 
                        )

                    [published_time] => 2019-04-10 09:51:00
                    [post_content] => &lt;p&gt;dasfdadfa&lt;/p&gt;
                )

            [photo_urls] => Array
                (
                    [0] => article/20190226/77a1209c041b070a0d2717e9ab3a6f5b.jpeg
                    [1] => article/20190226/affc0a0ac59408497bea87751637320f.jpeg
                    [2] => article/20190226/03ecec7416d07389872697f1f1fc20df.jpeg
                )

            [photo_names] => Array
                (
                    [0] => 1417273792080.jpeg
                    [1] => 1417273796335.jpeg
                    [2] => 1417273799937.jpeg
                )

        )
     */
    public function add()
    {
        //验证登陆
        $this->checkUserLogin();

        if ($this->request->isPost()) {
            $params = $this->request->param();

            //状态只能设置默认值。未发布、未置顶、未推荐
            $params['post']['post_status'] = 0;
            $params['post']['is_top']      = 0;
            $params['post']['recommended'] = 0;

            $post = $params['post'];

            $result = $this->validate($post, 'Article');
            if ($result !== true) {
                $this->error($result);
            }

            $articlePostModel = new ArticlePostModel();

            if (!empty($params['photo_names']) && !empty($params['photo_urls'])) {
                $params['post']['more']['photos'] = [];
                foreach ($params['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    array_push($params['post']['more']['photos'], ["url" => $photoUrl, "name" => $params['photo_names'][$key]]);
                }
            }

            if (!empty($params['file_names']) && !empty($params['file_urls'])) {
                $params['post']['more']['files'] = [];
                foreach ($params['file_urls'] as $key => $url) {
                    $fileUrl = cmf_asset_relative_url($url);
                    array_push($params['post']['more']['files'], ["url" => $fileUrl, "name" => $params['file_names'][$key]]);
                }
            }


            $articlePostModel->addArticle($params['post'], $params['post']['categories']);

            $params['post']['id'] = $articlePostModel->id;


            $this->success('添加成功!',['id' => $articlePostModel->id]);
        }
    }

    /**
     * 修改文章
     * Array
        (
            [post] => Array
                (
                    [categories] => 1
                    [id] => 4
                    [post_title] => 1
                    [post_keywords] => 
                    [post_source] => 
                    [post_excerpt] => 
                    [more] => Array
                        (
                            [audio] => 
                            [video] => 
                            [thumbnail] => 
                            [template] => 
                        )

                    [published_time] => 2019-04-01 18:16
                    [post_content] => &lt;p&gt;1243254235432&lt;/p&gt;
                )

            [photo_urls] => Array
                (
                    [0] => article/20190226/77a1209c041b070a0d2717e9ab3a6f5b.jpeg
                    [1] => article/20190226/affc0a0ac59408497bea87751637320f.jpeg
                    [2] => article/20190226/03ecec7416d07389872697f1f1fc20df.jpeg
                    [3] => article/20190226/315715d9dc3b1fcff78fbc3471edfa24.jpeg
                )

            [photo_names] => Array
                (
                    [0] => 1417273792080.jpeg
                    [1] => 1417273796335.jpeg
                    [2] => 1417273799937.jpeg
                    [3] => 1417273803231.jpeg
                )

        )

     */

    public function edit()
    {
        //验证登陆
        $this->checkUserLogin();

        if ($this->request->isPost()) {
            $params = $this->request->param();
            
            //需要抹除发布、置顶、推荐的修改。
            unset($params['post']['post_status']);
            unset($params['post']['is_top']);
            unset($params['post']['recommended']);

            $post   = $params['post'];
            $result = $this->validate($post, 'Article');
            if ($result !== true) {
                $this->error($result);
            }

            $articlePostModel = new ArticlePostModel();

            if (!empty($params['photo_names']) && !empty($params['photo_urls'])) {
                $params['post']['more']['photos'] = [];
                foreach ($params['photo_urls'] as $key => $url) {
                    $photoUrl = cmf_asset_relative_url($url);
                    array_push($params['post']['more']['photos'], ["url" => $photoUrl, "name" => $params['photo_names'][$key]]);
                }
            }

            if (!empty($params['file_names']) && !empty($params['file_urls'])) {
                $params['post']['more']['files'] = [];
                foreach ($params['file_urls'] as $key => $url) {
                    $fileUrl = cmf_asset_relative_url($url);
                    array_push($params['post']['more']['files'], ["url" => $fileUrl, "name" => $params['file_names'][$key]]);
                }
            }

            $articlePostModel->editArticle($params['post'], $params['post']['categories']);


            $this->success('保存成功!');

        }
    }

    /**
     * 文章删除
     * @adminMenu(
     *     'name'   => '文章删除',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '文章删除',
     *     'param'  => ''
     * )
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function delete()
    {
        //验证登陆
        $this->checkUserLogin();

        $param           = $this->request->param();
        $articlePostModel = new ArticlePostModel();

        if (isset($param['id'])) {
            $id           = $this->request->param('id', 0, 'intval');
            $result       = $articlePostModel->where('id', $id)->find();
            $data         = [
                'object_id'   => $result['id'],
                'create_time' => time(),
                'table_name'  => 'article_post',
                'name'        => $result['post_title'],
                'user_id'     => cmf_get_current_admin_id()
            ];
            $resultArticle = $articlePostModel
                ->where('id', $id)
                ->update(['delete_time' => time()]);
            if ($resultArticle) {
                Db::name('article_category_post')->where('post_id', $id)->update(['status' => 0]);
                Db::name('article_tag_post')->where('post_id', $id)->update(['status' => 0]);

                Db::name('recycleBin')->insert($data);
            }
            $this->success("删除成功！", '');

        }

        if (isset($param['ids'])) {
            $ids     = $this->request->param('ids/a');
            $recycle = $articlePostModel->where('id', 'in', $ids)->select();
            $result  = $articlePostModel->where('id', 'in', $ids)->update(['delete_time' => time()]);
            if ($result) {
                Db::name('article_category_post')->where('post_id', 'in', $ids)->update(['status' => 0]);
                Db::name('article_tag_post')->where('post_id', 'in', $ids)->update(['status' => 0]);
                foreach ($recycle as $value) {
                    $data = [
                        'object_id'   => $value['id'],
                        'create_time' => time(),
                        'table_name'  => 'article_post',
                        'name'        => $value['post_title'],
                        'user_id'     => cmf_get_current_admin_id()
                    ];
                    Db::name('recycleBin')->insert($data);
                }
                $this->success("删除成功！", '');
            }
        }
    }

}
