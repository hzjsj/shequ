<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: kane <chengjin005@163.com>
// +----------------------------------------------------------------------
namespace api\home\controller;

use cmf\controller\RestBaseController;
use think\Db;


class IndexController extends RestBaseController
{
    public function index()
    {
        echo cmf_get_root();
    	die;








    	
    	set_time_limit(0);
        //获取当前文件所在的绝对目录
		$dir =  './assets/';
		
		 //判断目标目录是否是文件夹
		$file_arr = array();

		if(is_dir($dir)){
            //打开
            if($dh = @opendir($dir)){
                //读取
                while(($file = readdir($dh)) !== false){

                    if($file != '.' && $file != '..'){
  
                        $file_arr[] = $file;
                    }
                }
                //关闭
                closedir($dh);
            }
		}

		echo " <pre>";

		foreach ($file_arr as $key => $value) {
			$obj = file_get_contents($dir.$value);

	        $idInfo = explode('.',$value);

			$data = [
	            'user_id' => 1,
	            'post_id' => $value,
	            'post_content'=>$obj,
	            'suffix'=>$idInfo[1],
	            'post_status'=>1
	        ];

	        Db::name('library_post')->insert($data);
		}

		

		print_r($file_arr);




	}

}
