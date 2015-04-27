<?php   
  if (!isset($_SESSION['user'])) {
    session_start(); 
  } 
?>

<?php 

include "dbconnect.php";

$email = $_GET['email'];
$password = $_GET['password'];

try {
	$res = $db->prepare("SELECT * FROM user WHERE email='$email'");
	$res->execute();

	if ($res->rowCount() == 0) {
		unset($_SESSION['user']);
		echo "failure";

	} else {
		$statement = $db->prepare("SELECT firstname, lastname, password FROM user WHERE email='$email'");
		$statement->execute();
		$record = $statement->fetch();

		$fname = $record['firstname'];
		$lname = $record['lastname'];
		$pw = $record['password'];

		if ($password == $pw) { // password is correct
			$_SESSION['user'] = $fname." ".$lname;
			echo $_SESSION['user']; 
		} else {
			echo "failure";
		}
	}
}
catch(PDOException $e) {
	echo $e->getMessage();
}

?>