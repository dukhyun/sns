<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/dash.css">
</head>
<body>
<?php
$root = '/../..';
include_once $root.'/../include/header.php';
?>

<?php
$conn = get_connection();
$row = get_category_list($conn);

?>

<?php // footer ?>

</body>
</html>