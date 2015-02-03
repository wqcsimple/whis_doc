<?php
return array(
		/*
		 * 数据库参数
*/
		'db'=>array(
// 				'host'=>'localhost',					//数据库服务器
// 				'user'=>'root',							//用户名
// 				'password'=>'',							//密码
                'host'=>'114.215.134.73',
		        'user'=>'whis',
		        'password'=>'chen19921012',
				'dbname'=>'whis_doc',						//数据库名
				'charset'=>'utf8',						//数据库编码方式
				'table_prefix'=>'whis_',					//数据库表前缀
		),
		
		/*
		 * 在一台服务器上跑多个cms的时候，以此区分session，可以随便设置一个
		*/
		'session_namespace'=>'doc',
		
		/*
		 * 当前application包含的模块
		*/
		'modules'=>array(
				'frontend'
		),
);