<?php
namespace doc\modules\frontend\controllers;
use doc\library\FrontController;
use fayfox\models\Post;
class PostController extends FrontController{
	public function item(){
		$id = $this->input->get('id','intval');
		$this->view->post = Post::model()->get($id);
		
		$this->view->render();
	}
}