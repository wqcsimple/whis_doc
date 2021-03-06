<?php
use fayfox\helpers\Html;
use fayfox\models\tables\ExamQuestions;
use fayfox\helpers\Date;
?>
<tr valign="top">
	<td><?php echo Html::inputCheckbox('ids[]', $data['id'], false, array(
		'class'=>'batch-ids',
	));?></td>
	<td>
		<strong><?php echo strip_tags($data['question'], '<u>')?></strong>
		<div class="row-actions">
			<?php 
				echo Html::link('编辑', array('admin/exam-question/edit', array(
					'id'=>$data['id'],
				)), array(), true);
				echo Html::link('删除', array('admin/exam-question/delete', array(
					'id'=>$data['id'],
				)), array(
					'class'=>'color-red remove-link',
				), true);
			?>
		</div>
	</td>
	<td><?php echo Html::encode($data['cat_title']);?></td>
	<td><?php echo Html::encode($data['score']);?></td>
	<td><?php switch($data['type']){
		case ExamQuestions::TYPE_SINGLE_ANSWER:
			echo '单选题';
			break;
		case ExamQuestions::TYPE_MULTIPLE_ANSWERS:
			echo '多选题';
			break;
		case ExamQuestions::TYPE_INPUT:
			echo '输入题';
			break;
		case ExamQuestions::TYPE_TRUE_OR_FALSE:
			echo '判断题';
			break;
	}?></td>
	<td><?php switch($data['status']){
		case ExamQuestions::STATUS_ENABLED:
			echo '<span class="color-green">启用</span>';
			break;
		case ExamQuestions::STATUS_DISABLED:
			echo '<span class="color-red">禁用</span>';
			break;
	}?></td>
	<td><span class="time abbr" title="<?php echo Date::format($data['create_time'])?>">
		<?php echo Date::niceShort($data['create_time'])?>
	</span></td>
</tr>