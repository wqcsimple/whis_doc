<?php
use fayfox\helpers\Html;
?>
<div class="box" id="box-category" data-name="category">
	<div class="box-title">
		<h4>分类</h4>
	</div>
	<div class="box-content">
		<?php echo F::form()->select('cat_id', Html::getSelectOptions($cats));?>
	</div>
</div>