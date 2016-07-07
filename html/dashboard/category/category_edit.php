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
?>

<div class="form_style category_edit center">
	<h1>카테고리</h1>
	<?php // 카테고리 리스트 보여주기
		$result = get_category_list($conn);
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<ul class="clearboth">';
			printf('<li class="category_name floatleft">%s</li>', $row['name']);
			$category_id = $row['id'];
	?>
		<li class="floatleft">
			<form action="update_category.php" method="post">
				<input type="hidden" name="id" value="<?php echo $category_id; ?>" readonly>
				<input type="submit" value="수정">
			</form>
		</li>
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
	<ul class="clearboth">
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

<?php // footer ?>

</body>
</html>