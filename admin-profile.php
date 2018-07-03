<!---admin homepage-->
<?php 
require 'css/css.html';
require 'db.php';?>
<style type="text/css">
  <?php require 'css/style.css'; ?>
</style>

<!DOCTYPE html>
<title>
	Admin here!
</title>
<body>
	<!---various function only admin can access--->
	<a href = "lead-form.php" >Add new leads </a><br>
	<a href = "lead-auction.php">Select leads to put in auction </a><br>
	<a href = "view-leads.php">View leads</a><br>
	<a href = "set-rates.php">Set Handling Rates</a><br>
	<a href = "admin-logout.php">Logout</a>

	<div class="form2">
			<!--information of current rates of calling and mailing--->
            <h1>Current Rates for procuring leads</h1>
            <div class="content-area">
			<table class="table">
			<thead>
				<tr>
				<th scope="col">Mail</th>
				<th scope="col">Call</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$rates = $mysqli->query("Select * from rates where id =1");
					$result = $rates->fetch_assoc();
				?>
				<tr>
					<td><?= $result['mailing'] ?></td>
					<td><?= $result['calling'] ?></td>
				</tr>
			</tbody>
		</table>
	</div>
   </div>
</body>
</html>
	