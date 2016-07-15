<section class="main floatleft">
	<!-- post list //-->
<?php
	// user_id, friend_id
	$select_query = sprintf("SELECT * FROM friend WHERE user_id = %d", $user);
	$result = mysqli_query($conn, $select_query);
	
	$select_query = sprintf("SELECT * FROM post WHERE user_id = %d", $user);
	while ($row = mysqli_fetch_assoc($result)) {
		$select_query .= sprintf(" OR user_id = %d", $row['friend_id']);
	}
	$select_query .= sprintf(" ORDER BY date DESC");

	$result = mysqli_query($conn, $select_query);
	while ($row = mysqli_fetch_assoc($result)) {
?>
	<?php include "./post_view.php"; ?>
<?php
	}
?>
</section>