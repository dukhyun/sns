<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php
	$root = '..';
	include_once $root.'/../include/header.php';
	$conn = get_connection();
	$select_query = "SELECT * FROM user";
	$result = mysqli_query($conn, $select_query);
	while ($row = mysqli_fetch_assoc($result)) {
		printf('<a href="/dashboard/?user=%d">%s</a><br>', $row['id'], $row['nick']);
	}
?>

<?php // footer ?>

</body>
</html>