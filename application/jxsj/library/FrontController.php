<?php
namespace jxsj\library;

use fayfox\core\Controller;
use fayfox\helpers\RequestHelper;
use fayfox\models\tables\SpiderLogs;

class FrontController extends Controller{
	public $layout_template = 'frontend';
	public $current_user = 0;
	
	public function __construct(){
		parent::__construct();
		
		//设置当前用户id
		$this->current_user = $this->session->get('id', 0);
		
		if($spider = RequestHelper::isSpider()){//如果是蜘蛛，记录蜘蛛日志
			SpiderLogs::model()->insert(array(
				'spider'=>$spider,
				'url'=>'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
				'user_agent'=>$_SERVER['HTTP_USER_AGENT'],
				'ip_int'=>RequestHelper::ip2int($this->ip),
				'create_time'=>$this->current_time,
			));
		}
	}
	
	public function showValidError($errors){
		$html = '';
		foreach($errors as $e){
			$html .= "<p>{$e[2]}</p>";
		}
		return $html;
	}
}