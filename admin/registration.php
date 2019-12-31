<?php

	include_once '../config/dbconnect.php';

	if(isset($_POST['registration'])){
		$name = mysqli_real_escape_string($connection,$_POST['name']);
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$username = mysqli_real_escape_string($connection,$_POST['username']);
		$password = mysqli_real_escape_string($connection,$_POST['password']);
		$cpassword = mysqli_real_escape_string($connection,$_POST['cpassword']);
		$photo = 'image';

		$input_error = array();

		if(empty($name)){
			$input_error['name'] = "Name field is Required";
		}
		if(empty($email)){
			$input_error['email'] = "Email field is Required";
		}
		if(empty($username)){
			$input_error['username'] = "Username field is Required";
		}
		if(empty($password)){
			$input_error['password'] = "Password field is Required";
		}
		if(empty($cpassword)){
			$input_error['cpassword'] = "Confirm Password field is Required";
		}


			$query = "SELECT * FROM users WHERE email = '$email' AND username = '$username' ";
			$exist_check = mysqli_query($connection,$query);
			if(mysqli_num_rows($exist_check) > 0){
				$error = "Email or Username already exist";
			}
			else{
				if(strlen($username) > 4){
					if(strlen($password) > 6){
						if($password == $cpassword){
							$password = password_hash($password,PASSWORD_BCRYPT);
							$query = "INSERT INTO users VALUES(NULL,'$name','$email','$username','$password','$photo','inactive')";
							$result = mysqli_query($connection,$query);

							$lastId = mysqli_insert_id($connection);

							$fileName = "images/".$lastId.$_FILES['photo']['name'];
							$fileTemp = $_FILES['photo']['tmp_name'];
							move_uploaded_file($fileTemp, $fileName);
							$query = "UPDATE users SET photo = '$fileName' WHERE id = '$lastId'";
							$result = mysqli_query($connection,$query);

							if($result){
								$msg = "Registration successfull";
								$name = $email = $username = $password = $cpassword = "";
							}
							else{
								$error = "Registration failed";
							}
						}
						else{
							$error = "Password & Confirm Password Mismatch";
						}
					}
					else{
						$error = "Password must be minimum 7 characters long";
					}
				}
				else{
					$error = "Username must be minimum 5 characters long";
				}
			}

	}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Managment System</title>

    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
	<div class="container">
		<h1>User Registration Form</h1>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

					<span class="error"><?php if(isset($error)){echo $error;}?></span>
					<span class="msg"><?php if(isset($msg)){echo $msg;}?></span>
					
					<div class="form-group">
						<label for="name" class="control-label col-sm-1">Name</label>
						<div class="col-sm-4">
							<input class="form-control" id="name" type="text" name="name" placeholder="Enter Your Name" value="<?php if(isset($name)){echo $name;}?>">
						</div>
						<label class="error"><?php if(isset($input_error['name'])){echo $input_error['name'];}?></label>
					</div>
					<div class="form-group">
						<label for="email" class="control-label col-sm-1">Email</label>
						<div class="col-sm-4">
							<input class="form-control" id="email" type="email" name="email" placeholder="Enter Your Email" value="<?php if(isset($email)){echo $email;}?>">
						</div>
						<label class="error"><?php if(isset($input_error['email'])){echo $input_error['email'];}?></label>
					</div>
					<div class="form-group">
						<label for="username" class="control-label col-sm-1">Username</label>
						<div class="col-sm-4">
							<input class="form-control" id="username" type="text" name="username" placeholder="Enter Your Username" value="<?php if(isset($username)){echo $username;}?>">
						</div>
						<label class="error"><?php if(isset($input_error['username'])){echo $input_error['username'];}?></label>
					</div>
					<div class="form-group">
						<label for="password" class="control-label col-sm-1">Password</label>
						<div class="col-sm-4">
							<input class="form-control" id="password" type="password" name="password" placeholder="Enter Your Password" value="<?php if(isset($password)){echo $password;}?>">
						</div>
						<label class="error"><?php if(isset($input_error['password'])){echo $input_error['password'];}?></label>
					</div>
					<div class="form-group">
						<label for="cpassword" class="control-label col-sm-1">Confirm Password</label>
						<div class="col-sm-4">
							<input class="form-control" id="cpassword" type="password" name="cpassword" placeholder="Enter Your Confirm Password" value="<?php if(isset($cpassword)){echo $cpassword;}?>">
						</div>
						<label class="error"><?php if(isset($input_error['cpassword'])){echo $input_error['cpassword'];}?></label>
					</div>
					<div class="form-group">
						<label for="photo" class="control-label col-sm-1">Photo</label>
						<div class="col-sm-4">
							<input id="photo" type="file" name="photo">
						</div>
					</div>
					<div class="col-sm-4">
						<input type="submit" value="Registration" name="registration" class="btn btn-primary">
					</div>
				</form>

			</div>
		</div>
		<br>
		<br>
		<p>If you have an account then please <a href="login.php">Login</a></p>
		<hr>
		<footer>
			<p>Copyright &copy; 2018 - <?php echo date('Y')?> All Rights Reserved.</p>
		</footer>
	</div>

    <!-- Js files -->
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  </body>
</html>