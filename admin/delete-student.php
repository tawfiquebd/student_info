<?php
	session_start();
	include_once '../config/dbconnect.php';

	//echo base64_decode($_GET['id']);	// id decode
	// Delete query
	if(isset($_GET['id'])){
		$id = base64_decode($_GET['id']);
		$query = "DELETE FROM student_info WHERE id = '$id' ";
		$result = mysqli_query($connection,$query);
		if($result){
			$_SESSION['delete_msg'] = "Student Deleted Sucessfully";
			header('Location: index.php?page=all-student');
		}
		else{
			$_SESSION['delete_msg'] = "Student Deleted Failed";
		}
	}
	
		

?>
