<?php
namespace fayfox\models\tables;

use fayfox\core\db\Table;

class PostCategories extends Table{
	protected $_name = 'post_categories';
	protected $_primary = array('post_id', 'cat_id');
	
	/**
	 * @return PostCategories
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function rules(){
		return array(
			array(array('post_id'), 'int', array('min'=>0, 'max'=>4294967295)),
			array(array('cat_id'), 'int', array('min'=>0, 'max'=>16777215)),
		);
	}

	public function labels(){
		return array(
			'post_id'=>'Post Id',
			'cat_id'=>'Cat Id',
		);
	}

	public function filters(){
		return array(
			'post_id'=>'intval',
			'cat_id'=>'intval',
		);
	}
}