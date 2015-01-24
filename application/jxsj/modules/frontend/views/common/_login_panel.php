<?php
use fayfox\F;
use fayfox\helpers\Html;
?>
<div class="box" id="login-panel">
	<form id="login-form" action="<?php echo $this->view->url('login')?>" method="post">
		<div class="box-content">
			<div class="st"><div class="sl"><div class="sr"><div class="sb">
				<div class="p16 clearfix">
					<h2>用户登录</h2>
					<table>
						<tr>
							<th width="53">会&nbsp;&nbsp;&nbsp;员：</th>
							<td><?php echo F::form()->inputText('username', array(
								'class'=>'wp90',
							))?></td>
						</tr>
						<tr>
							<th>密&nbsp;&nbsp;&nbsp;码：</th>
							<td><?php echo F::form()->inputPassword('password', array(
								'class'=>'wp90',
							))?></td>
						</tr>
						<tr>
							<th>验证码：</th>
							<td><?php
								echo F::form()->inputText('vcode', array(
									'class'=>'wp40',
								));
								echo Html::img($this->view->url('file/vcode', array(
									'w'=>64,
									'h'=>23,
								)).'?', 1, array(
									'onClick'=>'this.src=this.src+Math.random()',
									'class'=>'vam ml10',
								));
							?></td>
						</tr>
						<tr>
							<th></th>
							<td><a href="javascript:;" class="btn-blue" id="login-form-submit">登录</a></td>
						</tr>
					</table>
				</div>
			</div></div></div></div>
		</div>
	</form>
</div>
<script>
$(function(){
	$('#login-form-submit').on('click', function(){
		$("#login-form").submit();
	});
	$("#login-form").on('keypress', ':text,:password', function(event){
		if(event.keyCode==13){
			$("#login-form").submit();
		}
	});
});
</script>