<!-- category //-->
<div class="widget">
	<h4>category</h4>
	
<?php
	$conn = get_connection();
	//$row = get_category_list($conn);
	//echo $row['name'];
?>
	
	<form action="category/update_post.php" method="post">
		<input type="submit" value="수정">
	</form>
</div>