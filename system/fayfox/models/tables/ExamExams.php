<?php
namespace fayfox\models\tables;

use fayfox\core\db\Table;

class ExamExams extends Table{
	protected $_name = 'exam_exams';
	
	/**
	 * @return ExamExams
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function rules(){
		return array(
			array(array('id', 'user_id', 'paper_id'), 'int', array('min'=>0, 'max'=>16777215)),
			array(array('rand'), 'int', array('min'=>-128, 'max'=>127)),
			array(array('score', 'total_score'), 'float', array('length'=>5, 'decimal'=>2)),
			array(array('start_time', 'end_time'), 'datetime'),
		);
	}

	public function labels(){
		return array(
			'id'=>'Id',
			'user_id'=>'User Id',
			'paper_id'=>'Paper Id',
			'start_time'=>'Start Time',
			'end_time'=>'End Time',
			'score'=>'Score',
			'total_score'=>'Total Score',
			'rand'=>'Rand',
		);
	}

	public function filters(){
		return array(
			'user_id'=>'intval',
			'paper_id'=>'intval',
			'start_time'=>'trim',
			'end_time'=>'trim',
			'score'=>'floatval',
			'total_score'=>'floatval',
			'rand'=>'intval',
		);
	}
}