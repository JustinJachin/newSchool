-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-03-27 15:15:16
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `myproject`
--

-- --------------------------------------------------------

--
-- 表的结构 `my_academey`
--

CREATE TABLE `my_academey` (
  `id` int(11) NOT NULL COMMENT 'id',
  `academey_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '学院名',
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `num` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '编号',
  `update_time` int(11) NOT NULL COMMENT '创建时间',
  `create_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常0删除'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='学院表';

--
-- 转存表中的数据 `my_academey`
--

INSERT INTO `my_academey` (`id`, `academey_name`, `address`, `num`, `update_time`, `create_time`, `delete_time`, `status`) VALUES
(1, '电子与信息工程学院', '浙江省台州市市府大道1139号 ', '100001', 1585187564, 1585034533, NULL, 1),
(2, '马克思主义学院', '浙江省台州市临海市东方大道605号', '100002', 1585184168, 1585097207, NULL, 1),
(3, '外国语学院', '浙江省台州市临海市东方大道605号', '100003', 1585102528, 1585102528, NULL, 1),
(4, '成人教育学院', '浙江省台州市临海市东方大道605号', '100009', 1585188273, 1585188273, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `my_announcement`
--

CREATE TABLE `my_announcement` (
  `id` int(11) NOT NULL COMMENT '公告id',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '标题',
  `message` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '公告内容',
  `adminId` int(11) NOT NULL COMMENT '发布公告人id',
  `create_time` int(11) NOT NULL COMMENT '发布时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态1正常,0删除'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='公告表';

--
-- 转存表中的数据 `my_announcement`
--

INSERT INTO `my_announcement` (`id`, `title`, `message`, `adminId`, `create_time`, `update_time`, `delete_time`, `status`) VALUES
(1, '暂停审核', '暂停审核', 18, 1585126778, 1585126778, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `my_applyroom`
--

CREATE TABLE `my_applyroom` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL COMMENT '学生id',
  `teacherId` int(11) NOT NULL COMMENT '老师id',
  `roomId` int(11) NOT NULL COMMENT '教室id',
  `reason` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '申请理由',
  `use_time` date NOT NULL COMMENT '使用日期',
  `start_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `agreed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '指导老师是否同意0审核1同意2不同意',
  `create_time` int(11) NOT NULL COMMENT '申请时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `adminagree` tinyint(1) NOT NULL DEFAULT '0' COMMENT '管理员意见0审核中1审核通过2审核未通过3重新申请',
  `message` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '不通过理由'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `my_campus`
--

CREATE TABLE `my_campus` (
  `id` int(11) NOT NULL,
  `campusname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '校区名',
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态1正常,0删除',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='校区表';

--
-- 转存表中的数据 `my_campus`
--

INSERT INTO `my_campus` (`id`, `campusname`, `address`, `create_time`, `update_time`, `status`, `delete_time`) VALUES
(13, '临海校区', '浙江省台州市临海市东方大道605号', 1585189013, 1585189043, 1, NULL),
(12, '椒江校区', '浙江省台州市市府大道1139号', 1585039265, 1585220147, 1, 1585040182),
(11, '东城校区', '浙江省台州市临海市东方大道605号', 1585039256, 1585039256, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `my_lead`
--

CREATE TABLE `my_lead` (
  `id` int(11) NOT NULL,
  `roomId` int(11) NOT NULL COMMENT '教室id',
  `use_time` date NOT NULL COMMENT '使用时间',
  `start_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '结束时间',
  `teacherId` int(11) NOT NULL COMMENT '借用老师',
  `studentId` int(11) NOT NULL COMMENT '借用学生'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='出借表';

-- --------------------------------------------------------

--
-- 表的结构 `my_major`
--

CREATE TABLE `my_major` (
  `id` int(11) NOT NULL COMMENT 'id',
  `profession_id` int(11) NOT NULL COMMENT '专业id',
  `major_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT '班级名',
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT '年级',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态1正常0删除',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='班级表';

--
-- 转存表中的数据 `my_major`
--

INSERT INTO `my_major` (`id`, `profession_id`, `major_name`, `year`, `create_time`, `update_time`, `status`, `delete_time`) VALUES
(1, 3, '17-1', '2017', 1585028895, 1585225711, 0, 1585271622),
(2, 1, '18-1', '2018', 1585028895, 1585028895, 1, NULL),
(3, 1, '19-1', '2019', 1585028895, 1585028895, 1, NULL),
(4, 1, '19-2', '2019', 1585028895, 1585028895, 0, 1585233007),
(5, 1, '19-3', '2019', 1585028895, 1585028895, 0, 1585233007),
(6, 2, '18-1', '2018', 1585028895, 1585028895, 0, 1585227253),
(7, 2, '19-1', '2019', 1585225897, 1585225897, 0, 1585227241);

-- --------------------------------------------------------

--
-- 表的结构 `my_profession`
--

CREATE TABLE `my_profession` (
  `id` int(11) NOT NULL COMMENT 'id',
  `academey_id` int(11) NOT NULL COMMENT '学院id',
  `profession_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '专业名',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态1正常,0删除',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='专业表';

--
-- 转存表中的数据 `my_profession`
--

INSERT INTO `my_profession` (`id`, `academey_id`, `profession_name`, `create_time`, `update_time`, `status`, `delete_time`) VALUES
(1, 1, '计算机科学与技术', 1584412112, 1585190047, 1, NULL),
(2, 1, '数学与应用数学', 1585103868, 1585103868, 1, NULL),
(3, 3, '商务英语', 1585105585, 1585190284, 0, 1585271622),
(4, 3, '汉语专业', 1585190262, 1585190262, 0, 1585233522);

-- --------------------------------------------------------

--
-- 表的结构 `my_room`
--

CREATE TABLE `my_room` (
  `id` int(11) NOT NULL COMMENT 'id',
  `roomname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '教室名',
  `adminId` int(11) NOT NULL COMMENT '负责教室管理员id',
  `campusId` int(11) NOT NULL COMMENT '校区id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='教室表';

-- --------------------------------------------------------

--
-- 表的结构 `my_roomrepair`
--

CREATE TABLE `my_roomrepair` (
  `id` int(11) NOT NULL COMMENT 'id',
  `studentId` int(11) NOT NULL COMMENT '用户id',
  `message` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '故障原因',
  `create_time` int(11) NOT NULL COMMENT '上报时间',
  `roomId` int(11) NOT NULL COMMENT '教室',
  `is_repair` tinyint(4) NOT NULL COMMENT '0上报1维修中2维修成功3暂时无法维护',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='故障报修';

-- --------------------------------------------------------

--
-- 表的结构 `my_useradmin`
--

CREATE TABLE `my_useradmin` (
  `id` int(11) NOT NULL COMMENT 'id',
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '95bb1dc8b1018cd7fed5cd0a4d2104e0' COMMENT '密码',
  `penname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '笔名',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别1男0女',
  `num` int(11) NOT NULL COMMENT '管理员编号',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0超级管理员1管理员',
  `pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT '/img/brand/admin.png' COMMENT '头像',
  `phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `ischange` tinyint(1) NOT NULL DEFAULT '1' COMMENT '真实名字是否修改过1否0是',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态-1删除0禁用1启用',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `loginIP` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '登录ip',
  `login_time` int(11) DEFAULT NULL COMMENT '登录时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='管理员表';

--
-- 转存表中的数据 `my_useradmin`
--

INSERT INTO `my_useradmin` (`id`, `username`, `password`, `penname`, `sex`, `num`, `type`, `pic`, `phone`, `email`, `ischange`, `status`, `create_time`, `update_time`, `delete_time`, `loginIP`, `login_time`) VALUES
(1, 'admin', 'cc03b8e1fde379f6814b3febb8b009ec', '陈张丰', 1, 100000, 0, '/img/brand/admin.png', '15384005653', '941201742@qq.com', 0, 1, 1584412112, 1585190400, NULL, '127.0.0.1', 1584928434),
(18, 'Byrant', 'd29337f31107481125f482f0e74ee4a9', NULL, 1, 100003, 1, '/img/brand/admin.png', '15057219022', '45689512@qq.com', 1, 1, 1585220645, 1585188346, NULL, NULL, NULL),
(17, 'peter', '123123aa', NULL, 1, 100001, 1, '/img/brand/admin.png', '15057219011', 'peter@qq.com', 1, 1, 1585188497, 1585126778, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `my_userstudent`
--

CREATE TABLE `my_userstudent` (
  `id` int(11) NOT NULL COMMENT 'id',
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `penname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '笔名',
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '95bb1dc8b1018cd7fed5cd0a4d2104e0' COMMENT '密码',
  `num` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '学号',
  `pic` varchar(50) COLLATE utf8_unicode_ci DEFAULT '/img/brand/student.png' COMMENT '头像',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别1男0女',
  `phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '-1删除0禁用1启用',
  `classId` int(11) NOT NULL COMMENT '班级id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `login_time` int(11) DEFAULT NULL COMMENT '登录时间',
  `loginIP` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '登录ip',
  `ischange` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否修改1否0是'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='学生表';

--
-- 转存表中的数据 `my_userstudent`
--

INSERT INTO `my_userstudent` (`id`, `username`, `penname`, `password`, `num`, `pic`, `sex`, `phone`, `email`, `status`, `classId`, `create_time`, `update_time`, `delete_time`, `login_time`, `loginIP`, `ischange`) VALUES
(1, 'student', '', 'd29337f31107481125f482f0e74ee4a9', '10000000000', '/img/brand/student.png', 1, NULL, NULL, -1, 1, 1585220478, 1585028865, 1585271622, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `my_userteacher`
--

CREATE TABLE `my_userteacher` (
  `id` int(11) NOT NULL COMMENT 'id',
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '95bb1dc8b1018cd7fed5cd0a4d2104e0' COMMENT '密码',
  `pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT '/img/brand/teacher.png' COMMENT '头像',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别1男0女',
  `num` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '教师编号',
  `phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机',
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `penname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '笔名',
  `ischange` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否修改1否0是',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态-1删除0禁用1启用',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `delete_time` int(11) DEFAULT NULL COMMENT '删除时间',
  `login_time` int(11) DEFAULT NULL COMMENT '登录时间',
  `loginIP` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '登录ip'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='教师表';

--
-- 转存表中的数据 `my_userteacher`
--

INSERT INTO `my_userteacher` (`id`, `username`, `password`, `pic`, `sex`, `num`, `phone`, `email`, `penname`, `ischange`, `status`, `create_time`, `update_time`, `delete_time`, `login_time`, `loginIP`) VALUES
(1, 'teacher', 'd29337f31107481125f482f0e74ee4a9', '/img/brand/teacher.png', 1, '1000000000', NULL, NULL, '', 0, 1, 1585220392, 1585292891, NULL, NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `my_academey`
--
ALTER TABLE `my_academey`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `my_announcement`
--
ALTER TABLE `my_announcement`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `my_applyroom`
--
ALTER TABLE `my_applyroom`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `my_campus`
--
ALTER TABLE `my_campus`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `my_major`
--
ALTER TABLE `my_major`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `my_profession`
--
ALTER TABLE `my_profession`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `my_room`
--
ALTER TABLE `my_room`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `my_roomrepair`
--
ALTER TABLE `my_roomrepair`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `my_useradmin`
--
ALTER TABLE `my_useradmin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_num` (`num`);

--
-- 表的索引 `my_userstudent`
--
ALTER TABLE `my_userstudent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stu_num` (`num`);

--
-- 表的索引 `my_userteacher`
--
ALTER TABLE `my_userteacher`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `my_academey`
--
ALTER TABLE `my_academey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `my_announcement`
--
ALTER TABLE `my_announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '公告id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `my_applyroom`
--
ALTER TABLE `my_applyroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `my_campus`
--
ALTER TABLE `my_campus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `my_major`
--
ALTER TABLE `my_major`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `my_profession`
--
ALTER TABLE `my_profession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `my_room`
--
ALTER TABLE `my_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- 使用表AUTO_INCREMENT `my_roomrepair`
--
ALTER TABLE `my_roomrepair`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- 使用表AUTO_INCREMENT `my_useradmin`
--
ALTER TABLE `my_useradmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=19;

--
-- 使用表AUTO_INCREMENT `my_userstudent`
--
ALTER TABLE `my_userstudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `my_userteacher`
--
ALTER TABLE `my_userteacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
