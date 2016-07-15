<!-- 사이드바 //-->
<section class="side floatleft">
	<!-- <h3>sidebar test</h3> //-->
	
	<!-- action //-->
<?php
	if (check_login()) {
		if ($_SESSION['id'] == get_user_email($conn, $user)) {
?>
	<ul class="action clearfix">
		<li class="floatleft">
			<a href="/dashboard/write_post.php">글작성</a>
		</li>
		<li class="floatleft">
			<a href="/dashboard/friend/friend_list.php">친구관리</a>
		</li>
	</ul>
<?php
		}
	}
?>
	
	<?php include_once './profile/profile.php' ?>
	<?php include_once './category/category_list.php' ?>
</section>