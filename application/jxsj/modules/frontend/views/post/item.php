<?php
use fayfox\helpers\Html;
use fayfox\helpers\Date;
use fayfox\F;
use fayfox\models\File;
?>
<div id="banner">
	<?php $this->widget->load('index-slides')?>
</div>
<div class="w1000 clearfix bg-white">
	<div class="w230 fl">
		<?php
		//直接引用widget
		F::app()->widget->render('fayfox/category_post', array(
			'top'=>$post['cat_id'],
			'title'=>'最新添加',
			'order'=>'publish_time',
			'template'=>'frontend/widget/category_posts',
		));
		//登录框
		$this->renderPartial('common/_login_panel')?>
	</div>
	<div class="ml240">
		<div class="box" id="post-item">
			<div class="box-title">
				<h3><?php echo Html::link($post['cat_title'], array('cat/'.$post['cat_id']))?></h3>
			</div>
			<div class="box-content">
				<div class="st"><div class="sl"><div class="sr"><div class="sb">
					<div class="p16">
						<h1><?php echo Html::encode($post['title'])?></h1>
						<div class="meta">
							发布时间：<?php echo Date::niceShort($post['publish_time'])?>
							<span class="ml10">阅读数：<?php echo $post['views']?></span>
						</div>
						<div class="post-content">
						<?php
							if($post['thumbnail']){
								echo Html::img($post['thumbnail'], File::PIC_ORIGINAL);
							}
							echo $post['content'];
							if(!empty($post['files'])){
								echo '附件：';
								foreach($post['files'] as $f){
									echo Html::link($f['desc'], array('file/download', array(
										'id'=>$f['file_id'],
									)));
								}
							}
						?>
						</div>
						<div class="post-nav">
							<p>上一篇：<?php if($post['nav']['prev']){
								echo Html::link($post['nav']['prev']['title'], array(
									'post/'.$post['nav']['prev']['id'],
								));
							}else{
								echo '没有了';
							}?></p>
							<p>下一篇：<?php if($post['nav']['next']){
								echo Html::link($post['nav']['next']['title'], array(
									'post/'.$post['nav']['next']['id'],
								));
							}else{
								echo '没有了';
							}?></p>
						</div>
					</div>
				</div></div></div></div>
			</div>
		</div>
	</div>
</div>
