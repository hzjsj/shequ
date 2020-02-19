-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 �?10 �?06 �?08:48
-- 服务器版本: 5.5.53
-- PHP 版本: 5.5.38

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `youdao`
--

-- --------------------------------------------------------

--
-- 表的结构 `kada_asset`
--

CREATE TABLE IF NOT EXISTS `kada_asset` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `file_size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小,单位B',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上传时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态;1:可用,0:不可用',
  `download_times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `file_key` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件惟一码',
  `filename` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '文件名',
  `file_path` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件路径,相对于upload目录,可以为url',
  `file_md5` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件md5值',
  `file_sha1` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `suffix` varchar(10) NOT NULL DEFAULT '' COMMENT '文件后缀名,不包括点',
  `more` text COMMENT '其它详细信息,JSON格式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='资源表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `kada_asset`
--

INSERT INTO `kada_asset` (`id`, `user_id`, `file_size`, `create_time`, `status`, `download_times`, `file_key`, `filename`, `file_path`, `file_md5`, `file_sha1`, `suffix`, `more`) VALUES
(1, 0, 30110, 1562642310, 1, 0, 'a9bb11633fc6cd70f03dc9176a59511eb446dfc038d6941c23b934f41a3c865a', 'f47ecaa2cc4578d22272a056ebcd3b3b.png', 'project/20190709/28f4ed72f27ba5e0e64ff1662f3f1880.png', 'a9bb11633fc6cd70f03dc9176a59511e', '6482fd9b4ba09d571d55d7dc3ab7da3cd86d6d11', 'png', NULL),
(2, 0, 6577, 1562642481, 1, 0, '153e2ebad50ef3e089f52829bb4bfd84ba16a2801b44a4239e9ff3588d526184', '123.png', 'project/20190709/963eac8334ac3cdaf62359ac0331c1b3.png', '153e2ebad50ef3e089f52829bb4bfd84', '509e546821756da0b7a0a719b364c4abeca48bc9', 'png', NULL),
(3, 0, 362539, 1562642741, 1, 0, '60a39f4314cd32f7425bb8c5528ad9280a7af422c4132a9219eae45c5cb52dd9', '11.png', 'project/20190709/6fe9cb3724526c51cdab04313193243e.png', '60a39f4314cd32f7425bb8c5528ad928', '34d5c6f56ace601a7b9d76d8ba29fa330038aac5', 'png', NULL),
(4, 0, 173605, 1562642844, 1, 0, 'cdfa5088f4b2f59f54b462101f824088280db527ca326556e0ea078e11d38ea1', '211.png', 'project/20190709/5e9bd57d25fdddf39cc3b95f1bf43b6d.png', 'cdfa5088f4b2f59f54b462101f824088', '16462883a3303641af4505411b6c691d8e2356fd', 'png', NULL),
(5, 0, 161741, 1562642913, 1, 0, '9d9794b1c405b8e5293a7969517995b75f6ec349cdd6af94181fdf97d603e6d3', '1111.gif', 'project/20190709/97a8395d3aac156d9afc7f953396c831.gif', '9d9794b1c405b8e5293a7969517995b7', '75aad41b74b8724c760225f63d90da5a02fc8b11', 'gif', NULL),
(6, 0, 18412, 1562653133, 1, 0, '0d61b5f9f500ba3fd1515e292f80b88455b9536138051c33bd5dfdf59d3c8792', '1111111.png', 'project/20190709/929ca97c96970f65b18b6421716ea6aa.png', '0d61b5f9f500ba3fd1515e292f80b884', 'a0abd5763d71c295a4c83fa2da2e0ba7049dfa72', 'png', NULL),
(7, 0, 108508, 1562660372, 1, 0, '1e4e31c91a50a0f0da6f838642ba86a2fcd5a9ce25538069b043fa26d45ebc4f', '121.png', 'project/20190709/48d9d184d1da5fa7ab3e73f191da036e.png', '1e4e31c91a50a0f0da6f838642ba86a2', 'ae0a3b7c3b312dfca183de3d4be6464a9196d577', 'png', NULL),
(8, 0, 44549, 1562660665, 1, 0, 'aa6df71c9308731842c6531adbeabf543635c572d5820c55b579859e81489cfa', '124.jpg', 'avatar/20190709/9e2212e7d7bbcf592c76c564644ff420.jpg', 'aa6df71c9308731842c6531adbeabf54', 'ee29fd3760691d2bc776462290fb5998bffaa673', 'jpg', NULL),
(9, 0, 45299, 1565515708, 1, 0, '7f759b61d8f92ef7f6b3f7bdcd831452d6d698de75fc4ca940337f21cae4b2df', 'QQ图片20190728151051.jpg', 'avatar/20190811/983202b90d7ef0e8f24e018ff68f621b.jpg', '7f759b61d8f92ef7f6b3f7bdcd831452', '51a9272f52f439ccb58ead64d009925db061d430', 'jpg', NULL),
(10, 0, 126381, 1568460245, 1, 0, 'e93e34348f99c0a117e93ce67128f220e4b4ca6cefe4796ce766892ca71d2a53', 'sanfeng.png', 'app/20190914/a3639dcf4210e109a69c8334240a45f3.png', 'e93e34348f99c0a117e93ce67128f220', 'd99d8649187ecf7036e634a8f890507d864a3ce1', 'png', NULL),
(11, 0, 60137, 1568460477, 1, 0, '067efd17a19df2f9a5ca9267b075d27e5c99bdf07ca600e6989c25924c8c046c', '$QH)MK(MSFNO$H(CE@(W7HH.png', 'avatar/20190914/24b2d6dd5d82999f14e2108edc83a529.png', '067efd17a19df2f9a5ca9267b075d27e', 'a027693e35c2747ab4437648738e7af14e70197c', 'png', NULL),
(12, 0, 41535, 1568460549, 1, 0, '86a34c3983ac5d788bec979329180d71b569f882cec6a36aeacec7367abc12e8', 'MTU{JWL80WY53{MO~9F9XMF.png', 'avatar/20190914/12539ec8c33e8f2317672f77e7f9a84a.png', '86a34c3983ac5d788bec979329180d71', 'b30d65ce0388845076af39cb208249e0d021f774', 'png', NULL),
(13, 0, 59966, 1568460588, 1, 0, 'd18ca45c610e97fdbd91c72b43d965040a1e0956904d87f9f8b92f1264d09e75', 'X(D3_KESLRMUA2$_VBQ$)S0.png', 'avatar/20190914/b657beb05458c115bc9913541dbbf60b.png', 'd18ca45c610e97fdbd91c72b43d96504', 'f0d87e6beb9bee770e168173808f429b9d78d471', 'png', NULL),
(14, 0, 36893, 1568463347, 1, 0, '1cdb06ec118daf438099671e087d1a3f5f86ae8f1951889bd9a4f058417e3f77', 'S034W)~Q%CLJC82NX6$`QU8.png', 'avatar/20190914/16c3e773582639d340c00f7ad1d0bffe.png', '1cdb06ec118daf438099671e087d1a3f', '71ef18213d7bc105f47eb69eac2ce39ea3dd6087', 'png', NULL),
(15, 0, 42959, 1568469486, 1, 0, 'a1f12063dc62ea829652550235664d027dbb75ea19c59160124a29063ab62035', '1UC`[UL~6E7NV[MJWZT06F0.png', 'avatar/20190914/c6342e1f8b2149fe470e6e29bf56c5a7.png', 'a1f12063dc62ea829652550235664d02', 'ce5461f7f59ec6007bb3720d582ca257e65b7cd4', 'png', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `kada_comment`
--

CREATE TABLE IF NOT EXISTS `kada_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `pid` int(11) DEFAULT NULL COMMENT 'project作品id',
  `comment` text COMMENT '评论',
  `status` tinyint(3) DEFAULT NULL COMMENT '类型1为作品评论',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='评论表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `kada_comment`
--

INSERT INTO `kada_comment` (`id`, `uid`, `pid`, `comment`, `status`, `create_time`) VALUES
(1, 1, 5, '图片做的很好', 1, 1562657628),
(2, 2, 5, '留言看看', 1, 1562660854),
(3, 2, 5, '真好', 1, 1562660865);

-- --------------------------------------------------------

--
-- 表的结构 `kada_group`
--

CREATE TABLE IF NOT EXISTS `kada_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL DEFAULT '',
  `remark` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `kada_group`
--

INSERT INTO `kada_group` (`id`, `title`, `status`, `rules`, `remark`) VALUES
(2, '测试角色', 1, '1,2,3,4,5,29,6,7,8,9,10,11,31', '123');

-- --------------------------------------------------------

--
-- 表的结构 `kada_group_access`
--

CREATE TABLE IF NOT EXISTS `kada_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `group_id` (`group_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- 转存表中的数据 `kada_group_access`
--

INSERT INTO `kada_group_access` (`uid`, `group_id`) VALUES
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `kada_notice`
--

CREATE TABLE IF NOT EXISTS `kada_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) DEFAULT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_user_id` int(11) DEFAULT '0',
  `content` longtext,
  `status` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kada_option`
--

CREATE TABLE IF NOT EXISTS `kada_option` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `autoload` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否自动加载;1:自动加载;0:不自动加载',
  `option_name` varchar(64) NOT NULL DEFAULT '' COMMENT '配置名',
  `option_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '配置值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='全站配置表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `kada_option`
--

INSERT INTO `kada_option` (`id`, `autoload`, `option_name`, `option_value`) VALUES
(1, 1, 'site_info', '{"site_name":"\\u540e\\u53f0\\u7ba1\\u7406","''web''":"http:\\/\\/www.layui.com","web":"http:\\/\\/127.0.1:915","cache":"0","file_type":"png|gif|jpg|jpeg|zip|rar|zip","site_title":"\\u901a\\u7528\\u540e\\u53f0\\u7ba1\\u7406\\u7cfb\\u7edf","site_keywords":"","site_descript":"\\u540e\\u53f0\\u7ba1\\u7406\\u7cfb\\u7edf","copyright":"\\u00a9 2018 \\u8ba1\\u7b97\\u673a\\u53cc\\u521b\\u73ed MIT license","max_file":"1024"}'),
(2, 1, 'cmf_settings', '{"open_registration":"0","banned_usernames":""}'),
(3, 1, 'cdn_settings', '{"cdn_static_root":""}'),
(4, 1, 'admin_settings', '{"admin_password":"abc","admin_theme":"admin_simpleboot3","admin_style":"simpleadmin"}'),
(5, 1, 'email_template_verification_code', '{"subject":"123","template":"&lt;p&gt;123&lt;\\/p&gt;"}'),
(6, 1, 'upload_setting', '{"max_files":"20","chunk_size":"512","file_types":{"image":{"upload_max_filesize":"10240","extensions":"jpg,jpeg,png,gif,bmp4"},"video":{"upload_max_filesize":"10240","extensions":"mp4,avi,wmv,rm,rmvb,mkv"},"audio":{"upload_max_filesize":"10240","extensions":"mp3,wma,wav"},"file":{"upload_max_filesize":"10240","extensions":"txt,pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar"}}}');

-- --------------------------------------------------------

--
-- 表的结构 `kada_project`
--

CREATE TABLE IF NOT EXISTS `kada_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `title` varchar(80) DEFAULT NULL COMMENT '作品标题',
  `content` text COMMENT '作品介绍',
  `desc` text COMMENT '作品描述',
  `image` varchar(255) DEFAULT NULL COMMENT '作品图片',
  `url` varchar(255) DEFAULT NULL COMMENT '作品链接',
  `browse` int(11) DEFAULT '1' COMMENT '浏览量',
  `like` int(11) DEFAULT '1' COMMENT '点赞量',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='作品表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `kada_project`
--

INSERT INTO `kada_project` (`id`, `uid`, `title`, `content`, `desc`, `image`, `url`, `browse`, `like`, `create_time`, `update_time`) VALUES
(2, 1, '骏马跑酷', '作者还没有添加作品介绍哦', '点击马或按任意键跳跃\n \n躲避路上的行人', 'project/20190709/963eac8334ac3cdaf62359ac0331c1b3.png', 'http://www.fanggexia.com/', 1, 1, 1562642486, 1562642486),
(3, 1, 'P18C模拟器', '你们呵呵就呵呵吧，反正这把枪是最强的手枪，可以跟汤姆逊刚，只用了我一下午去做。（我的自动终于没有BUG了！）没有膛内子弹哈。', '空格开枪 上换弹 下三连发 右单发 左全自动 满配方法得没子弹才能点', 'project/20190709/6fe9cb3724526c51cdab04313193243e.png', 'http://www.fanggexia.com/', 4, 1, 1562642745, 1562642745),
(4, 1, '学校囧事——我不爱玩迷你！！！', '送给那些支持MC的人，\n点赞的数量代表了多少人支持MC。', '直接观看即可。', 'project/20190709/5e9bd57d25fdddf39cc3b95f1bf43b6d.png', 'http://www.fanggexia.com/', 3, 1, 1562642848, 1562642848),
(5, 1, '像素篮球', '一个像素化的游戏。（我是不是有点儿太敷衍了）', 'Red：上下左右移动，1投篮。\nBlue：WSAD移动，J投篮。', 'project/20190709/97a8395d3aac156d9afc7f953396c831.gif', 'http://www.fanggexia.com/', 15, 1, 1562642932, 1562642932),
(6, 1, 'The Ninja', '2019.4.23\n已开源。@ 飞雪官方 看你怎么说！！！\n2019.4.24\n开源后就把赞撤回？少了27个！！！\n2019.4.25\n如果觉得作品好的话，点赞。不是为了开源或是什么才点的。觉得不好的话，就不要在那骂人(ಥ_ಥ) \n2019.4.29\n我早就把创作页关了...\n2019.5.5\n忍痛开源(ノДＴ)（你们爱改编就去改编吧。。。）\n2019.5.11\n修改了可以跳关的bug，一作弊就会停止全部 ๑乛◡乛๑\n2019.6.9\n经过N人的善意提醒，我把创作页关了！', '方向键控制忍者', 'project/20190709/929ca97c96970f65b18b6421716ea6aa.png', 'http://www.fanggexia.com/', 11, 1, 1562653138, 1562653138),
(7, 2, '杠杆跷跷板', '考验你的平衡能力和数学逻辑思维哦！', '用鼠标点击小猴，再按空格键放在左右两侧，让杠杆保持平衡就过关。', 'project/20190709/48d9d184d1da5fa7ab3e73f191da036e.png', 'http://www.fanggexia.com/', 6, 1, 1562660387, 1562660556);

-- --------------------------------------------------------

--
-- 表的结构 `kada_rule`
--

CREATE TABLE IF NOT EXISTS `kada_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='节点' AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `kada_rule`
--

INSERT INTO `kada_rule` (`id`, `name`, `title`, `type`, `status`, `condition`, `pid`) VALUES
(1, '', '网站管理', 1, 1, '', 0),
(2, 'admin/library/index', '素材管理', 1, 1, '', 1),
(3, 'admin/library/add', '添加素材', 1, 1, '', 2),
(4, 'admin/library/edit', '编辑素材', 1, 1, '', 2),
(5, 'admin/library/del', '删除素材', 1, 1, '', 2),
(6, 'admin/project/index', '作品管理', 1, 1, '', 1),
(7, 'admin/project/edit', '编辑作品', 1, 1, '', 6),
(8, 'admin/project/del', '删除作品', 1, 1, '', 6),
(9, 'admin/work/index', '工单管理', 1, 1, '', 1),
(10, 'admin/work/edit', '查看工单', 1, 1, '', 9),
(11, 'admin/work/del', '删除工单', 1, 1, '', 9),
(12, '', '后台设置', 1, 1, '', 0),
(13, 'admin/setting/site', '基础设置', 1, 1, '', 12),
(14, 'admin/user/index', '用户管理', 1, 1, '', 12),
(15, 'admin/user/addguanli', '添加用户', 1, 1, '', 14),
(16, 'admin/user/editguanli', '修改用户', 1, 1, '', 14),
(17, 'admin/user/delguanli', '删除用户', 1, 1, '', 14),
(18, 'admin/rule/role', '角色管理', 1, 1, '', 12),
(19, 'admin/rule/addrole', '添加角色', 1, 1, '', 18),
(20, 'admin/rule/editrole', '修改角色', 1, 1, '', 18),
(21, 'admin/rule/deleterole', '删除角色', 1, 1, '', 18),
(22, 'admin/rule/index', '节点管理', 1, 1, '', 12),
(23, 'admin/rule/addrule', '添加节点', 1, 1, '', 22),
(24, 'admin/rule/editrule', '修改节点', 1, 1, '', 22),
(25, 'admin/rule/delrule', '删除节点', 1, 1, '', 22),
(26, 'admin/user/grzx', '个人中心', 1, 1, '', 0),
(27, 'admin/user/xgmm', '修改密码', 1, 1, '', 26),
(28, 'admin/library/webuploader', '上传头像', 1, 1, '', 26),
(29, 'admin/library/webuploader', '上传素材', 1, 1, '', 2),
(30, 'admin/rule/hqqx', '获取权限', 1, 1, '', 18),
(31, '1', '1', 1, 1, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `kada_user`
--

CREATE TABLE IF NOT EXISTS `kada_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '用户类型;1:admin;2:会员',
  `sex` tinyint(2) NOT NULL DEFAULT '0' COMMENT '性别;0:保密,1:男,2:女',
  `birthday` int(11) NOT NULL DEFAULT '0' COMMENT '生日',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `coin` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '金币',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `user_status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态;0:禁用,1:正常,2:未验证',
  `user_login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `user_pass` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码;cmf_password加密',
  `user_nickname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户昵称',
  `user_name` varchar(50) DEFAULT '' COMMENT '真实姓名',
  `user_email` varchar(100) NOT NULL DEFAULT '' COMMENT '用户登录邮箱',
  `user_url` varchar(100) NOT NULL DEFAULT '' COMMENT '用户个人网址',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像',
  `signature` varchar(255) NOT NULL DEFAULT '' COMMENT '个性签名',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '' COMMENT '激活码',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '中国手机不带国家代码，国际手机号格式为：国家代码-手机号',
  `more` text COMMENT '扩展属性',
  `wechat` varchar(255) DEFAULT '' COMMENT '微信号',
  PRIMARY KEY (`id`),
  KEY `user_login` (`user_login`),
  KEY `user_nickname` (`user_nickname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='用户表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `kada_user`
--

INSERT INTO `kada_user` (`id`, `user_type`, `sex`, `birthday`, `last_login_time`, `score`, `coin`, `balance`, `create_time`, `user_status`, `user_login`, `user_pass`, `user_nickname`, `user_name`, `user_email`, `user_url`, `avatar`, `signature`, `last_login_ip`, `user_activation_key`, `mobile`, `more`, `wechat`) VALUES
(1, 2, 1, 0, 1568471257, 0, 0, '0.00', 0, 1, 'admin', 'd0367582a2df254282320cb2f7f7e88e', '管理员', '', '70106377@qq.com', '', 'avatar/20190811/983202b90d7ef0e8f24e018ff68f621b.jpg', '因你看见，所以存在。', '127.0.0.1', '', '17681016211', NULL, ''),
(2, 2, 1, 0, 1562660801, 0, 0, '0.00', 0, 1, '17681016211', 'd0367582a2df254282320cb2f7f7e88e', '染柒', '', '70106377@qq.com', '', 'avatar/20190709/9e2212e7d7bbcf592c76c564644ff420.jpg', '因你看见，所以存在', '127.0.0.1', '', '17681016211', NULL, '');

-- --------------------------------------------------------

--
-- 表的结构 `kada_user_token`
--

CREATE TABLE IF NOT EXISTS `kada_user_token` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '用户id',
  `expire_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT ' 过期时间',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `token` varchar(64) NOT NULL DEFAULT '' COMMENT 'token',
  `device_type` varchar(10) NOT NULL DEFAULT '' COMMENT '设备类型;mobile,android,iphone,ipad,web,pc,mac,wxapp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='用户客户端登录 token 表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `kada_user_token`
--

INSERT INTO `kada_user_token` (`id`, `user_id`, `expire_time`, `create_time`, `token`, `device_type`) VALUES
(1, 1, 1578193853, 1562641853, '6ec02f90b8cc317356f2013daad93307495387d2db3518cc87bd65b5443349f6', 'web'),
(2, 2, 1578211869, 1562659869, 'b58ae1a56ddbf4fa928c5b942f0dcb1d5f972a0d7c54f30eb1fddd63781ba390', 'web'),
(3, 3, 1581067299, 1565515299, '9b68878c000c98bfd9fdc4f1b129dedbfa68b910b223472164caf27da702bec4', 'web');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
