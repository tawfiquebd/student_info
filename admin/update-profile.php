<!-- Data Fetch from database -->
<?php
	$session_user = $_SESSION['user_login'];
	$query = "SELECT * FROM users WHERE username = '$session_user' ";
	$result = mysqli_query($connection,$query);
	if($row = mysqli_fetch_array($result)){
		$id = $row['id'];
		$name = $row['name'];
		$username = $row['username'];
		$email = $row['email'];
		$status = $row['status'];
		$signupdate = $row['datetime'];
	}
	else{
		$error = "No data Found";
	}
?>

<!-- Update procedure starts from here -->
<?php
	if(isset($_POST['update-profile'])){
		$name = $_POST['name'];
		$email = $_POST['email'];

		if(empty($name) || empty($name) || empty($name) ){
			$error = "All fields Required";
		}
		else{
			$query = "UPDATE users SET name = '$name' , email = '$email' WHERE username = '$session_user' ";
			$result = mysqli_query($connection,$query);
			if($result){
				$msg = "User Profile Updated Successfully";
			}
			else{
				$error = "User Profile Update Failed";
			}
		}
	}
?>


<h1 class="text-primary"><i class="fa fa-user"></i> Update Profile <small> Update Profile</small></h1>
<ol class="breadcrumb">
	<li><a href="index.php?page=dashboard"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
	<li><a href="index.php?page=user-profile"><i class="fa fa-user"></i> Profile</a></li>
	<li class="active"><i class="fa fa-edit"></i> Update Profile</li>
</ol>

	<div class="row">
		<div class="col-sm-6">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<span class="msg"><?php if(isset($msg)){echo $msg;}?></span>
					<span class="error"><?php if(isset($error)){echo $error;}?></span>
				
					<label for="name">Name</label>
					<input class="form-control" type="text" name="name" id="name" value="<?php if(isset($name)){echo ucwords($name);}?>">
				</div>
				
				<div class="form-group">
					<label for="roll">Username</label>
					<input disabled="" class="form-control" type="text" name="username" id="roll" value="<?php if(isset($username)){echo strtolower($username);}?>">
				</div>
				
				<div class="form-group">
					<label for="city">Email</label>
					<input class="form-control" type="text" name="email" id="city" value="<?php if(isset($email)){echo strtolower($email);}?>">
				</div>
				
				<div class="form-group">
					<label for="pcontact">Status</label>
					<input disabled="" class="form-control" type="text" name="status" value="<?php if(isset($status)){echo ucwords($status);}?>">
				</div>

				<div class="form-group">
					<label>Signup Date</label>
					<input disabled="" class="form-control" type="text" name="signupdate" value="<?php if(isset($signupdate)){echo $signupdate;}?>">
				</div>
				
				<div class="form-group">
					<input type="submit" value="Update Profile" name="update-profile" class="btn btn-primary pull-right">
				</div>
				

			</form>
		</div>
	</div>