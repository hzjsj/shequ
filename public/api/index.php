<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 调试模式开关
define("APP_DEBUG", true);

// 定义 APP 命名空间
define("APP_NAMESPACE", 'api');

// 定义CMF根目录,可更改此目录
define('APP_ROOT', __DIR__ . '/../../');

// 定义应用目录
define('APP_PATH', APP_ROOT . 'api/');

// 定义CMF目录
define('KAI_PATH', __DIR__ . '/../../base/');

// 定义应用的运行时目录
define('RUNTIME_PATH',__DIR__.'/../../data/runtime/api/');

// 定义扩展目录
define('VENDOR_PATH', KAI_PATH . 'vendor/');

// 加载框架基础文件
require __DIR__ . '/../../thinkphp/base.php';

// 执行应用
\think\App::run()->send();
