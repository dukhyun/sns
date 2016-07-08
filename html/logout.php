<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php
$root = '.';
include_once $root.'/../include/header.php';

start_session();
try_to_logout();
destroy_session();

header('Location: /');
?>
</body>
</html>