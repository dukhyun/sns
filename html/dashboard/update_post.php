<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/dash.css">
</head>
<body>
<?php
	$root = '..';
	include_once $root.'/../include/header.php';
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$post_id = $_GET['post_id'];
	}
	$conn = get_connection();
	$select_query = sprintf("SELECT * FROM post WHERE id=%d", $post_id);
	$result = mysqli_query($conn, $select_query);
	$row = mysqli_fetch_assoc($result);
	$last_content = $row['content'];
	$category_id = $row['category_id'];
?>

<div class="form_style center">
	<h1>글 수정</h1><br>
	<form action="update_db.php" method="get">
		<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
		<ul>
			<li>
				<label for="category">카테고리:</label>
				<select id="category" name="category">
					<option value="0">전체보기</option>
					<?php 
						$result = get_category_list($conn, get_user_id($conn, $_SESSION['id']));
							while($row = mysqli_fetch_assoc($result)) {
								if ($category_id == $row['id']) {
									printf("<option vlaue=%s selected=selected>%s</option>", $row['id'], $row['name']);
								} else {
									printf("<option value=%d>%s</option>", $row['id'], $row['name']);
								}
							}
					?>
				</select>
			</li>
			<li>
				내용: <br>
				<textarea type="text" name="content"><?php echo $last_content ?></textarea>
			</li>
			<li>
				<input type="submit" value="제출">
			</li>
		</ul>
	</form>
</div>

<?php // footer ?>

</body>
</html>