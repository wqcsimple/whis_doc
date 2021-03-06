<?php
use fayfox\core\Controller;
use fayfox\core\Input;
use fayfox\core\Model;
use fayfox\core\Form;
use fayfox\core\Cache;
use fayfox\core\Session;
use fayfox\core\Config;
use fayfox\core\Db;

/**
 * 超级类，可以在任何地方获取各种方法
 */
class F{
	/**
	 * 获取当前Controller实例
	 * @return Controller
	 */
	public static function app(){
		return Controller::getInstance();
	}
	
	/**
	 * 获取Input类实例
	 * @return \fayfox\core\Input
	 */
	public static function input(){
		return Input::getInstance();
	}
	
	/**
	 * 获取Session类实例
	 * @return \fayfox\core\Session
	 */
	public static function session(){
		return Session::getInstance();
	}
	
	/**
	 * 获取一个model实例
	 * @param string $name
	 * @return Model
	 */
	public static function model($name){
		return Model::model($name);
	}
	
	/**
	 * 获取一个表单实例，若name为null，返回第一个被实例化的表单。
	 * 	若没有表单被实例化，实例化一个default
	 * @param null|string $name 默认为第一个被实例化的表单
	 * @return \fayfox\core\Form
	 */
	public static function form($name = 'default'){
		if($name === null){
			return Form::getFirstForm();
		}else{
			return Form::getInstance($name);
		}
	}
	
	/**
	 * 返回所有表单实例
	 * @return Form
	 */
	public static function forms(){
		return Form::getForms();
	}
	
	/**
	 * 获取一个Cache实例
	 * @return \fayfox\core\Cache
	 */
	public static function cache(){
		return Cache::getInstance();
	}
	
	/**
	 * 获取Config实例
	 * @return \fayfox\core\Config
	 */
	public static function config(){
		return Config::getInstance();
	}
	
	/**
	 * 获取F::app()->widget
	 * @return \fayfox\core\FWidget
	 */
	public static function widget(){
		return self::app()->widget;
	}
	
	/**
	 * 返回数据库实例
	 * @return \fayfox\core\Db
	 */
	public static function db(){
		return Db::getInstance();
	}
	
	/**
	 * 过滤一个数组或字符串<br>
	 * 如果是多维数组，会递归过滤所有数组项
	 * @param array|string $filters 可以是数组，也可以是竖线分隔的字符串
	 * @param array|string $data
	 * @param string $fields 可以是数组，也可以是逗号分隔的字符串，但不可以有多余的空格
	 */
	public static function filter($filters, $data, $fields = null){
		return Input::getInstance()->filterR($filters, $data, $fields);
	}
}