<?php if (!defined('THINK_PATH')) exit();?><html>

	

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>婚纱影楼客户端</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
		<link rel="shortcut icon" href="/hsylglxt/View/Index/Public/img/icon.jpg">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta content="yes" name="apple-touch-fullscreen">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" href="/hsylglxt/View/Index/Public/css/light7.css">
		<link rel="stylesheet" href="/hsylglxt/View/Index/Public/css/light7-swiper.css">
		<link rel="stylesheet" href="/hsylglxt/View/Index/Public/css/light7-swipeout.css">
		<link rel="apple-touch-icon" href="../../../assets/img/apple-touch-icon-114x114.png">
		<link rel="stylesheet" href="/hsylglxt/View/Index/Public/css/font_1433748561_0232708.css">
		<link rel="stylesheet" href="/hsylglxt/View/Index/Public/css/app.css">
		<style>
			/*header背景色调*/
			
			.bar {
				background-color: rgba(255, 105, 180, 0.8);
			}
			/*去除婚纱服务列表tab左右padding 顶部的margin*/
			
			.tab-link.button.active {
				color: #8B008B;
				border-color: #8B008B;
			}
			
			.bar-tab .tab-item.active,
			a {
				color: #8B008B;
			}
			
			.card {
				margin: 0px;
			}
			/*推荐页面的价格颜色*/
			
			.page-main .price {
				color: orange;
			}
			
			.card-header p {
				margin: 0;
				text-align: left;
			}
			
			.activity {
				color: red;
				font-size: 0.8rem;
			}
			/*轮播图样式调整*/
			
			.page-main .swiper-container {
				height: 10.0rem;
				padding-bottom: 0;
				margin-bottom: 0.5rem;
			}
			
			.swiper-slide img {
				height: 100%;
				width: 100%;
				display: inline;
			}
			
			.swiper-pagination.swiper-pagination-bullets {
				position: relative;
				bottom: 1.0rem;
			}

		</style>
	</head>

	<body>
		<div id="page-main" class="page page-main  page-current">
			<header class="bar bar-nav">
                <a class="icon icon-left pull-left back"></a>
				<h1 class="title">摄影师介绍</h1>
				<a class="icon icon-search pull-right open-popup" data-popup=".popup-search"></a>
			</header>
			<div class="content">
				<img id="detailImg"  width="100%" />

			</div>
		</div>
		
		
		
		<script type='text/javascript' src='/hsylglxt/View/Index/Public/js/zepto.js' charset='utf-8'></script>
		<script type='text/javascript' src='/hsylglxt/View/Index/Public/js/light7.js' charset='utf-8'></script>
		<script type='text/javascript' src='/hsylglxt/View/Index/Public/js/light7-swiper.js' charset='utf-8'></script>
		<script type='text/javascript' src='/hsylglxt/View/Index/Public/js/light7-swipeout.js' charset='utf-8'></script>

		<script src="/hsylglxt/View/Index/Public/js/app.js"></script>
		<script src="/hsylglxt/View/Index/Public/js/homepage.js"></script>
		<script>
			/*截取URL中的参数值,为公共函数*/
			$.getQueryString = function(name) {
				var reg = new RegExp("(^|&|\|)" + name + "=([^&]*)(&|$)");
				var r = window.location.search.substr(1).match(reg);
				if(r != null) {
					return decodeURIComponent(r[2]);
				} else {
					return "";
				}
			};
			
			$.loadVeil = function(photographerID) {
					$.ajax({
						type: "post",
						url: "<?php echo U('set/loadPhotographer');?>",
						async: true,
						data: {
							photographerID:photographerID
						},
						success: function(d) {
							var data = JSON.parse(d);
							/*通过交易码来检查与后端的换流是否正常,0000表示正常*/
							if(data.code == "0000") {
								$("#detailImg")[0].src = data.data[0]['detailimg'];
							} else {
								$.toast("通讯异常");
							}
						}
					});
				}
			$.loadVeil($.getQueryString('photographerID'));
		</script>
	</body>
	
</html>