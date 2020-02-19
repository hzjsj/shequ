<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\article\controller;

use cmf\controller\RestAdminBaseController;
use api\article\model\ArticleCategoryModel;

class AdminCategoryController extends RestAdminBaseController
{
    /**
     * 文章分类列表
     */
    public function index()
    {
    	$params = $this->request->param();

    	$type = empty($params['type']) ? false : $params['type'];

        $articleCategoryModel = new ArticleCategoryModel();

        switch ($type) {
        	case '1':
        		$categoryTree        = $articleCategoryModel->categoryArr();
        		break;
        	case '2':
        		$categoryTree        = $articleCategoryModel->categoryTreeArr();
        		break;
        	
        	default:
        		$categoryTree        = $articleCategoryModel->categoryArr();
        		break;
        }

        $this->success("ok",$categoryTree);
    }

    /**
     * 添加文章分类
     */
    public function add()
    {
        $articleCategoryModel = new ArticleCategoryModel();

        $params = $this->request->param();

        $result = $this->validate($params, 'Category');

        if ($result !== true) {
            $this->error($result);
        }

        $result = $articleCategoryModel->addCategory($params);

        if ($result === false) {
            $this->error('添加失败!');
        }

        $this->success('添加成功!');
    }

    /**
     * 编辑文章分类提交
     */
    public function edit()
    {
        $params = $this->request->param();

        $result = $this->validate($params, 'Category');

        if ($result !== true) {
            $this->error($result);
        }

        $articleCategoryModel = new ArticleCategoryModel();

        $result = $articleCategoryModel->editCategory($params);

        if ($result === false) {
            $this->error('保存失败!');
        }

        $this->success('保存成功!');
    }

    /**
     * 删除文章分类
     */
    public function delete()
    {
        $articleCategoryModel = new ArticleCategoryModel();
        $id                  = $this->request->param('id');
        //获取删除的内容
        $findCategory = $articleCategoryModel->where('id', $id)->find();

        if (empty($findCategory)) {
            $this->error('分类不存在!');
        }
        //判断此分类有无子分类（不算被删除的子分类）
        $categoryChildrenCount = $articleCategoryModel->where(['parent_id' => $id, 'delete_time' => 0])->count();

        if ($categoryChildrenCount > 0) {
            $this->error('此分类有子类无法删除!');
        }

        $categoryPostCount = Db::name('article_category_post')->where('category_id', $id)->count();

        if ($categoryPostCount > 0) {
            $this->error('此分类有文章无法删除!');
        }

        $data   = [
            'object_id'   => $findCategory['id'],
            'create_time' => time(),
            'table_name'  => 'article_category',
            'name'        => $findCategory['name']
        ];
        $result = $articleCategoryModel
            ->where('id', $id)
            ->update(['delete_time' => time()]);
        if ($result) {
            Db::name('recycleBin')->insert($data);
            $this->success('删除成功!');
        } else {
            $this->error('删除失败');
        }
    }

}
