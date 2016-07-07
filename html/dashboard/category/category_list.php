<!-- category //-->
<div class="widget">
	<div class="header">
		<h4 class="floatleft">category</h4>
		
		<form class="floatright" action="category/category_edit.php" method="post">
			<input type="submit" value="수정">
		</form>
	</div>
	
<?php
	$conn = get_connection();
	$result = get_category_list($conn);
?>
	<ul>
<?php
	while ($row = mysqli_fetch_assoc($result)) {
		printf('<li><a href="/dashboard/index.php?category_id=%d">%s</a></li>', 
			$row['id'], $row['name']);
	}
?>
	</ul>

</div>