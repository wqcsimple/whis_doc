<?php
namespace jxsj\hooks;

use fayfox\core\FBase;
use fayfox\F;

class HideBoxes extends FBase{
	public function run(){
		//移除分类选择，该系统不需要多分类体系
		F::app()->removeBox('alias');
		F::app()->removeBox('abstract');
		F::app()->removeBox('tags');
		F::app()->removeBox('keywords');
		F::app()->removeBox('gather');
		F::app()->removeBox('category');
		F::app()->removeBox('props');
	}
}