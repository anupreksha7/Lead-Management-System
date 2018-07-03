<!--viewing all leads in the database-->
<?php
   require 'css/css.html';
require 'db.php';?>
<style type="text/css">
  <?php require 'css/style.css'; ?>
</style>

<!DOCTYPE html>
<title>
	Leads
</title>
<body>
		<h1>Leads Database</h1>
		<div class="content-area">
		<table class="table">
			<thead>
				<tr>
				<th	scope="col">Lid</th>
				<th scope="col">Lead Name</th>
				<th scope="col">Email id</th>
				<th scope="col">Contact No</th>
				<th scope="col">Location</th>
				<th scope="col">Source</th>
				<th scope="col">Cost (Bought)</th>
				<th scope="col">On sale</th>
				<th scope="col">Cost per Lead</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = $mysqli->query("select * from leads");
					while($result = $query->fetch_assoc()){
						$sale = "Yes"; 
						if($result['on_sale'] == 0){
							$sale = "No";
						}
					?>
				<tr>
					<td><?= $result['lid'] ?></td>
					<td><?= $result['name'] ?></td>
					<td><?= $result['email_id'] ?></td>
					<td><?= $result['contact_no'] ?></td>
					<td><?= $result['location'] ?></td>
					<td><?= $result['source'] ?></td>
					<td><?= $result['cost'] ?></td>
					<td><?= $sale ?></td>
					<td><?= $result['cpl'] ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</body>
</html>