<?php
	define('host', 'localhost');
	define('user', 'root');
	define('password', '');
	define('db', 'student_info');

	$connection = mysqli_connect(host,user,password);
	$db = mysqli_select_db($connection,db);

	if($connection && $db){
		//echo "Database connected";
	}
	else{
		echo "<h1 align='center' style='color:red;' >No Database Found</h1>";
	}

?>