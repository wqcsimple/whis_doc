<?php
namespace backend\modules\tools\controllers;

use fayfox\core\Controller;
use fayfox\models\File;
use fayfox\models\tables\Files;
use fayfox\helpers\Image;
use fayfox\helpers\SecurityCode;
use fayfox\core\Response;
use fayfox\core\Validator;

class FileController extends Controller{
	public function pic(){
		$validator = new Validator();
		$check = $validator->check(array(
			array(array('f'), 'required'),
			array(array('t'), 'range', array('range'=>array('1', '2', '3', '4'))),
			array(array('x','y', 'dw', 'dh', 'w', 'h'), 'int'),
		));
		
		if($check !== true){
			header('Content-type: image/jpeg');
			readfile(BASEPATH . 'images/no-image.jpg');
		}
		
		//显示模式
		$t = $this->input->get('t', 'intval', File::PIC_ORIGINAL);
		
		//文件名或文件id号
		$f = $this->input->get('f');
		if(is_numeric($f)){
			if($f == 0){
				$spares = $this->config->get('spares');
				$spare = $spares[$this->input->get('s', null, 'default')];
					
				header('Content-type: image/jpeg');
				readfile(BASEPATH . $spare);
				die;
			}else{
				$file = Files::model()->find($f);
			}
		}else{
			$file = Files::model()->fetchRow(array('raw = ?'=>$f));
		}

		if(isset($_SERVER['HTTP_IF_NONE_MATCH']) && $file['raw_name'] == $_SERVER['HTTP_IF_NONE_MATCH']){
			header('HTTP/1.1 304 Not Modified');
			die;
		}
		
		//设置缓存
		header("Expires: Sat, 26 Jul 2020 05:00:00 GMT");
		header('Last-Modified: '.gmdate('D, d M Y H:i:s', $file['upload_time']).' GMT');
		header("Cache-control: max-age=3600");
		header("Pragma: cache");
		header('Etag:'.$file['raw_name']);
		
		switch ($t) {
			case File::PIC_ORIGINAL:
				//直接输出图片
				$this->view_pic($file);
				break;
			case File::PIC_THUMBNAIL:
				//输出图片的缩略图
				$this->view_thumbnail($file);
				break;
			case File::PIC_CUT:
				/**
				 * 根据起始坐标，宽度及宽高比裁剪后输出图片
				 * @param $_GET['x'] 起始点x坐标
				 * @param $_GET['y'] 起始点y坐标
				 * @param $_GET['dw'] 输出图像宽度
				 * @param $_GET['dh'] 输出图像高度
				 * @param $_GET['w'] 截图图片的宽度
				 * @param $_GET['h'] 截图图片的高度
				 */
				$this->view_cut($file);
				break;
			case File::PIC_ZOOM:
				/**
				 * 根据给定的宽高对图片进行裁剪后输出图片
				 * @param $_GET['dw'] 输出图像宽度
				 * @param $_GET['dh'] 输出图像高度
				 * 若仅指定高度或者宽度，则会按比例缩放
				 * 若均不指定，则默认为200*200
				 */
				$this->view_zoom($file);
				break;
		
			default:
				;
				break;
		}
	}
	
	private function view_pic($file){
		if($file !== false){
			if(file_exists($file['file_path'].$file['raw_name'].$file['file_ext'])){
				header('Content-type: '.$file['file_type']);
				readfile($file['file_path'].$file['raw_name'].$file['file_ext']);
			}else{
				header('Content-type: image/jpeg');
				readfile(BASEPATH . 'images/no-image.jpg');
			}
		}else{
			header('Content-type: image/jpeg');
			readfile(BASEPATH . 'images/no-image.jpg');
		}
	}
	
	private function view_thumbnail($file){
		if($file !== false){
			header('Content-type: '.$file['file_type']);
			readfile($file['file_path'].$file['raw_name'].'-100x100.jpg');
		}else{
			$spares = $this->config->get('spares');
			$spare = $spares[$this->input->get('s', null, 'default')];
			
			header('Content-type: image/jpeg');
			readfile(BASEPATH.$spare);
		}
	}
	
	private function view_cut($file){
		//x坐标位置
		$x = $this->input->get('x', 'intval', 0);
		//y坐标
		$y = $this->input->get('y', 'intval', 0);
		//输出宽度
		$dw = $this->input->get('dw', 'intval', 0);
		//输出高度
		$dh = $this->input->get('dh', 'intval', 0);
		//选中部分的宽度
		$w = $this->input->get('w', 'intval');
		if(!$w)Response::showError('不完整的请求');
		//选中部分的高度
		$h = $this->input->get('h', 'intval');
		if(!$h)Response::showError('不完整的请求');
		
		if($file !== false){
			$img = Image::get_img($file['file_path'].$file['raw_name'].$file['file_ext']);
		
			if($dw == 0){
				$dw = $w;
			}
			if($dh == 0){
				$dh = $h;
			}
			$img = Image::cut($img, $x, $y, $w, $h);
			$img = Image::zoom($img, $dw, $dh);
		
			header('Content-type: '.$file['file_type']);
			switch ($file['file_type']) {
				case 'image/gif':
					imagegif($img);
					break;
				case 'image/jpeg':
				case 'image/jpg':
					imagejpeg($img);
					break;
				case 'image/png':
					imagepng($img);
					break;
				default:
					imagejpeg($img);
					break;
			}
		}else{
			//图片不存在，显示一张默认图片吧
		}
	}
	
	private function view_zoom($file){
		$spares = $this->config->get('spares');
		$spare = $spares[$this->input->get('s', null, 'default')];
		//输出宽度
		$dw = $this->input->get('dw', 'intval');
		//输出高度
		$dh = $this->input->get('dh', 'intval');
		
		if($dw && !$dh){
			$dh = $dw * ($file['image_height'] / $file['image_width']);
		}else if($dh && !$dw){
			$dw = $dh * ($file['image_width'] / $file['image_height']);
		}else if(!$dw && !$dh){
			$dw = 200;
			$dh = 200;
		}
		
		if($file !== false){
			$img = Image::get_img($file['file_path'].$file['raw_name'].$file['file_ext']);
		
			$img = Image::zoom($img, $dw, $dh);
		
			header('Content-type: '.$file['file_type']);
			switch ($file['file_type']) {
				case 'image/gif':
					imagegif($img);
					break;
				case 'image/jpeg':
				case 'image/jpg':
					imagejpeg($img);
					break;
				case 'image/png':
					imagepng($img);
					break;
				default:
					imagejpeg($img);
					break;
			}
		}else{
			$img = Image::get_img($spare);
			header('Content-type: image/jpeg');
			$img = Image::zoom($img, $dw, $dh);
			imagejpeg($img);
		}
	}
	
	public function vcode(){
		$sc = new SecurityCode($this->input->get('l', 'intval', 4), $this->input->get('w', 'intval', 110), $this->input->get('h', 'intval', 40));
		$sc->ext_line = false;
		$sc->create();
		$this->session->set('vcode', strtolower($sc->randnum));
	}
	
	public function qrcode(){
		$this->plugin->load('phpqrcode/qrlib');
		\QRcode::png(base64_decode($this->input->get('data')), false, QR_ECLEVEL_M, 4, 2);
	}
	
	public function download(){
		if($file_id = $this->input->get('id', 'intval')){
			if($file = Files::model()->find($file_id)){
				Files::model()->inc($file_id, 'downloads', 1);
				$data = file_get_contents($file['file_path'].$file['raw_name'].$file['file_ext']);
				if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE){
					header('Content-Type: "'.$file['file_type'].'"');
					header('Content-Disposition: attachment; filename="'.$file['raw_name'].$file['file_ext'].'"');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header("Content-Transfer-Encoding: binary");
					header('Pragma: public');
					header("Content-Length: ".strlen($data));
				}else{
					header('Content-Type: "'.$file['file_type'].'"');
					header('Content-Disposition: attachment; filename="'.$file['raw_name'].$file['file_ext'].'"');
					header("Content-Transfer-Encoding: binary");
					header('Expires: 0');
					header('Pragma: no-cache');
					header("Content-Length: ".strlen($data));
				}
				die($data);
			}else{
				Response::showError('文件不存在', 404, 404);
			}
		}else{
			Response::showError('参数不正确');
		}
	}
}