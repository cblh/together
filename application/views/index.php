<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bootstrap 3, from LayoutIt!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!-- <?php echo base_url('static/js/jquery.js');?> -->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="<?php echo base_url('static/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('static/css/style.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('static/css/supercoder.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('static/css/bootstrap.css');?>" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('static/img/apple-touch-icon-144-precomposed.png');?>">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('static/img/apple-touch-icon-114-precomposed.png');?>">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('static/img/apple-touch-icon-72-precomposed.png');?>">
  <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('static/img/apple-touch-icon-57-precomposed.png');?>">
  <link rel="shortcut icon" href="<?php echo base_url('static/img/favicon.png');?>">
  
	<script type="text/javascript" src="<?php echo base_url('static/js/jquery.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('static/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('static/js/scripts.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('static/js/jquery.validate.js');?>"></script>
<script type="text/javascript">
$().ready(function() {
$("#sign_in_form").validate({
		rules: {
			username1: {
				required: true,
				minlength: 4
			},
			password1: {
				required: true,
				minlength: 6
			},
		},
		messages: {
			username1: {
				required: "请输入用户名",
				minlength: "用户名至少2个字符"
			},
			password1: {
				required: "请输入密码",
				minlength: "密码长度必须不小于6个字符"
			},
		}
	});
$("#sign_up_form").validate({
		rules: {
			username2: {
				required: true,
				minlength: 4
			},
			password2: {
				required: true,
				minlength: 6
			},
			confirm: {
				required: true,
				minlength: 6,
				equalTo: "#password2"
			},
		},
		messages: {
			username2: {
				required: "请输入用户名",
				minlength: "用户名至少2个字符"
			},
			password2: {
				required: "请输入密码",
				minlength: "密码长度必须不小于6个字符"
			},
			confirm: {
				required: "请输入密码",
				minlength: "密码长度必须不小于6个字符",
				equalTo: "两次的密码不相同"
			},
		}
	});
});
	</script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">

			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">Profile</a>
				</li>
				<li class="disabled">
					<a href="#">Messages</a>
				</li>


				<li class="pull-right">
					<a id="modal-462225" href="#modal-container-462225" role="button" class="btn" data-toggle="modal">登录/注册</a>
			
			<div class="modal fade" id="modal-container-462225" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">

							<div class="tabbable" id="tabs-114891">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-411376" data-toggle="tab">登录</a>
					</li>
					<li>
						<a href="#panel-844272" data-toggle="tab">注册</a>
					</li>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</ul>
			</div>
				
				<div class="tab-content">
					<div class="tab-pane active" id="panel-411376">
						<div class="modal-body">
							<?php $attributes1 = array('role' => 'form', 'id' => 'sign_in_form');
							echo form_open('index',$attributes1);?>
				<div class="form-group">
					 <label for="exampleInputUserName1">用户名</label><?php echo form_input($sign_in_username);?>
				</div>
				<div class="form-group">
					 <label for="exampleInputPassword1">密码</label><?php echo form_password($sign_in_password);?>
				</div>
				<div class="checkbox">
					 <label><?php echo form_checkbox('autoSignIn', '', TRUE);?>记住我</label>
				</div> <button name="sign_in" type="submit" class="btn btn-primary">登录</button>
			<?php echo form_close();?>
						</div>
					</div>
					<div class="tab-pane" id="panel-844272">
						<div class="modal-body">
						<?php $attributes2 = array('role' => 'form', 'id' => 'sign_up_form');
							echo form_open('index',$attributes2);?>
				<div class="form-group">
					 <label for="exampleInputUserName">用户名</label><?php echo form_input($sign_up_username);?>
				</div>
				<div class="form-group">
					 <label for="exampleInputPassword1">密码</label><?php echo form_password($sign_up_password);?>
				</div>
				<div class="form-group">
					 <label for="exampleInputPassword1">确认密码</label><?php echo form_password($sign_up_confirm);?>
				</div>
				<button name="sign_up" type="submit" class="btn btn-primary">注册</button>
			<?php echo form_close();?>
						</div>
					</div>
				</div>
					</div>
					
				</div>
				
			</div>
				</li>


				<li class="dropdown pull-right">
					 <a href="#" data-toggle="dropdown" class="dropdown-toggle">Dropdown<strong class="caret"></strong></a>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Action</a>
						</li>
						<li>
							<a href="#">Another action</a>
						</li>
						<li>
							<a href="#">Something else here</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#">Separated link</a>
						</li>
					</ul>
				</li>
			</ul>
			<div class="jumbotron">
				<h1 class="superh1">
					Super Coder
				</h1>
				<p>
					Super Coder 是一款支持语法高亮和自动补全的在线代码编辑器。基于CodeIgniter和Bootstrap框架，用于教学和编程实践。
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="#">Learn more</a>
				</p>
			</div>
			<div class="row clearfix">
				<div class="col-md-4 column">
					<ul>
						<strong>支持语言列表</strong>
						<li>
							PHP
						</li>
						<li>
							Html
						</li>
						<li>
							Javascript
						</li>
						<li>
							css
						</li>
						</ul>
				</div>
				<div class="col-md-4 column">
					<ul>
						<strong>功能</strong>
						<li>
							支持语法高亮和代码补全
						</li>
						<li>
							完善的用户组管理
						</li>
						<li>
							提供实时协作组件
						</li>
						<li>
							灵活的项目管理系统
						</li>
						<li>
							方便的实时预览功能
						</li>
					</ul>
				</div>
				
				<div class="col-md-4 column">
					 <address> <strong>作者</strong><br /> 陈宝林<br /> 华南师范大学信息光电子科技学院<br /> 郭润民<br /> 华南师范大学信息光电子科技学院<br /> 
				</div>
			</div>

		</div>
	</div>
</div>
</body>
</html>
