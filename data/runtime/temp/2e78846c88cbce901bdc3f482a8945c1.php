<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"D:\phpStudy\PHPTutorial\WWW\imf\public/../app/install\view\\index.html";i:1516389212;s:75:"D:\phpStudy\PHPTutorial\WWW\imf\public/../app/install\view\public\head.html";i:1516388804;s:77:"D:\phpStudy\PHPTutorial\WWW\imf\public/../app/install\view\public\header.html";i:1516388892;s:77:"D:\phpStudy\PHPTutorial\WWW\imf\public/../app/install\view\public\footer.html";i:1516388784;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>PHP ThinkIMF安装</title>
<link rel="stylesheet" href="__STATIC__/install/simpleboot/themes/flat/theme.min.css" />
<link rel="stylesheet" href="__STATIC__/install/css/install.css" />
<link rel="stylesheet" href="__STATIC__/font-awesome/css/font-awesome.min.css" type="text/css">


</head>
<body>
	<div class="wrap">
		<div class="header">
	<h1 class="logo">PHP ThinkIMF 安装向导</h1>
	<div class="version"><?php echo THINKCMF_VERSION; ?></div>
</div>
		<div class="section">
			<div class="main">
				<pre class="agreement">PHP ThinkIMF软件使用协议

版权所有 ©2013-<?php echo date("Y"); ?>,ThinkIMF开源社区

感谢您选择ThinkIMF内容管理框架,您可以在授权协议的允许下，最大程度的使用。
包括不限于商城开发，微信开发，智慧城市开发等。

</pre>
			</div>
			<div class="bottom text-center">
				<a href="<?php echo url('index/step2'); ?>" class="btn btn-primary"><?php echo lang('ACCEPT'); ?></a>
			</div>
		</div>
	</div>
	<div class="footer">
	&copy; 2014-<?php echo date('Y'); ?> <a href="https://www.thinkimf.com" target="_blank">Thinkimf Team</a>
</div>
</body>
</html>