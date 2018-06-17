<?php
require('css/css.html'); ?>
<style type="text/css">
	<?php require ('css/style.css');	?>
</style>
<?php
	require 'db.php';
	session_start();
	$query = $mysqli->query("Update leads set on_sale = '0' where user_id = '0'");
	session_unset();
	session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Thanks!</title>
</head>
<body>
	<div>
		Thanks a lot for your active participation.
	</div>
	<div>
		The leads who brought will be send to you via email.<br>
		<a href="index.php"><button class="button button-block"/>Home</button></a>
	</div>

</body>
</html>