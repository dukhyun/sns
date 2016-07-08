<!-- category //-->
<div class="widget">
	<div class="header">
		<h4 class="floatleft">category</h4>
	<?php
		$conn = get_connection();
		if (check_login()) {
			if ($_SESSION['id'] == get_user_email($conn, $user)) {
	?>
		<form class="floatright" action="category/category_edit.php" method="post">
			<input type="submit" value="수정">
		</form>
	<?php
			}
		}
	?>
	</div>
	
<?php
	$result = get_category_list($conn, $user);
?>
	<ul>
		<li>
			<a href="/dashboard/?user=<?php echo $user; ?>"><b>전체보기</b></a>
		</li>
<?php
	while ($row = mysqli_fetch_assoc($result)) {
		printf('<li><a href="/dashboard/?user=%d&category_id=%d">%s</a></li>', 
			$user, $row['id'], $row['name']);
	}
?>
	</ul>

</div>