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
?>

<section class="showlogin">
	<div class="login">
		<h1>회원가입</h1>
		<form action="register_db.php" method="POST">
			<ul>
				<li>
					<input type="text" name="email" value="E-mail" onfocus="if(this.value == 'E-mail') this.value=''" onblur="if(this.value == '') this.value='E-mail';">
				</li>
				<li>
					<input type="text" name="nick" value="nickname" onfocus="if(this.value == 'nickname') this.value=''" onblur="if(this.value == '') this.value='nickname';">
				</li>
				<li>
					<input type="text" name="password" value="password" onfocus="if(this.value =='password') { this.value=''; this.type='password'; }" onblur="if(this.value =='') { this.value='password'; this.type='text'; }">
				</li>
				<li>
					<input type="submit" value="register">
				</li>
			</ul>
		</form>
	</div>
</section>
	
<?php // footer ?>
</body>
</html>