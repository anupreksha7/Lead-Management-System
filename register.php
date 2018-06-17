<?php 

$_SESSION['name'] = $_POST['full'];
$_SESSION['email'] = $_POST['email'];


$full = $mysqli->escape_string($_POST['full']);
$email = $mysqli->escape_string($_POST['email']);
$pass = $mysqli->escape_string($_POST['pass']);


$result = $mysqli -> query("Select * from users where email='$email'") or die($mysqli -> error);

if( $result -> num_rows > 0)
{
	$_SESSION['message'] = 'User with this username already exists!';
	header("location: error.php");
} else {
	$sql = "insert into users (name,email,password)values('$full','$email','$pass')";
}

if($mysqli->query($sql)){
	$_SESSION['id'] = mysqli_insert_id($mysqli);
	$_SESSION['active'] = 1; 
	$_SESSION['logged_in'] =  true; //So we know the user has logged in
        header("location: profile.php"); 
}

else{
	$_SESSION['message'] = 'Registration failed badly!';
	header("location: error.php");
}