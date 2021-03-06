<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>婚纱影楼客户端</title>
		<meta name="description" content="light7: Build mobile apps with simple HTML, CSS, and JS components.">
		<meta name="author" content="任行">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="/hsylglxt/View/Index/Public/img/icon.jpg">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!-- Google Web Fonts -->

		<link rel="stylesheet" href="/hsylglxt/View/Index/Public/css/light7e0da.css?r=201603281">
		<link rel="stylesheet" href="/hsylglxt/View/Index/Public/css/light7-swiper.css">
		<link rel="stylesheet" href="/hsylglxt/View/Index/Public/css/light7-swipeout.css">
		<link rel="stylesheet" href="/hsylglxt/View/Index/Public/css/demos.css">

		<link rel="apple-touch-icon-precomposed" href="/hsylglxt/View/Index/Public/img/apple-touch-icon-114x114.png">
		<script src="/hsylglxt/View/Index/Public/js/jquery-2.1.4.js"></script>
		<style>
			/*header背景色调*/
			.bar {
				background-color: rgba(255, 105, 180, 0.8);
			}
		</style>
	</head>

	<body>
		<div id="page-check-list" class="page">
			<header class="bar bar-nav">
				<a class="button button-link button-nav pull-left back">
					<span class="icon icon-left"></span> Back
				</a>
				<h1 class="title">个人信息</h1>
			</header>
			<div class="content">
				<div class="list-block">
					<ul>
						<li>
							<div class="item-content">
								<div class="item-media"><i class="icon icon-form-name"></i></div>
								<div class="item-inner">
									<div class="item-title label">姓名</div>
									<div class="item-input">
										<input id="nickname" type="text" placeholder="Your name">
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-media"><i class="icon icon-form-email"></i></div>
								<div class="item-inner">
									<div class="item-title label">手机号</div>
									<div class="item-input">
										<input id="phone" type="text">
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-media"><i class="icon icon-form-password"></i></div>
								<div class="item-inner">
									<div class="item-title label">密码</div>
									<div class="item-input">
										<input id="password" type="password">
									</div>
								</div>
							</div>
						</li>
						<!-- Date -->
						<li>
							<div class="item-content">
								<div class="item-media"><i class="icon icon-form-calendar"></i></div>
								<div class="item-inner">
									<div class="item-title label">结婚日期</div>
									<div class="item-input">
										<input id="weddingDate" type="text" data-toggle="date">
									</div>
								</div>
							</div>
						</li>
						<li class="align-top">
							<div class="item-content">
								<div class="item-media"><i class="icon icon-form-comment"></i></div>
								<div class="item-inner">
									<div class="item-title label">对另一半的话</div>
									<div class="item-input">
										<textarea id="loveWords"></textarea>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="content-block">
					<div class="row">
						<div class="col-100">
							<a id="submitChange" class="button button-big button-fill button-success">提交修改</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="/hsylglxt/View/Index/Public/js/light7.js"></script>
		<script src="/hsylglxt/View/Index/Public/js/light7-swiper.js"></script>
		<script src="/hsylglxt/View/Index/Public/js/light7-city-picker.js"></script>
		<script src="/hsylglxt/View/Index/Public/js/light7-swipeout.js"></script>
		<script src="/hsylglxt/View/Index/Public/js/demose0da.js?r=201603281"></script>
		<script src="/hsylglxt/View/Index/Public/js/shop/my_message.js"></script>
		<script>
			$("#birthday").calendar();
			$.loadUserMessage = function() {
				$.ajax({
					type: "post",
					url: "<?php echo U('user/loadUserMessage');?>",
					async: true,
					data: {
						userID: sessionStorage.getItem("userID")
					},
					success: function(d) {
						var data = JSON.parse(d);
						
						if(data.code == "0000") {
							$("#nickname").val(data.data[0]["nickname"]);
							$("#password").val(data.data[0]["password"]);
							$("#loveWords").val(data.data[0]["lovewords"]);
							$("#phone").val(data.data[0]["phonenumber"]);
							$("#weddingDate").val(data.data[0]["weddingdate"]);
						} else {
							$.toast("用户信息加载异常");
						}
					}
				});
			}
			$.loadUserMessage();

			$("#submitChange").on("click", function() {
				/*var re = /^[a-zA-z]\w{3,15}$/;
				if(!re.test($("#email").val())) {
					$.toast("请输入有效的手机号！");
					return;
				}*/
				if($("#nickname").val().length == 0 || $("#password").val().length == 0 || $("#loveWords").val().length == 0 || $("#weddingDate").val() == 0) {
					$.toast("未填写完整~");
				} else {
					$.ajax({
						type: "post",
						url: "<?php echo U('user/changeUserInfo');?>",
						async: true,
						data: {
							userID: sessionStorage.getItem("userID"),
							nickname: $("#nickname").val(),
							password: $("#password").val(),
							loveWords: $("#loveWords").val(),
							phone: $("#phone").val(),
							weddingDate: $("#weddingDate").val()
						},
						success: function(d) {
							var data = JSON.parse(d);
							/*通过交易码来检查与后端的换流是否正常,0000表示正常*/
							if(data.code == "0000") {
								$.toast("更改用户信息成功");
							} else {
								$.toast("通讯异常");
							}
						}
					});
				}
			})
		</script>
	</body>

</html>