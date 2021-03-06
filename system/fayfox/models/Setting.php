<?php
namespace fayfox\models;

use fayfox\core\Model;
use fayfox\models\tables\UserSettings;

class Setting extends Model{
	/**
	 * @return Setting
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	public function rules(){
		return array(
			array('page_size', 'int', array('max'=>100)),
			array('_key', 'required'),
		);
	}

	public function labels(){
		return array(
			'page_size'=>'页面大小',
		);
	}

	public function filters(){
		return array(
			'page_size'=>'intval',
		);
	}
	
	public function set($key, $value, $user_id = null){
		if(UserSettings::model()->fetchRow(array(
			'setting_key = ?'=>$key,
			'user_id = ?'=>$user_id ? $user_id : \F::app()->current_user,
		), 'id')){
			UserSettings::model()->update(array(
				'setting_value'=>json_encode($value),
			), array(
				'setting_key = ?'=>$key,
				'user_id = ?'=>$user_id ? $user_id : \F::app()->current_user,
			));
		}else{
			UserSettings::model()->insert(array(
				'user_id'=>$user_id ? $user_id : \F::app()->current_user,
				'setting_key'=>$key,
				'setting_value'=>json_encode($value),
			));
		}
	}
	
	public function get($key, $user_id = null){
		$setting = UserSettings::model()->fetchRow(array(
			'setting_key = ?'=>$key,
			'user_id = ?'=>$user_id ? $user_id : \F::app()->current_user,
		), 'setting_value');
		if($setting !== false){
			return json_decode($setting['setting_value'], true);
		}else{
			return null;
		}
	}
}