<?php   
  if (!isset($_SESSION['user'])) {
    session_start(); 
  } 
?>

<?php 

include "dbconnect.php";

// get params from the passed in serialized url
$email = $_GET['email'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$password = $_GET['password'];

try {
	$res = $db->prepare("SELECT * FROM user WHERE email='$email'");
	$res->execute();

	if ($res->rowCount() != 0) {
		// email is taken
		unset($_SESSION['user']); // failure, unset the session
		echo "failure";

	} else {
		$statement = $db->prepare("INSERT INTO user(email) VALUES (?)");
		$statement->execute(array($email));

		$query = $db->prepare("UPDATE user SET firstname='$fname', lastname='$lname', password='$password' WHERE email='$email'");
		$query->execute();

		$_SESSION['user'] = $fname." ".$lname; // start session

		echo "success"; 
	}
}
catch(PDOException $e) {
	echo $e->getMessage();
}
?>