<section class="main floatleft">
	<!-- action //-->
	<div class="action">
		<a class="floatleft" href="/dashboard/write_post.php">글작성</a>
	</div>
	
	<!-- post list //-->
<?php
	$conn = get_connection();

	$select_query = 'SELECT id FROM post';
	$result_set = mysqli_query($conn, $select_query);
	while ($row=mysqli_fetch_assoc($result_set)) {
?>
	<?php include "post_view.php"; ?>
<?php
	}
?>
</section>