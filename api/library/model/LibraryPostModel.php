<?php
namespace api\library\model;

use think\Model;
use think\Db;

/**
 * @property mixed id
 */
class LibraryPostModel extends Model
{

    protected $type = [
        'more' => 'array',
    ];

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;

    /**
     * 关联 user表
     * @return \think\model\relation\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('api\user\model\UserModel', 'user_id')->field('user_type,user_nickname,avatar,id')->setEagerlyType(1);
    }



    /**
     * 关联标签表
     * @return \think\model\relation\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('LibraryTagModel', 'library_tag_post', 'tag_id', 'post_id');
    }

    
}
