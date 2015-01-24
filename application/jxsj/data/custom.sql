-- 创建管理员角色
INSERT INTO `{{$prefix}}roles` VALUES ('102', '管理员', '', '0', '1');

-- 赋予管理员权限
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '1');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '2');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '3');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '4');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '5');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '6');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '7');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '8');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '11');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '12');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '13');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '15');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '16');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '17');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '18');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '28');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '29');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '30');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '31');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '32');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '33');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '34');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '35');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '36');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '37');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '38');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '39');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '40');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '41');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '42');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '43');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '44');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '45');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '46');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '47');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '48');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '49');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '51');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '56');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '57');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '58');
INSERT INTO `{{$prefix}}role_actions` (`role_id`, `action_id`) VALUES ('102', '59');

-- 必须有的小工具实例
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `enabled`) VALUES ('contact', '{\"data\":[{\"key\":\"\\u7535\\u8bdd\",\"value\":\"13616546418\"},{\"key\":\"\\u90ae\\u7bb1\",\"value\":\"admin@fayfox.com\"},{\"key\":\"QQ\",\"value\":\"369281831\"},{\"key\":\"\\u5730\\u5740\",\"value\":\"\\u676d\\u5dde\\u5e02\\u6ee8\\u6c5f\\u533a\\u6d77\\u5a01\\u56fd\\u9645\"}],\"template\":\"<p><label>{$key}\\uff1a<\\/label>{$value}<\\/p>\"}', 'fayfox/options', '联系我们', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `enabled`) VALUES ('index-slides', '{\"height\":216,\"transPeriod\":800,\"time\":5000,\"fx\":\"random\",\"files\":[]}', 'fayfox/jq_camera', '首页轮播图', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `enabled`) VALUES ('index-1-1', '{\"subclassification\":1,\"top\":1,\"title\":\"\",\"number\":7,\"uri\":\"post\\/{$id}\",\"template\":\"frontend\\/widget\\/category_posts\",\"date_format\":\"\",\"order\":\"hand\"}', 'fayfox/category_post', '首页第一排', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `enabled`) VALUES ('index-2-1', '{\"subclassification\":1,\"top\":1,\"title\":\"\",\"number\":6,\"uri\":\"post\\/{$id}\",\"template\":\"frontend\\/widget\\/category_posts\",\"date_format\":\"\",\"order\":\"hand\"}', 'fayfox/category_post', '首页第二排第一个', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `enabled`) VALUES ('index-2-2', '{\"subclassification\":1,\"top\":1,\"title\":\"\",\"number\":6,\"uri\":\"post\\/{$id}\",\"template\":\"frontend\\/widget\\/category_posts\",\"date_format\":\"[Y-m-d]\",\"order\":\"hand\"}', 'fayfox/category_post', '首页第二排第二个', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `enabled`) VALUES ('friendlinks', '{\"title\":\"\",\"number\":3,\"template\":\"frontend\\/widget\\/friendlinks\"}', 'fayfox/friendlinks', '友情链接', '1');
INSERT INTO `{{$prefix}}widgets` (`alias`, `options`, `widget_name`, `description`, `enabled`) VALUES ('index-bottom-gallery', '{\"subclassification\":1,\"top\":1,\"title\":\"\",\"number\":10,\"uri\":\"post\\/{$id}\",\"template\":\"frontend\\/widget\\/category_posts_gallery\",\"date_format\":\"\",\"thumbnail\":1,\"order\":\"hand\"}', 'fayfox/category_post', '首页底部画廊', '1');

-- 必须的页面分类
INSERT INTO `{{$prefix}}categories` (`title`, `alias`, `parent`, `sort`, `is_nav`, `is_system`) VALUES ('课程概况', 'about', '2', '100', '1', '1');

-- 必须的页面
INSERT INTO `{{$prefix}}pages` (`title`, `alias`) VALUES ('课程简介', 'about');