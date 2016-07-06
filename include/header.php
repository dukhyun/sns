<link rel="stylesheet" type="text/css" href="/css/head.css">

<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/../include/host.php';
start_session();
?>

<header>
	<div class="title floatleft">
		<a href="/">싹트네</a>
	</div>
<?php
if (check_login()) {  // 로그인
	// 세션 : get_nick();
?>
	<div class="floatright">
		<a href="#">logout</a>
	</div>
	<div class="floatright">
		<a href="#">profile</a>
	</div>
	<div class="floatright">
		<a href="/dashboard/">dashboard</a>
	</div>
<?php
} else { // 비로그인
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