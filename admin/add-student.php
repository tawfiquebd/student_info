<?php
	//include_once '../config/dbconnect.php';
	$errname = $errroll = $errcity = $errcontact = $errclass = "";

	if(isset($_POST['add-student'])){
		$name = mysqli_real_escape_string($connection,$_POST['name']);
		$roll = mysqli_real_escape_string($connection,$_POST['roll']);
		$city = mysqli_real_escape_string($connection,$_POST['city']);
		$contact = mysqli_real_escape_string($connection,$_POST['pcontact']);
		$class = mysqli_real_escape_string($connection,$_POST['class']);
		$photo = 'pic';
		$date = date("Y-m-d H:i:s");

		if(empty($name)){
			$errname = "Name field is Required";
		}
		if(empty($roll)){
			$errroll = "Roll field is Required";
		}
		if(empty($city)){
			$errcity = "City field is Required";
		}
		if(empty($contact)){
			$errcontact = "Contact field is Required";
		}
		if(empty($class)){
			$errclass = "Class field is Required";
		}

		$checkRollExist = "SELECT * FROM student_info WHERE roll = '$roll' ";
		$checkRollResult = mysqli_query($connection,$checkRollExist);
		if(mysqli_num_rows($checkRollResult) > 0){
			$error = "Roll number already Exist!";
		}
		else{
			if(strlen($roll) == 6 && strlen($contact) == 11){
				$query = "INSERT INTO student_info VALUES(NULL,'$name','$roll','$class','$city','$contact','$photo','$date')";
				$result = mysqli_query($connection,$query);

				$lastId = mysqli_insert_id($connection);

				$fileName = "student_images/".$lastId.$_FILES['photo']['name'];
				$fileTemp = $_FILES['photo']['tmp_name'];
				move_uploaded_file($fileTemp, $fileName);

				$query = "UPDATE student_info SET photo = '$fileName' WHERE id = '$lastId' ";
				
				$result = mysqli_query($connection,$query);
				if($result){
					$msg = "Student added successfully";
					$name = $roll = $class = $city = $contact = $photo = "";
				}
				else{
					$error = "Student added failed";
				}
			}
		}
		
		
	}
?>

<h1 class="text-primary"><i class="fa fa-user-plus"></i> Add Student <small> Add New Student</small></h1>

<ol class="breadcrumb">
	<li><a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
	<li class="active"><i class="fa fa-user-plus"></i> Add Student</li>
</ol>


<div class="row">
	<div class="col-sm-6">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<span class="msg"><?php if(isset($msg)){echo $msg;}?></span>
				<span class="error"><?php if(isset($error)){echo $error;}?></span>
			
				<label for="name">Student Name</label>
				<input class="form-control" type="text" name="name" placeholder="Student Name" id="name" value="<?php if(isset($name)){echo $name;}?>">
				<span class="error"><?php if(isset($errname)){echo $errname;}?></span>
			</div>
			
			<div class="form-group">
				<label for="roll">Student Roll</label>
				<input class="form-control" type="text" name="roll" placeholder="Student Roll" id="roll" pattern="[0-9]{6}" value="<?php if(isset($roll)){echo $roll;}?>">
				<label class="error"><?php if(isset($errroll)){echo $errroll;}?></label>
			</div>
			
			<div class="form-group">
				<label for="city">City</label>
				<input class="form-control" type="text" name="city" placeholder="City" id="city" value="<?php if(isset($city)){echo $city;}?>">
				<label class="error"><?php if(isset($errcity)){echo $errcity;}?></label>
			</div>
			
			<div class="form-group">
				<label for="pcontact">Contact</label>
				<input class="form-control" type="text" name="pcontact" placeholder="01*********" id="pcontact" pattern="01[1|5|6|7|8|9][0-9]{8}" value="<?php if(isset($contact)){echo $contact;}?>">
				<label class="error"><?php if(isset($errcontact)){echo $errcontact;}?></label>
			</div>
			
			<div class="form-group">
				<label for="class">Class</label>
				<select id="class" class="form-control" name="class">
					<option>Select</option>
					<option>1st</option>
					<option>2nd</option>
					<option>3rd</option>
					<option>4th</option>
				</select>
			</div>
			
			<div class="form-group">
				<label for="picture">Picture</label>
				<input type="file" name="photo" id="picture">
			</div>

			<div class="form-group">
				<input type="submit" value="Add Student" name="add-student" class="btn btn-primary pull-right">
			</div>
			

		</form>
	</div>
</div>