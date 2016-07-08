<!-- profile //-->
<div class="widget">
	<div class="header">
		<h4 class="floatleft">profile</h4>
	</div>
	
	<ul>
		<li>
	<?php
		$conn = get_connection();
		echo get_user_nick($conn, $user);
	?>
		</li>
	</ul>
</div>