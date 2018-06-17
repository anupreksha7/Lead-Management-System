<?php 
	require 'includes/dbconnect.php';
	require('css/css.html'); ?>
	<style type="text/css">
	<?php require ('css/style.css');	?>
	</style><?php
	session_start();
	session_unset();
	session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    <div class="form" style="text-align: center">
          <h1>Thanks for stopping by</h1>
              
          <p><?= 'You have been logged out!'; ?></p>
          
          <a href="index.php"><button class="button button-block"/>Home</button></a>

    </div>
</body>
</html>
