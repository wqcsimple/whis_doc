<?php
use fayfox\models\tables\Vouchers;
use fayfox\helpers\Html;
?>
<form id="form" class="validform" action="" method="post">
	<div class="form-field">
		<label class="title">类型</label>
		<?php echo F::form()->inputRadio('type', Vouchers::TYPE_CASH, array(
			'label'=>'现金卷',
		), true)?>
		<?php echo F::form()->inputRadio('type', Vouchers::TYPE_DISCOUNT, array(
			'label'=>'折扣卷',
		))?>
	</div>
	<div class="form-field">
		<label class="title">分类</label>
		<?php echo F::form()->select('cat_id', Html::getSelectOptions($cats, 'id', 'title'))?>
	</div>
	<div class="form-field">
		<label class="title">金额/折扣</label>
		<?php echo F::form()->inputText('amount')?>
		<p class="color-grey p5">抵价金额或折扣</p>
	</div>
	<div class="form-field">
		<label class="title">使用次数限制</label>
		<?php echo F::form()->inputText('counts', array(), 1)?>
		<p class="color-grey p5">-1为不限制使用次数</p>
	</div>
	<div class="form-field">
		<label class="title" >开始时间</label>
		<?php echo F::form()->inputText('start_time', array(
			'id'=>'start_time',
		))?>
		<p class="color-grey p5">若为空，则只要不过期，就能使用</p>
	</div>
	<div class="form-field">
		<label class="title">结束时间</label>
		<?php echo F::form()->inputText('end_time', array(
			'id'=>'end_time',
		))?>
		<p class="color-grey p5">若为空，则永久有效</p>
	</div>
	<div class="form-field">
		<label class="title">数量</label>
		<?php echo F::form()->inputText('num', array(), 1)?>
		个
	</div>
	<div class="form-field">
		<a href="javascript:;" class="btn-1" id="form-submit">生成</a>
	</div>
</form>