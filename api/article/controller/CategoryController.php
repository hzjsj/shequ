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
use api\article\model\ArticleCategoryModel;

class CategoryController extends RestBaseController
{
    // 列表
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



}
