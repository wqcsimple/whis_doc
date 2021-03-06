<?php
namespace blog\modules\frontend\controllers;

use blog\library\FrontController;
use fayfox\core\Response;
use fayfox\models\Post;

class PostController extends FrontController{
	public function __construct(){
		parent::__construct();
	
		$this->layout->title = '';
		$this->layout->keywords = '';
		$this->layout->description = '';
	
		$this->layout->current_directory = 'blog';
	}
	
	public function item(){
		//auth request
		if(!$this->input->get('id') || !is_numeric($this->input->get('id'))){
			Response::showError('异常的请求');
		}
		
		$post = Post::model()->get($this->input->get('id', 'intval'), 'messages,nav,categories');
		if(!$post){
			Response::showError('404 页面不存在', 404);
		}
		$this->view->post = $post;
		
		//@todo 高亮作品tab
		
		//设置页面SEO信息
		$this->layout->title = $post['seo_title'];
		$this->layout->keywords = $post['seo_keywords'];
		$this->layout->description = $post['seo_description'];
		
		$this->layout->qr_data = 'http://m.fayfox.com/post/'.$post['id'];
		
		$this->layout->canonical = $this->view->url('post/'.$post['id']);
		
		$this->view->render();
	}
}