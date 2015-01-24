<?php
use fayfox\models\Option;
use fayfox\models\Analyst;
?>
<footer class="g-ft">
	<div class="w1000">
		<div class="ft-cp"><?php echo Option::get('copyright')?></div>
		<div class="ft-power">
			今日访问量：<span class="color-red"><?php echo Analyst::model()->getPV()?></span>
			总访问量：<span class="color-red"><?php echo Analyst::model()->getAllPV()?></span>
			技术支持：<a href="http://www.fayfox.com/" target="_blank">Fayfox</a>
		</div>
	</div>
</footer>
<script type="text/javascript" src="<?php echo $this->view->url('tools/analyst.js')?>?1"></script>