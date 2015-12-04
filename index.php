<?php
    include ('db_conn.php');

$sql = "SELECT * FROM user ORDER BY id ASC";
$result = $conn->query($sql);
$row = array();


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $rows_returned = $result->num_rows;
        echo " Question " . $row["id"] . " email: " . $row["email"] . " Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    }
} else {
    // CHANGE THIS TO LINK TO WHEREVER
    echo "0 results";
}
//close connection
$conn->close();


/*
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

*/

?>