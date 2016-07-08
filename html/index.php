<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
<?php
$root = '.';
include_once $root.'/../include/header.php';

if (check_login()) {
	header('Location: /dashboard/');
}
?>

<section class="showlogin">
	<div class="login">
		<h1>싹트네</h1>
		<form action="login_db.php" method="POST">
			<ul>
				<li>
					<input type="text" name="email" value="E-mail" onfocus="if(this.value =='E-mail') this.value=''" onblur="if(this.value =='') this.value='E-mail';">
				</li>
				<li>
					<input type="text" name="password" value="password" onfocus="if(this.value =='password') { this.value=''; this.type='password'; }" onblur="if(this.value =='') { this.value='password'; this.type='text'; }">
				</li>
			</ul>
			<ul>
				<li>
					<input type="submit" value="login">
				</li>
			</ul>
		</form>
		<!--
		<form action="register_form.php">
			<ul>
				<li class="floatright">
					<input type="submit" value="register">
				</li>
			</ul>
		</form>
		//-->
	</div>
</section>

<?php // footer ?>

</body>
</html>