<?php
use fayfox\helpers\Html;
use fayfox\models\tables\Messages;
use fayfox\models\Post;
use fayfox\helpers\Date;
?>
<tr valign="top" id="message-<?php echo $data['id']?>">
	<td>
		<?php if($data['user_id']){
			echo Html::encode($data['realname']),
				'<br />',
				"<em class='color-grey' title='用户名'>({$data['username']})</em>";
			
		}else{
			echo '匿名';
		}?>
	</td>
	<td>
		<?php echo Html::encode($data['content'])?>
		<div class="row-actions">
			<?php if(!$data['deleted']){
				if($data['status'] == Messages::STATUS_PENDING){
					echo Html::link('批准', array('admin/message/approve', array(
						'id'=>$data['id'],
					)), array(
						'class'=>'color-green',
					));
					echo Html::link('驳回', array('admin/message/unapprove', array(
						'id'=>$data['id'],
					)), array(
						'class'=>'color-orange',
					));
				}else if($data['status'] == Messages::STATUS_APPROVED){
					echo Html::link('驳回', array('admin/message/unapprove', array(
							'id'=>$data['id'],
					)), array(
							'class'=>'color-orange',
					));
				}else if($data['status'] == Messages::STATUS_UNAPPROVED){
					echo Html::link('批准', array('admin/message/approve', array(
						'id'=>$data['id'],
					)), array(
						'class'=>'color-green',
					));
				}
			}
			
			if($data['deleted']){
				echo Html::link('还原', array('admin/message/undelete', array(
					'id'=>$data['id'],
				)), array(
					'class'=>'color-green',
				));
			}else{
				echo Html::link('回收站', array('admin/message/delete', array(
					'id'=>$data['id'],
				)), array(
					'class'=>'color-red',
				));
			}
			echo Html::link('永久删除', array('admin/message/remove', array(
				'id'=>$data['id'],
			)), array(
				'class'=>'remove-link color-red',
			))?>
		</div>	
	</td>
	<td>
		<?php echo Html::link($data['post_title'], Post::model()->getLink($data['post_id']), array(
			'target'=>'_blank',
		))?>
	</td>
	<td><?php if($data['status'] == Messages::STATUS_APPROVED){
		echo '<span class="color-green">通过</span>';
	}else if($data['status'] == Messages::STATUS_UNAPPROVED){
		echo '<span class="color-red">驳回</span>';
	}else if($data['status'] == Messages::STATUS_PENDING){
		echo '<span class="color-orange">待审</span>';
	}?></td>
	<td>
		<span class="abbr" title="<?php echo Date::format($data['create_time'])?>">
			<?php echo Date::niceShort($data['create_time'])?>
		</span>
	</td>
</tr>