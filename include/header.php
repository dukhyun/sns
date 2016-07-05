<link rel="stylesheet" type="text/css" href="/css/head.css">

<header>
	<div class="title floatleft">
		<a href="/">싹트네</a>
	</div>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/session.php';
start_session();
if (check_login()) { // 비로그인
?>
	<div class="floatright">
		<a href="#">logout</a>
	</div>
	<div class="floatright">
		<a href="#">profile</a>
	</div>
	<div class="floatright">
		<a href="#">dashboard</a>
	</div>
<?php
} else { // 로그인
	// 세션 : get_nick();
?>
	<div class="floatright">
		<a href="/register_form.php">register</a>
	</div>
	<div class="floatright">
		<a href="/">login</a>
	</div>
<?php
}
?>
</header>