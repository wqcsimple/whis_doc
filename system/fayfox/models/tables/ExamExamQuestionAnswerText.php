<?php
namespace fayfox\models\tables;

use fayfox\core\db\Table;

class ExamExamQuestionAnswerText extends Table{
	protected $_name = 'exam_exam_question_answer_text';
	protected $_primary = 'exam_question_id';
	
	/**
	 * @return ExamExamQuestionAnswerText
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function rules(){
		return array(
			array(array('exam_question_id'), 'int', array('min'=>-2147483648, 'max'=>2147483647)),
		);
	}

	public function labels(){
		return array(
			'exam_question_id'=>'Exam Question Id',
			'user_answer'=>'User Answer',
		);
	}

	public function filters(){
		return array(
			'exam_question_id'=>'intval',
			'user_answer'=>'',
		);
	}
}