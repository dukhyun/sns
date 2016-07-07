<link rel="stylesheet" type="text/css" href="/css/head.css">

<?php
require_once $root.'/../include/host.php';
start_session();
?>

<header>
<?php
if (check_login()) {  // 로그인
	// 세션 : get_nick();
?>
	<div class="title floatleft">
		<a href="/dashboard/"><?php echo $_SESSION['id']; ?></a>
	</div>
	<div class="floatright">
		<a href="/logout.php">logout</a>
	</div>
	<div class="floatright">
		<a href="#">profile</a>
	</div>
<?php
} else { // 비로그인
?>
	<div class="title floatleft">
		<a href="/">싹트네</a>
	</div>
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