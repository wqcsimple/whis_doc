<?php
namespace jxsj\library;

use fayfox\core\Uri;

class UserController extends FrontController{
	public $layout_template = 'default';
	/**
	 * 当前用户id（users表中的ID）
	 * @var int
	 */
	public $current_user = 0;

	public function __construct(){
		parent::__construct();
		
		//验证session中是否有值
		if(!$this->session->get('id')){
			$this->redirect('login', array(
				'redirect'=>base64_encode($this->view->url(Uri::getInstance()->router, $this->input->get())),
			), false);
		}
		
		$this->current_user = $this->session->get('id');
	}
}