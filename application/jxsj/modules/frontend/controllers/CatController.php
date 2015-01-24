<?php
namespace jxsj\modules\frontend\controllers;

use jxsj\library\FrontController;
use fayfox\models\Category;
use fayfox\core\Sql;
use fayfox\models\tables\Posts;
use fayfox\common\ListView;

class CatController extends FrontController{
	public function index(){
		$cat = Category::model()->get($this->input->get('id', 'intval'));
		
		if(!$cat){
			$this->showError('您访问的页面不存在', 404, '404');
		}
		
		$this->view->cat = $cat;
		
		$sql = new Sql();
		$sql->from('posts', 'p', 'id,title,publish_time')
			->joinLeft('categories', 'c', 'p.cat_id = c.id')
			->order('p.is_top DESC, p.sort, p.publish_time DESC')
			->where(array(
				'c.left_value >= '.$cat['left_value'],
				'c.right_value <= '.$cat['right_value'],
				'p.deleted = 0',
				'p.status = '.Posts::STATUS_PUBLISH,
				'p.publish_time < '.$this->current_time,
			))
		;
		$this->view->listview = new ListView($sql, array(
			'pageSize'=>10,
			'reload'=>$this->view->url('cat/'.$cat['id']),
		));
				
		$this->render();
	}
	
}









