<?php
namespace fayfox\core;

use fayfox\core\FBase;

class Response extends FBase{
	/**
	 * 显示错误
	 * @param string $message
	 * @param int $status_code http状态码
	 * @param string $heading
	 */
	public static function showError($message, $status_code = 500, $heading = '出错啦'){
		self::setStatusHeader($status_code);
		$app = \F::app();
		$app || $app = new Controller();
		$app->view->assign(array(
			'message'=>$message,
			'status_code'=>$status_code,
			'heading'=>$heading,
		));
		$app->view->_backtrace = debug_backtrace(false);
		$app->view->renderPartial('common/error_general');
		die;
	}
	
	/**
	 * 发送一个http头
	 * @param int $code
	 * @param string $text
	 */
	public static function setStatusHeader($code = 200, $text = ''){
		$stati = array(
			200	=> 'OK',
			201	=> 'Created',
			202	=> 'Accepted',
			203	=> 'Non-Authoritative Information',
			204	=> 'No Content',
			205	=> 'Reset Content',
			206	=> 'Partial Content',

			300	=> 'Multiple Choices',
			301	=> 'Moved Permanently',
			302	=> 'Found',
			304	=> 'Not Modified',
			305	=> 'Use Proxy',
			307	=> 'Temporary Redirect',

			400	=> 'Bad Request',
			401	=> 'Unauthorized',
			403	=> 'Forbidden',
			404	=> 'Not Found',
			405	=> 'Method Not Allowed',
			406	=> 'Not Acceptable',
			407	=> 'Proxy Authentication Required',
			408	=> 'Request Timeout',
			409	=> 'Conflict',
			410	=> 'Gone',
			411	=> 'Length Required',
			412	=> 'Precondition Failed',
			413	=> 'Request Entity Too Large',
			414	=> 'Request-URI Too Long',
			415	=> 'Unsupported Media Type',
			416	=> 'Requested Range Not Satisfiable',
			417	=> 'Expectation Failed',

			500	=> 'Internal Server Error',
			501	=> 'Not Implemented',
			502	=> 'Bad Gateway',
			503	=> 'Service Unavailable',
			504	=> 'Gateway Timeout',
			505	=> 'HTTP Version Not Supported'
		);
	
		if ($code == '' OR ! is_numeric($code)){
			self::showError('Status codes must be numeric', 500);
		}
	
		if (isset($stati[$code]) AND $text == ''){
			$text = $stati[$code];
		}
	
		if ($text == ''){
			self::showError('No status text available.  Please check your status code number or supply your own message text.', 500);
		}
	
		$server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;
	
		if (substr(php_sapi_name(), 0, 3) == 'cgi'){
			header("Status: {$code} {$text}", TRUE);
		}elseif ($server_protocol == 'HTTP/1.1' OR $server_protocol == 'HTTP/1.0'){
			header($server_protocol." {$code} {$text}", TRUE, $code);
		}else{
			header("HTTP/1.1 {$code} {$text}", TRUE, $code);
		}
	}
	
	/**
	 * 页面跳转
	 * @param string $uri
	 * @param array $params
	 */
	public static function redirect($uri = null, $params = array(), $url_rewrite = true){
		if($uri === null){
			header('location:'.\F::app()->view->url(null));
		}else{
			header('location:'.\F::app()->view->url($uri, $params, $url_rewrite));
		}
		die;
	}
	
	/**
	 * 返回上一页
	 */
	public static function goback(){
		if(isset($_SERVER['HTTP_REFERER'])){
			header('location:'.$_SERVER['HTTP_REFERER']);
		}else{
			echo '<script>history.go(-1);</script>';
		}
		die;
	}
	
	/**
	 * 在非显示性页面调用此方法输出。
	 * 若为ajax访问，则返回json
	 * 若是浏览器访问，则设置flash后跳转
	 * @param string $status 状态success, error
	 * @param array|string $data
	 * @param bool|array $redirect 跳转地址，若为false且是浏览器访问，则返回上一页
	 */
	public static function output($status = 'error', $data = array(), $redirect = false){
		if(!is_array($data)){
			$data = array(
				'message'=>$data,
			);
		}
		if(\F::app()->input->isAjaxRequest()){
			echo json_encode(array(
				'status'=>$status == 'success' ? 1 : 0,
			)+$data);
			die;
		}else{
			if(!empty($data['message'])){
				//若设置了空 的message，则不发flash
				\F::app()->flash->set($data['message'], $status);
			}else if($status == 'success'){
				\F::app()->flash->set('操作成功', $status);
			}else{
				\F::app()->flash->set('操作失败', $status);
			}
			
			if($redirect === false){
				self::goback();
			}else{
				if(is_array($redirect)){
					$redirect = \F::app()->view->url($redirect[0],
						empty($redirect[1]) ? array() : $redirect[1],
						isset($redirect[2]) && $redirect[2] === false ? false : true);
				}
				header('location:'.$redirect);
				die;
			}
		}
	}
}