<?php
namespace fayfox\core;

use fayfox\core\FBase;
use fayfox\helpers\Html;

class View extends FBase{
	/**
	 * 用于试图层的数据
	 * @var array
	 */
	private $_view_data = array();
	private $_null = null;
	
	private $_css = array();
	
	public function url($router = null, $params = array(), $url_rewrite = true){
		$base_url = $this->config('base_url');
		if(!$router){
			return $base_url;
		}else{
			$default_module = $this->config('default_router.module');
			if(strpos($router, $default_module . '/') === 0){
				$router = substr($router, strlen($default_module) + 1);
			}
			$ext = '.html';
			$exts = $this->config('*', 'exts', 'merge_recursive');
			foreach($exts as $key => $val){
				foreach($val as $v){
					if(preg_match('/^'.str_replace(array(
						'/', '*',
					), array(
						'\/', '.*',
					), $v).'$/i', $router)){
						$ext = $key;
						break 2;
					}
				}
			}
			
			if($url_rewrite){
				//完整的url重写
				if($params){
					return $base_url . $router . '/' . str_replace(array('=', '&'), '/', http_build_query($params)) . $ext;
				}else{
					return $base_url . $router . $ext;
				}
			}else{
				//对params部分不做url重写
				if($params){
					return $base_url . $router . $ext . '?' . http_build_query($params);
				}else{
					return $base_url . $router . $ext;
				}
			}
		}
	}
	
	public function staticFile($uri){
		$base_url = $this->config('base_url');
		return $base_url . 'static/' . APPLICATION . '/' . $uri;
	}
	
	/**
	 * 用于输出文章内容等信息
	 * @param string $input
	 * @return string
	 */
	public function escape($input){
		return Html::encode($input);
	}
	
	/**
	 * 向视图传递一堆参数
	 * @param array $options
	 */
	public function assign($options){
		$this->_view_data = array_merge($this->_view_data, $options);
		return $this;
	}
	
	public function getViewData(){
		return $this->_view_data;
	}
	
	/**
	 * 指定视图参数
	 * @param string $key
	 * @param string $value
	 */
	public function __set($key, $value){
		$this->_view_data[$key] = $value;
	}
	
	public function &__get($key){
		if(isset($this->_view_data[$key])){
			return $this->_view_data[$key];
		}else{
			return $this->_null;//直接返回null的话，会报错
		}
	}
	
	public function appendCss($href){
		array_push($this->_css, $href);
	}
	
	public function prependCss($href){
		array_unshift($this->_css, $href);
	}
	
	public function getCss(){
		$html = '';
		foreach($this->_css as $css){
			$html .= '<link type="text/css" rel="stylesheet" href="'.$this->url().$css.'" />'."\r\n";
		}
		return $html;
	}
	
	/**
	 *渲染一个视图
	 * @param string $view 视图文件
	 * @param array $view_data 传递给视图的参数
	 * @param string $layout 模板文件目录
	 * @param array $layout_data 传递给模板的参数
	 */
	public function render($view = null, $layout = null, $return = false){
		$uri = Uri::getInstance();
		$content = $this->renderPartial($view, array(), true);
		
		$module = isset($uri->module) ? $uri->module : $this->config('default_router.module');
		if($layout !== false){
			if($layout !== null){
				//加载模板文件
				$layout_relative_path = "modules/{$module}/layouts/{$layout}.php";
			}else if(!empty(\F::app()->layout_template)){
				$layout_relative_path = "modules/{$module}/layouts/".\F::app()->layout_template.".php";
			}
			if(isset($layout_relative_path)){
				if(file_exists(APPLICATION_PATH.$layout_relative_path)){
					$layout_path = APPLICATION_PATH.$layout_relative_path;
				}else if(file_exists(BACKEND_PATH.$layout_relative_path)){
					$layout_path = BACKEND_PATH.$layout_relative_path;
				}else{
					Response::showError('Layout文件不存在');
				}
			}
		}
		if(isset($layout_path)){
			extract(\F::app()->layout->getLayoutData());
			ob_start();
			include $layout_path;
			$content = ob_get_contents();
			ob_end_clean();
		}
		
		//根据router设置缓存
		$cache_routers = $this->config('*', 'cache');
		$cache_routers_keys = array_keys($cache_routers);
		if(in_array($uri->router, $cache_routers_keys)){
			$filename = md5(json_encode(\F::input()->get($cache_routers[$uri->router]['params'])));
			$filepath = APPLICATION_PATH.'runtimes/cache/pages/'.$uri->router;
			if(\F::input()->post()){
				//有post数据的时候，是否更新页面
				if(isset($cache_routers[$uri->router]['on_post'])){
					if($cache_routers[$uri->router]['on_post'] == 'rebuild'){//刷新缓存
						if(!is_dir($filepath)){
							mkdir($filepath, 0770, true);
						}
						file_put_contents($filepath.'/'.$filename, $content);
					}else if($cache_routers[$uri->router]['on_post'] == 'remove'){//删除缓存
						@unlink($filepath.'/'.$filename);
					}
				}
			}else{
				//没post数据的时候，直接重新生成页面缓存
				if(!is_dir($filepath)){
					mkdir($filepath, 0770, true);
				}
				file_put_contents($filepath.'/'.$filename, $content);
			}
		}
		
		if($return){
			return $content;
		}else{
			echo $content;
			return null;
		}
	}
	
	public function renderPartial($view = null, $view_data = array(), $return = false){
		$uri = Uri::getInstance();
		$module = isset($uri->module) ? $uri->module : $this->config('default_router.module');
		//加载视图文件
		if($view === null){
			$view = strtolower($uri->action);
			$controller = strtolower($uri->controller);
			$view_relative_path = "modules/{$module}/views/{$controller}/{$view}.php";
		}else{
			$view_arr = explode('/', $view);
			
			switch(count($view_arr)){
				case 1:
					$controller = strtolower($uri->controller);
					$action = $view_arr[0];
				break;
				case 2:
					$controller = $view_arr[0];
					$action = $view_arr[1];
				break;
				case 3:
					$module = $view_arr[0];
					$controller = $view_arr[1];
					$action = $view_arr[2];
				break;
			}
			
			$view_relative_path = "modules/{$module}/views/{$controller}/{$action}.php";
		}
		
		if(file_exists(APPLICATION_PATH.$view_relative_path)){
			$view_path = APPLICATION_PATH.$view_relative_path;
		}else if(file_exists(BACKEND_PATH.$view_relative_path)){
			$view_path = BACKEND_PATH.$view_relative_path;
		}
		
		if(!isset($view_path)){
			$content = $view_relative_path.'视图文件不存在';
		}else{
			extract(array_merge($this->getViewData(), $view_data));
			ob_start();
			include $view_path;
			$content = ob_get_contents();
			ob_end_clean();
		}
		
		if($return){
			return $content;
		}else{
			echo $content;
			return null;
		}
	}
}