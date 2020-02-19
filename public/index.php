<?php
// +----------------------------------------------------------------------
// | ThinkKAI [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkKAI.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 老猫 <zxxjjforever@163.com>
// +----------------------------------------------------------------------

// [ 入口文件 ]

// 调试模式开关
define("APP_DEBUG", true);


define("WEB_ROOT",__DIR__ . "/");

// 定义CMF根目录,可更改此目录
define('APP_ROOT', __DIR__ . '/../');

// 定义应用目录
define('APP_PATH', APP_ROOT . 'app/');

// 定义KAI核心包目录
define('KAI_PATH', APP_ROOT . 'base/');

// 定义应用的运行时目录
define('RUNTIME_PATH', APP_ROOT . 'data/runtime/');

// 定义扩展目录
define('VENDOR_PATH', KAI_PATH . 'vendor/');

// 加载框架基础文件
require APP_ROOT . 'thinkphp/base.php';

// 执行应用
\think\App::run()->send();
