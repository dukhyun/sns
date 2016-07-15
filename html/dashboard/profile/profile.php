<!-- profile //-->
<div class="widget">
	<div class="clearfix">
		<h4 class="floatleft">profile</h4>
	</div>
	
	<ul>
	<?php
		$conn = get_connection();
		$picture = get_user_picture($conn, $user);
		if ($picture !== NULL) {
			printf('<li><img src="/file/%s"></li>', $picture);
		}
		printf('<li class="nick">%s</li>', get_user_nick($conn, $user));
		printf('<li class="email">%s</li>', get_user_email($conn, $user));
	?>
	</ul>
</div>