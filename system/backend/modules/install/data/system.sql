-- 系统用户和留言用户
INSERT INTO `{{$prefix}}users` (id, username, realname) VALUES ('1', '系统', '系统');
INSERT INTO `{{$prefix}}users` (id, username, realname) VALUES ('2', '用户留言收件人', '用户留言收件人');
INSERT INTO `{{$prefix}}users` (id, username, realname) VALUES ('3', '系统消息', '系统消息');

-- users表id从10000开始自递增
ALTER TABLE {{$prefix}}users AUTO_INCREMENT = 10000;
		
-- categories表id从1000开始自递增
ALTER TABLE {{$prefix}}categories AUTO_INCREMENT = 10000;
		
-- roles表新增超级管理员和系统角色
INSERT INTO `{{$prefix}}roles` VALUES ('1', '普通用户', '', '0', '1');
INSERT INTO `{{$prefix}}roles` VALUES ('100', '系统', '', '0', '0');
INSERT INTO `{{$prefix}}roles` VALUES ('101', '超级管理员', '', '0', '0');

-- files表id从10000开始递增
ALTER TABLE {{$prefix}}files AUTO_INCREMENT = 1000;

-- posts表id从10000开始递增
ALTER TABLE {{$prefix}}posts AUTO_INCREMENT = 1000;

-- pages表id从10000开始递增
ALTER TABLE {{$prefix}}pages AUTO_INCREMENT = 1000;

-- 访问统计本地站点
INSERT INTO `{{$prefix}}analyst_sites` VALUES ('1', 'localhost', '本站', '0');