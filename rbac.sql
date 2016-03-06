--用户表(管理员)
CREATE TABLE `sw_manager` (
  `mg_id` int(11) NOT NULL AUTO_INCREMENT,
  `mg_name` varchar(32) NOT NULL,
  `mg_pwd` varchar(32) NOT NULL,
  `mg_time` int(10) unsigned NOT NULL COMMENT '时间',
  `mg_role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  PRIMARY KEY (`mg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8


--权限表
CREATE TABLE `sw_auth` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_path` varchar(32) NOT NULL COMMENT '全路径',
  ① 顶级权限：为当前记录的id值
  ② 非顶级权限：为"父级全路径-本身记录id值"
  `auth_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '级别',
  表示权限的等级管理，从“0”开始计数
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8

--角色表
CREATE TABLE `sw_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids,1,2,5',
  `role_auth_ac` text COMMENT '控制器-操作方法',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8


角色：
    董事长
    总监
    高级经理
    经理
    项目经理
    业务主管
	客服
	技术支持
	美工
    员工
    
模拟数据：
1) 权限表：
商品管理(商品列表、添加商品、商品分类)
订单管理(订单列表、订单查询)
权限管理(管理员列表、角色管理、权限管理)

id  name  pid  controller  action  path level
insert into sw_auth values (10,'商品管理',0,"","",10,0);
insert into sw_auth values (11,'订单管理',0,"","",11,0);
insert into sw_auth values (12,'权限管理',0,"","",12,0);

insert into sw_auth values (21,'商品列表',10,"Goods","showlist","10-21",1);
insert into sw_auth values (22,'添加商品',10,"Goods","tianjia","10-22",1);
insert into sw_auth values (23,'商品分类',10,"Goods","category","10-23",1);

insert into sw_auth values (31,'订单列表',11,"Order","showlist","11-31",1);
insert into sw_auth values (32,'订单查询',11,"Order","search","11-32",1);

insert into sw_auth values (41,'管理员列表',12,"Manager","showlist","12-41",1);
insert into sw_auth values (42,'角色管理',12,"Role","showlist","12-42",1);
insert into sw_auth values (43,'权限管理',12,"Auth","showlist","12-43",1);
    
2) 角色表(主管、经理)
id  name   ids    ac
insert into sw_role values(100,'主管',"10,11,21,22,31","Goods-showlist,Goods-tianjia,Order-showlist");
insert into sw_role values(101,'经理',"11,31,32","Order-showlist,Order-search");

