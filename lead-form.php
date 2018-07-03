<!--lead addition to database-->
<?php 

    require 'css/css.html';
    require 'db.php';?>
    <style type="text/css">
  <?php require 'css/style.css'; ?>
</style>

<?php
    /*lead addition through form*/
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        if (isset($_POST['submit'])) { 
        //lead details
        $name = $mysqli->escape_string($_POST['name']);
        $email_id = $mysqli->escape_string($_POST['email_id']);
        $contact_no = $mysqli->escape_string($_POST['contact_no']);
        $location = $mysqli->escape_string($_POST['location']);
        $source = $mysqli->escape_string($_POST['source']);
        $cost = $mysqli->escape_string($_POST['cost']);

        $inst = $mysqli->query("insert into leads (name, email_id, contact_no, location, source, cost) 
                values('$name','$email_id','$contact_no','$location','$source','$cost')");

        //calculate cpl of the recently added lead
        require 'cplcalculation.php';
        header("location: successful.php"); 
        
    }
}
?>

<?php
    /*inserting data from csv file */
    if (isset($_POST["import"])) {
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($fileName, "r");
        while (($column = fgetcsv($file)) !== FALSE) {
            $inst = $mysqli->query("insert into leads (name, email_id, contact_no, location, source, cost)
                   values ('".$column[0]."','".$column[1]."','".$column[2]."','".$column[3]."','".$column[4]."','".$column[5]."')");
            
            if ($inst) {
                require 'cplcalculation.php';
                header("location: successful.php");           
            } 
            else {
                $_SESSION['message'] = "Problem in Importing CSV Data";
                header("location: error.php");
            }
        }
    }
}
?>

<!DOCTYPE html>
<title>
	Lead-Form
</title>
<body>
<h1>Add leads to CRM</h1>
        <div id="submit"> 
        <div class="form1">
            <h2>Fill in the details<h2>
          <form action="lead-form.php" method="post">
            <div class="form-group">
            <label>
                Name<span class="req" style="color:red">*</span>
            </label>
            <input type="text" class="form-control" name="name"/>
            </div>
          
            <div class="form-group">
            <label>
                Email id<span class="req"></span>
            </label>
            <input type="email" class="form-control" name="email_id"/>
            </div>

            <div class="form-group">
            <label>
                Contact Number<span class="req"></span>
            </label>
            <input type="text" class="form-control" name="contact_no"/>
            </div>

            <div class="form-group">
            <label>
                Location<span class="req" style="color:red">*</span>
            </label>
            <input type="text" class="form-control" name="location"/>
            </div>

            <div class="form-group">
            <label>
                Source  <span class="req" style="color:red">*</span>
            </label>
            <select name = "source">
      			<option value = "Newsletter" >Newsletter</option>
      			<option value = "Mail">Mail</option>
      			<option value = "Call">Call</option>
    			</select>
            </div>

            <div class="form-group">
            <label>
                Cost<span class="req"></span>
            </label>
            <input type="text" class="form-control" name="cost"/>
            </div>

          <div class="form-group">
          <button class="btn btn-block btn btn-primary form-control" name="submit" />Submit</button>
          </div>
        </form>
    </div>
</div>
 <h1 class="or">OR</h1>
<div class = "form2">
        <form class="form-horizontal" action="lead-form.php" method="post" name="uploadCSV"
    enctype="multipart/form-data">
        <h2>Import csv file</h2>
        <div class="form-group">
        <label class="col-md-4 control-label"></label> <input
            type="file" name="file" id="file" accept=".csv">
        </div>
        <button type="submit" id="submit" name="import" class="btn btn-block btn btn-primary form-control">Import</button>
        <br />

    </div>
    <div id="labelError"></div>
</form>
</div>
<script type="text/javascript" src="js/csv.js"></script>>
</body>
</html>
          
          
      
