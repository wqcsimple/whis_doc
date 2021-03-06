<?php
namespace fayfox\models\tables;

use fayfox\core\db\Table;

class Regions extends Table{
	protected $_name = 'regions';
	
	/**
	 * @return Regions
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function rules(){
		return array(
			array(array('id', 'parent_id'), 'int', array('min'=>0, 'max'=>65535)),
			array(array('type'), 'int', array('min'=>-128, 'max'=>127)),
			array(array('name'), 'string', array('max'=>120)),
		);
	}

	public function labels(){
		return array(
			'id'=>'Id',
			'parent_id'=>'Parent Id',
			'name'=>'Name',
			'type'=>'Type',
		);
	}

	public function filters(){
		return array(
			'parent_id'=>'intval',
			'name'=>'trim',
			'type'=>'intval',
		);
	}
}