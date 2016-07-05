<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/main.css">
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'].'/../include/header.php'; ?>

<div class="showlogin">
	<div class="login">
		<h1>싹트네 회원가입</h1>
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
				<li class="floatright">
					<input type="submit" value="register">
				</li>
			</ul>
		</form>		
	</div>
</div>
	
<?php // footer ?>
</body>
</html>