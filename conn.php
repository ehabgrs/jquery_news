<?php  

$dsn  =   '';
$username = '';
$password = '';
$conn = null;

try {
	$conn = new PDO(
		    $dsn, $username, $password, array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
		)
	);
	/*if($conn){
		echo "connected";
	} else {
		echo 'not connected';
	}*/
} catch (\PDOException $e) {
   echo $e;
}
