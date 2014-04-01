DROP TABLE IF EXISTS `{DB_PREFIX}rights`{SEPERATOR}
CREATE TABLE IF NOT EXISTS `{DB_PREFIX}rights` (
  `right_id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `right_name` varchar(30) DEFAULT NULL,
  `right_class` varchar(30) DEFAULT NULL,
  `right_method` varchar(30) DEFAULT NULL,
  `right_detail` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`right_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8{SEPERATOR}
DELETE FROM `{DB_PREFIX}rights`{SEPERATOR}
INSERT INTO `{DB_PREFIX}rights` (`right_id`, `right_name`, `right_class`, `right_method`, `right_detail`) VALUES (1, '密码修改', 'system', 'password', NULL), (2, '更新缓存', 'system', 'cache', NULL), (3, ' 站点设置', 'setting', 'site', NULL), (4, '后台设置', 'setting', 'backend', NULL), (5, '插件管理[列表]', 'plugin', 'view', NULL), (6, '添加插件', 'plugin', 'add', NULL), (7, '修改插件', 'plugin', 'edit', NULL), (8, '卸载插件', 'plugin', 'del', NULL), (9, '导出插件', 'plugin', 'export', NULL), (10, '导入插件', 'plugin', 'import', NULL), (11, '激活插件', 'plugin', 'active', NULL), (12, '禁用插件', 'plugin', 'deactive', NULL), (13, '运行插件', 'module', 'run', NULL), (14, '内容模型管理[列表]', 'model', 'view', NULL), (15, '添加内容模型', 'model', 'add', NULL), (16, '修改内容模型', 'model', 'edit', NULL), (17, '删除内容模型', 'model', 'del', NULL), (18, '内容模型字段管理[列表]', 'model', 'fields', NULL), (19, '添加内容模型字段', 'model', 'add_filed', NULL), (20, '修改内容模型字段', 'model', 'edit_field', NULL), (21, '删除内容模型字段', 'model', 'del_field', NULL), (22, '分类模型管理[列表]', 'category', 'view', NULL), (23, '添加分类模型', 'category', 'add', NULL), (24, '修改分类模型', 'category', 'edit', NULL), (25, '删除分类模型', 'category', 'del', NULL), (26, '分类模型字段管理[列表]', 'category', 'fields', NULL), (27, '添加分类模型字段', 'category', 'add_filed', NULL), (28, '修改分类模型字段', 'category', 'edit_field', NULL), (29, '删除分类模型字段', 'category', 'del_field', NULL), (30, '内容管理[列表]', 'content', 'view', NULL), (31, '添加内容[表单]', 'content', 'form', 'add'), (32, '修改内容[表单]', 'content', 'form', 'edit'), (33, '添加内容[动作]', 'content', 'save', 'add'), (34, '修改内容[动作]', 'content', 'save', 'edit'), (35, '删除内容', 'content', 'del', NULL), (36, '分类管理[列表]', 'category_content', 'view', NULL), (37, '添加分类[表单]', 'category_content', 'form', 'add'), (38, '修改分类[表单]', 'category_content', 'form', 'edit'), (39, '添加分类[动作]', 'category_content', 'save', 'add'), (40, '修改分类[动作]', 'category_content', 'save', 'edit'), (41, '删除分类', 'category_content', 'del', NULL), (42, '用户组管理[列表]', 'role', 'view', NULL), (43, '添加用户组', 'role', 'add', NULL), (44, '修改用户组', 'role', 'edit', NULL), (45, '删除用户组', 'role', 'del', NULL), (46, '用户管理[列表]', 'user', 'view', NULL), (47, '添加用户', 'user', 'add', NULL), (48, '修改用户', 'user', 'edit', NULL), (49, '删除用户', 'user', 'del', NULL), (50, '数据库备份', 'database', 'index', NULL), (51, '数据库还原', 'database', 'recover', NULL), (52, '数据库优化', 'database', 'optimize', NULL)