<?php
	include ('db_conn.php');

$firstname=$_POST['first_name'];
$lastname=$_POST['last_name'];
$email=$_POST['email'];

mysqli_query($conn, "INSERT INTO user (first_name, last_name, email)
	VALUES ('$firstname', '$lastname', '$email')");

/* mysqli_query($conn, "INSERT INTO user (first_name, last_name, email)
	VALUES ('$firstname', '$lastname', '$email')");
*/

if(mysqli_affected_rows($conn)>0){
	echo "<p> Record Added</p>";
}	else {
	echo "Go fuck yourself <br/>";
	echo mysqli_error ($conn);
}


//close connection 
mysqli_close($conn);
?>
