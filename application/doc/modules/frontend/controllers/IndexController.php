<?php
namespace doc\modules\frontend\controllers;
use doc\library\FrontController;
class IndexController extends FrontController{
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
	
		$this->view->render();
	}
	
}