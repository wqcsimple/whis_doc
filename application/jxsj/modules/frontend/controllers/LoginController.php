<?php
namespace jxsj\modules\frontend\controllers;

use jxsj\library\FrontController;
use fayfox\models\User;

class LoginController extends FrontController{
	public function index(){
		if($this->input->post()){
			if($this->input->post('vcode') && ($this->input->post('vcode', 'strtolower') != $this->session->get('vcode'))){
				echo '<script>alert("验证码不正确");history.go(-1);</script>';
				die;
			}
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result = User::model()->userLogin($username, $password);
			if($result['status']){
				if($this->input->get('redirect')){
					header('location:'.base64_decode($this->input->get('redirect')));
					die;
				}else{
					$this->redirect('user');
				}
			}else{
				echo '<script>alert("'.$result['error_message'].'");history.go(-1);</script>';
			}
		}
		
		$this->layout_template = null;
		$this->render();
	}
}