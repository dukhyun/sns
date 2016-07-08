<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/dash.css">
</head>
<body>
<?php
$root = '../..';
include_once $root.'/../include/header.php';
?>

<?php // db 불러오기
$conn = get_connection();
if (check_login()) {
	$user_id = get_user_id($conn, $_SESSION['id']);
?>

<div class="form_style category_edit center">
	<h1>카테고리</h1>
	<?php // 카테고리 리스트 보여주기
		$result = get_category_list($conn, $user_id);
		while ($row = mysqli_fetch_assoc($result)) {
			$category_id = $row['id'];
	?>
	<ul class="category_name clearboth">
		<form action="update_category.php" method="post">
			<li class="floatleft">
	<?php
		printf('<input type="text" name="name" value="%s">', $row['name']);
	?>
			</li>
			<li class="floatleft">
				<input type="hidden" name="id" value="<?php echo $category_id; ?>" readonly>
				<input type="submit" value="수정">
			</li>
		</form>
		<li class="floatleft">
			<form action="delete_category.php" method="post">
				<input type="hidden" name="id" value="<?php echo $category_id; ?>" readonly>
				<input type="submit" value="삭제">
			</form>
		</li>
	</ul>
	<?php
		}
	?>
	<ul class="category_name clearboth">
		<form action="insert_category.php" method="post">
			<li class="floatleft">
				<input type="text" name="name">
			</li>
			<li class="floatleft">
				<input type="submit" value="추가">
			</li>
		</form>
	</ul>
	<ul class="clearboth">
		<li>
			<form action="/dashboard/" method="post">
				<input type="submit" value="확인">
			</form>
		</li>
	</ul>
</div>
<script>
function goBack() {
    history.back();
}
</script>
<?php
} else {
?>
<script>goBack();</script>
<?php
}
?>

<?php // footer ?>

</body>
</html>