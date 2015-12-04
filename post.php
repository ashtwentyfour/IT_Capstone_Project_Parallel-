<?php
	include ('db_conn.php');


$answer = $_POST['score'];
$comments = $_POST['comments'];
$id = $_GET['id'];
$dom_id = $_GET['dom_id'];
$c_id = $_GET['c_id'];
mysqli_query($conn, "INSERT INTO responses (question_id, assess_id, answer_numeric, comments)
	VALUES ('$id', '1', '$answer', '$comments')");

// INSERT INTO `parallel`.`responses` (`response_id`, `question_id`, `answer_numeric`, `comments`) VALUES (NULL, '4', '3', 'hi bob')

/* mysqli_query($conn, "INSERT INTO user (first_name, last_name, email)
	VALUES ('$firstname', '$lastname', '$email')");
*/

mysqli_close($conn);

$id++;
header("location:assessment.php?id=" . $id . "&dom_id=" . $dom_id . "&c_id=" . $c_id . "");

/*
if(mysqli_affected_rows($conn)>0){
	echo "<p> Your data was inserted</p>";
	echo $id;
}	else {
	echo "Go fuck yourself <br/>";
	echo mysqli_error ($conn);
}*/


//close connection 

?>
