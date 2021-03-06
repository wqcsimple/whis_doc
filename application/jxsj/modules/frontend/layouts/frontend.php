<?php
use fayfox\models\Option;
use fayfox\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="<?php echo $this->view->staticFile('css/style.css')?>" />
<?php echo $this->view->getCss()?>
<script type="text/javascript" src="<?php echo $this->view->url()?>js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->view->url()?>js/custom/system-min.js"></script>
<script>
system.base_url = '<?php echo $this->view->url()?>';
system.user_id = '<?php echo $this->session->get('id', 0)?>';
</script>
<link type="image/x-icon" href="<?php echo $this->view->url()?>favicon.ico" rel="shortcut icon" />
<!--[if IE 6]>
	<script type="text/javascript" src="<?php echo $this->view->url()?>js/DD_belatedPNG_0.0.8a-min.js"></script>
<![endif]-->
<meta content="<?php if(isset($keywords))echo Html::encode($keywords);?>" name="keywords" />
<meta content="<?php if(isset($description))echo Html::encode($description);?>" name="description" />
<!--[if lt IE 9]>
	<script type="text/javascript" src="<?php echo $this->view->url()?>js/html5.js"></script>
<![endif]-->
<title><?php if(!empty($title))echo $title . '_'?><?php echo Option::get('sitename')?></title>
</head>
<body>
<div class="wrapper">
	<?php include '_header.php'?>
	<?php include '_navigation.php'?>
	<?php echo $content?>
	<?php include '_footer.php'?>
</div>
</body>
</html>