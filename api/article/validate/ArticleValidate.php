<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace api\article\validate;

use think\Validate;

class ArticleValidate extends Validate
{
    protected $rule = [
        'categories' => 'require',
        'post_title' => 'require',
        'post_content' => 'require',
    ];
    protected $message = [
        'categories.require' => '请指定帖子分类！',
        'post_title.require' => '帖子标题不能为空！',
        'post_content.require' => '帖子内容不能为空！',
    ];

    protected $scene = [
//        'add'  => ['user_login,user_pass,user_email'],
//        'edit' => ['user_login,user_email'],
    ];
}