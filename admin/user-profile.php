<h1 class="text-primary"><i class="fa fa-user"></i> User Profile <small> My Profile</small></h1>
<ol class="breadcrumb">
	<li><a href="index.php?page=dashboard"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
	<li class="active"><i class="fa fa-user"></i> Profile</li>
</ol>
<?php
	$session_user = $_SESSION['user_login'];
	$query = "SELECT * FROM users WHERE username = '$session_user' ";
	$result = mysqli_query($connection, $query);
	if($row = mysqli_fetch_array($result)){
		$id = $row['id'];
		$name = $row['name'];
		$email = $row['email'];
		$username = $row['username'];
		$password = $row['password'];
		$photo = $row['photo'];
		$status = $row['status'];
		$datetime = $row['datetime'];
	}
	else{
		$error = "No data found";
	}
?>
<div class="row">
	<div class="col-sm-6">
		<table class="table table-bordered table-striped table-hover">
			<tr>
				<td>User Id</td>
				<td><?php echo $id?></td>
			</tr>
			<tr>
				<td>Name</td>
				<td><?php echo ucwords($name);?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><?php echo $username;?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $email;?></td>
			</tr>
			<tr>
				<td>Status</td>
				<td><?php echo ucwords($status);?></td>
			</tr>
			<tr>
				<td>Signup Date</td>
				<td><?php echo $datetime;?></td>
			</tr>
		</table>
		<a href="index.php?page=update-profile" class="btn btn-sm btn-info pull-right">Edit Profile</a>
	</div>
	<div class="col-sm-6">
		<a href="<?php echo $photo?>">
			<img src="<?php echo $photo?>" alt="image" class="img-thumbnail" width="150px">
		</a>
		<br>
		<br>
	
		<?php
			if(isset($_POST['upload'])){
				
				$fileName = "images/".$id.$_FILES['photo']['name'];
				$fileTemp = $_FILES['photo']['tmp_name'];
				move_uploaded_file($fileTemp, $fileName);
				$query = "UPDATE users SET photo = '$fileName' WHERE id = '$id' ";
				$result = mysqli_query($connection,$query);
				if($result){
					$msg = "Image uploaded Successfully";
					header('refresh:1; url=index.php?page=user-profile');

				}
				else{
					$error = "Image upload Failed";
				}
			}
		?>

		<form action="" method="post" enctype="multipart/form-data">
			<span class="msg"><?php if(isset($msg)){echo $msg;}?></span>
			<span class="error"><?php if(isset($error)){echo $error;}?></span>
			<label for="photo">Profile Picture</label>
			<input type="file" name="photo" id="photo" required="">
			<br>
			<input type="submit" name="upload" class="btn btn-sm btn-info" value="Upload">
		</form>
	</div>
</div>
