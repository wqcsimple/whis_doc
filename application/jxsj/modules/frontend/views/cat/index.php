<?php
use fayfox\helpers\Html;
use fayfox\F;
?>
<div id="banner">
	<?php $this->widget->load('index-slides')?>
</div>
<div class="w1000 clearfix bg-white">
	<div class="w230 fl">
		<?php
		//直接引用widget
		F::app()->widget->render('fayfox/categories', array(
			'top'=>$cat['id'],
			'title'=>'分类列表',
			'order'=>'views',
			'template'=>'frontend/widget/categories',
		));
		F::app()->widget->render('fayfox/category_post', array(
			'top'=>$cat['id'],
			'title'=>'热门文章',
			'order'=>'views',
			'template'=>'frontend/widget/category_posts',
		));
		$this->renderPartial('common/_login_panel')?>
	</div>
	<div class="ml240">
		<div class="box category-post">
			<div class="box-title">
				<h3><?php echo Html::encode($cat['title'])?></h3>
			</div>
			<div class="box-content">
				<div class="st"><div class="sl"><div class="sr"><div class="sb">
					<div class="p16">
						<div>
							<ul><?php $listview->showData()?></ul>
						</div>
						<?php $listview->showPage();?>
					</div>
				</div></div></div></div>
			</div>
		</div>
	</div>
</div>