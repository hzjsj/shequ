<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace api\article\service;

use api\article\model\ArticlePostModel;
use api\article\model\ArticleCategoryModel;
use think\Db;
use think\db\Query;

class ApiService
{
    /**
     * 功能:查询文章列表,支持分页;<br>
     * 注:此方法查询时关联两个表article_category_post(category_post),article_post(post);在指定排序(order),指定查询条件(where)最好指定一下表别名
     * @param array $param 查询参数<pre>
     *                     array(
     *                     'category_ids'=>'',
     *                     'where'=>'',
     *                     'keyword'=>'',
     *                     'limit'=>'',
     *                     'order'=>'',
     *                     'page'=>'',
     *                     'relation'=>''
     *                     )
     *                     字段说明:
     *                     category_ids:文章所在分类,可指定一个或多个分类id,以英文逗号分隔,如1或1,2,3 默认值为全部
     *                     field:调用指定的字段@todo
     *                     如只调用posts表里的id和post_title字段可以是post.id,post.post_title; 默认全部,
     *                     此方法查询时关联两个表article_category_post(category_post),article_post(post);
     *                     所以最好指定一下表名,以防字段冲突
     *                     limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)
     *                     order:排序方式,如按posts表里的published_time字段倒序排列：post.published_time desc
     *                     where:查询条件,字符串形式,和sql语句一样,请在事先做好安全过滤,最好使用第二个参数$where的数组形式进行过滤,此方法查询时关联多个表,所以最好指定一下表名,以防字段冲突,查询条件(只支持数组),格式和thinkPHP的where方法一样,此方法查询时关联多个表,所以最好指定一下表名,以防字段冲突;
     *                     </pre>
     * @return array 包括分页的文章列表<pre>
     *                     格式:
     *                     array(
     *                     "articles"=>array(),//文章列表,array
     *                     "total"=>100, //符合条件的文章总数,不分页则没有此项
     *                     "total_pages"=>5 // 总页数,不分页则没有此项
     *                     )</pre>
     */
    public static function articles($param)
    {
        $articlePostModel = new ArticlePostModel();

        $where = [
            'post.post_status' => 1,
            'post.post_type'   => 1,
            'post.delete_time' => 0
        ];

        $paramWhere  = empty($param['where']) ? '' : $param['where'];
        $keyword     = empty($param['keyword']) ? '' : $param['keyword'];
        $isNotice    = empty($param['isNotice']) ? 0 : $param['isNotice'];
        $limit       = empty($param['limit']) ? 10 : $param['limit'];
        $order       = empty($param['order']) ? '' : $param['order'];
        $page        = isset($param['page']) ? $param['page'] : false;
        $relation    = empty($param['relation']) ? '' : $param['relation'];
        $categoryIds = empty($param['category_ids']) ? '' : $param['category_ids'];

        $join = [
            ['__USER__ user', 'post.user_id = user.id'],
        ];

        $whereKeyword = null;

        if (!empty($keyword)) {
            $whereKeyword = function (Query $query) use ($keyword) {
                $query->where('post.post_title', 'like', "%$keyword%");
            };
            
        }
        if (!empty($isNotice)) {
            $where['is_notice'] = 1;
            
        }
        

        $whereCategoryId = null;

        if (!empty($categoryIds)) {

            $field = !empty($param['field']) ? $param['field'] : 'post.*,min(category_post.category_id) as category_id,user.user_nickname,user.avatar';
            array_push($join, ['__ARTICLE_CATEGORY_POST__ category_post', 'post.id = category_post.post_id']);

            if (!is_array($categoryIds)) {
                $categoryIds = explode(',', $categoryIds);
            }

            if (count($categoryIds) == 1) {
                $whereCategoryId = function (Query $query) use ($categoryIds) {
                    $query->where('category_post.category_id', $categoryIds[0]);
                };
            } else {
                $whereCategoryId = function (Query $query) use ($categoryIds) {
                    $query->where('category_post.category_id', 'in', $categoryIds);
                };
            }
        } else {

            $field = !empty($param['field']) ? $param['field'] : 'post.*,min(category_post.category_id) as category_id,user.user_nickname,user.avatar';
            array_push($join, ['__ARTICLE_CATEGORY_POST__ category_post', 'post.id = category_post.post_id']);
        }

        $articles = $articlePostModel->alias('post')->field($field)
            ->join($join)
            ->where($where)
            ->where($whereKeyword)
            ->where($paramWhere)
            ->where($whereCategoryId)
            ->where('post.published_time', ['> time', 0], ['<', time()], 'and')
            ->order($order)
            ->group('post.id');

        $return = [];

        if (empty($page)) {
            $articles = $articles->limit($limit)->select();

            if (!empty($relation) && !empty($articles['items'])) {
                $articles->load($relation);
            }
            $return['articles'] = $articles;
        } else {

            if (is_array($page)) {
                if (empty($page['list_rows'])) {
                    $page['list_rows'] = $limit;
                }
                $articles = $articles->paginate($page);
            } else {
                $paginate['page']       = $page;
                $paginate['list_rows']  = $limit;
                $articles = $articles->paginate($paginate);
            }

            if (!empty($relation) && !empty($articles['items'])) {
                $articles->load($relation);
            }

            $articles->appends(request()->get());
            $articles->appends(request()->post());

            //处理图片地址
            $articles_list = $articles->items();
            if ($articles_list) {
                foreach ($articles_list as $key => $value) {
                    $articles_list[$key]['thumbnail'] = cmf_get_image_url($value['thumbnail']);
                    $articles_list[$key]['more'] = k_get_more_url($value['more']);
                    $articles_list[$key]['avatar'] = $value['avatar'] ? cmf_get_image_url($value['avatar']):'';
                    $articles_list[$key]['create_date'] = $value['create_time'] ? date('Y-m-d H:i:s',$value['create_time']):'';
                    $articles_list[$key]['published_date'] = $value['published_time'] ? date('Y-m-d H:i:s',$value['published_time']):'';
                    $articles_list[$key]['update_date'] = $value['update_time'] ? date('Y-m-d H:i:s',$value['update_time']):'';
                    $articles_list[$key]['content_filtered'] = $value['post_content'] ? cutstr_html($value['post_content']) : '';
                }
            }

            $return['articles']    = $articles_list;
            $return['page']        = $page;
            $return['total']       = $articles->total();
            $return['total_pages'] = $articles->lastPage();
        }


        return $return;

    }



    /**
     * 功能:查询标签文章列表,支持分页;<br>
     * 注:此方法查询时关联两个表article_tag_post(tag_post),article_post(post);在指定排序(order),指定查询条件(where)最好指定一下表别名
     * @param array $param 查询参数<pre>
     *                     array(
     *                     'tag_id'=>'',
     *                     'where'=>'',
     *                     'limit'=>'',
     *                     'order'=>'',
     *                     'page'=>'',
     *                     'relation'=>''
     *                     )
     *                     字段说明:
     *                     field:调用指定的字段@todo
     *                     如只调用posts表里的id和post_title字段可以是post.id,post.post_title; 默认全部,
     *                     此方法查询时关联两个表article_tag_post(category_post),article_post(post);
     *                     所以最好指定一下表名,以防字段冲突
     *                     limit:数据条数,默认值为10,可以指定从第几条开始,如3,8(表示共调用8条,从第3条开始)
     *                     order:排序方式,如按posts表里的published_time字段倒序排列：post.published_time desc
     *                     where:查询条件,字符串形式,和sql语句一样,请在事先做好安全过滤,最好使用第二个参数$where的数组形式进行过滤,此方法查询时关联多个表,所以最好指定一下表名,以防字段冲突,查询条件(只支持数组),格式和thinkPHP的where方法一样,此方法查询时关联多个表,所以最好指定一下表名,以防字段冲突;
     *                     </pre>
     * @return array 包括分页的文章列表<pre>
     *                     格式:
     *                     array(
     *                     "articles"=>array(),//文章列表,array
     *                     "page"=>"",//生成的分页html,不分页则没有此项
     *                     "total"=>100, //符合条件的文章总数,不分页则没有此项
     *                     "total_pages"=>5 // 总页数,不分页则没有此项
     *                     )</pre>
     */
    public static function tagArticles($param)
    {
        $articlePostModel = new ArticlePostModel();

        $where = [
            'post.post_status' => 1,
            'post.post_type'   => 1,
            'post.delete_time' => 0
        ];

        $paramWhere = empty($param['where']) ? '' : $param['where'];

        $limit    = empty($param['limit']) ? 10 : $param['limit'];
        $order    = empty($param['order']) ? '' : $param['order'];
        $page     = isset($param['page']) ? $param['page'] : false;
        $relation = empty($param['relation']) ? '' : $param['relation'];
        $tagId    = empty($param['tag_id']) ? '' : $param['tag_id'];

        $join = [
            //['__USER__ user', 'post.user_id = user.id'],
        ];

        if (empty($tagId)) {
            return null;

        } else {
            $field = !empty($param['field']) ? $param['field'] : 'post.*';
            array_push($join, ['__ARTICLE_TAG_POST__ tag_post', 'post.id = tag_post.post_id']);

            $where['tag_post.tag_id'] = $tagId;
        }

        $articles = $articlePostModel->alias('post')->field($field)
            ->join($join)
            ->where($where)
            ->where($paramWhere)
            ->where('post.published_time', ['> time', 0], ['<', time()], 'and')
            ->order($order);

        $return = [];

        if (empty($page)) {
            $articles = $articles->limit($limit)->select();

            if (!empty($relation) && !empty($articles['items'])) {
                $articles->load($relation);
            }

            $return['articles'] = $articles;
        } else {

            if (is_array($page)) {
                if (empty($page['list_rows'])) {
                    $page['list_rows'] = 10;
                }

                $articles = $articles->paginate($page);
            } else {
                $articles = $articles->paginate(intval($page));
            }

            if (!empty($relation) && !empty($articles['items'])) {
                $articles->load($relation);
            }

            $articles->appends(request()->get());
            $articles->appends(request()->post());

            $return['articles']    = $articles->items();
            $return['page']        = $articles->render();
            $return['total']       = $articles->total();
            $return['total_pages'] = $articles->lastPage();
        }

        return $return;
    }

    /**
     * 获取指定id的文章
     * @param int $id
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public static function article($id)
    {
        $articlePostModel = new ArticlePostModel();

        $where = [
            'post_status' => 1,
            'id'          => $id,
            'delete_time' => 0
        ];
        $return = $articlePostModel::with('user')->where($where)
            ->where('published_time', ['> time', 0], ['<', time()], 'and')
            ->find();
        return $return;
    }

    /**
     * 获取指定条件的页面列表
     * @param array $param 查询参数<pre>
     *                     array(
     *                     'where'=>'',
     *                     'order'=>'',
     *                     )</pre>
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function pages($param)
    {
        $paramWhere = empty($param['where']) ? '' : $param['where'];

        $order = empty($param['order']) ? '' : $param['order'];

        $articlePostModel = new ArticlePostModel();

        $where = [
            'post_status' => 1,
            'post_type'   => 2, //页面
            'delete_time' => 0
        ];

        return $articlePostModel
            ->where($where)
            ->where($paramWhere)
            ->where('published_time', [['> time', 0], ['<', time()]], 'and')
            ->order($order)
            ->select();
    }

    /**
     * 获取指定id的页面
     * @param int $id 页面的id
     * @return array|false|\PDOStatement|string|\think\Model 返回符合条件的页面
     */
    public static function page($id)
    {
        $articlePostModel = new ArticlePostModel();

        $where = [
            'post_status' => 1,
            'post_type'   => 2,
            'id'          => $id,
            'delete_time' => 0
        ];

        return $articlePostModel->where($where)
            ->where('published_time', ['> time', 0], ['<', time()], 'and')
            ->find();
    }

    /**
     * 返回指定分类
     * @param int $id 分类id
     * @return array 返回符合条件的分类
     */
    public static function category($id)
    {
        $articleCategoryModel = new ArticleCategoryModel();

        $where = [
            'status'      => 1,
            'delete_time' => 0,
            'id'          => $id
        ];

        return $articleCategoryModel->where($where)->find();
    }

    /**
     * 返回指定分类下的子分类
     * @param int $categoryId 分类id
     * @param     $field      string  指定查询字段
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @return false|\PDOStatement|string|\think\Collection 返回指定分类下的子分类
     */
    public static function subCategories($categoryId, $field = '*')
    {
        $articleCategoryModel = new ArticleCategoryModel();

        $where = [
            'status'      => 1,
            'delete_time' => 0,
            'parent_id'   => $categoryId
        ];

		return $articleCategoryModel->field($field)->where($where)->order('list_order ASC')->select();
	}

    /**
     * 返回指定分类下的所有子分类
     * @param int $categoryId 分类id
     * @return array 返回指定分类下的所有子分类
     */
    public static function allSubCategories($categoryId)
    {
        $articleCategoryModel = new ArticleCategoryModel();

        $categoryId = intval($categoryId);

        if ($categoryId !== 0) {
            $category = $articleCategoryModel->field('path')->where('id', $categoryId)->find();

            if (empty($category)) {
                return [];
            }

            $categoryPath = $category['path'];
        } else {
            $categoryPath = 0;
        }

        $where = [
            'status'      => 1,
            'delete_time' => 0,
            'path'        => ['like', "$categoryPath-%"]
        ];

        return $articleCategoryModel->where($where)->select();
    }

    /**
     * 返回符合条件的所有分类
     * @param array $param 查询参数<pre>
     *                     array(
     *                     'where'=>'',
     *                     'order'=>'',
     *                     )</pre>
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function categories($param)
    {
        $paramWhere = empty($param['where']) ? '' : $param['where'];

        $order = empty($param['order']) ? '' : $param['order'];

        $articleCategoryModel = new ArticleCategoryModel();

        $where = [
            'status'      => 1,
            'delete_time' => 0,
        ];

        return $articleCategoryModel
            ->where($where)
            ->where($paramWhere)
            ->order($order)
            ->select();
    }

    /**
     * 获取面包屑数据
     * @param int     $categoryId  当前文章所在分类,或者当前分类的id
     * @param boolean $withCurrent 是否获取当前分类
     * @return array 面包屑数据
     */
    public static function breadcrumb($categoryId, $withCurrent = false)
    {
        $data                = [];
        $articleCategoryModel = new ArticleCategoryModel();

        $path = $articleCategoryModel->where(['id' => $categoryId])->value('path');

        if (!empty($path)) {
            $parents = explode('-', $path);
            if (!$withCurrent) {
                array_pop($parents);
            }

            if (!empty($parents)) {
                $data = $articleCategoryModel->where('id', 'in', $parents)->order('path ASC')->select();
            }
        }

        return $data;
    }

}