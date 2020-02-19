<?php

use think\Route;
//project
Route::get('project/:id','project/index/index');
Route::post('project','project/index/create');
Route::put('project/:id','project/index/edit');
Route::get('projectgetinfo/:id','project/index/getinfo');
Route::put('projecteditinfo/:id','project/index/editinfo');
Route::get('list/project/:page','project/index/projectlist');



//library
Route::get('library/get/:id','library/index/index');
Route::get('library/list/:type','library/index/libraryList');
Route::get('library/taglist/:type','library/index/libraryTagList');
Route::post('library/:id/post/','library/index/create');



//user
Route::post('login','user/login/index');
Route::post('register','user/login/register');
Route::get('getUserInfo','user/public/getUserInfo');
Route::post('userupload','user/asset/webuploader');




