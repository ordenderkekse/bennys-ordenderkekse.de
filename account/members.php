<?php

session_start();
include '../includes/config.php';
include '../includes/hasPerms.php';

include '../includes/header.authed.php';
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<iframe width="100%" height="90%" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vRUaLEcg58hjDPKswaBSwreHaMx7vlVSpx9d0owGs8LSXNSHkGt30ey-Jnwputg5CwdZ0KzuxAkuoGj/pubhtml?gid=653875836&amp;single=true&amp;widget=true&amp;headers=false"></iframe>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>
<?php
include '../includes/footer.php';
?>