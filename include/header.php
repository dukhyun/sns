<link rel="stylesheet" type="text/css" href="/css/head.css">

<?php
require_once $root.'/../include/host.php';
start_session();
?>

<header>
<?php
if (check_login()) {  // 로그인
	// 세션 : get_nick();
	$conn = get_connection();
?>
	<div class="title floatleft">
		<a href="/dashboard/">싹트네</a>
	</div>
	<div class="floatright">
		<a href="/logout.php">logout</a>
	</div>
	<div class="floatright">
		<a href="/admin/">profile</a>
	</div>
	<div class="floatright">
		<?php
		printf('<a href="/dashboard/?user=%d">%s</a>',
			get_user_id($conn, $_SESSION['id']), $_SESSION['id']);
		?>
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