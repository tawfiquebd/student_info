<?php
	//include_once '../config/dbconnect.php';
	

	if(isset($_GET['id'])){
		$id = base64_decode($_GET['id']);
		$query = "SELECT * FROM student_info WHERE id = '$id' ";
		$result = mysqli_query($connection,$query);
		if(mysqli_num_rows($result)>0){
			$row = mysqli_fetch_array($result);
			$id = mysqli_real_escape_string($connection,$row['id']);
			$name = mysqli_real_escape_string($connection,$row['name']);
			$roll = mysqli_real_escape_string($connection,$row['roll']);
			$class = mysqli_real_escape_string($connection,$row['class']);
			$city = mysqli_real_escape_string($connection,$row['city']);
			$contact = mysqli_real_escape_string($connection,$row['pcontact']);
			$photo = mysqli_real_escape_string($connection,$row['photo']);
			
		}
		else{
			$error = "No data found";
		}
		
	}

	/* Update query*/

	if(isset($_POST['update-student'])){
		$name = mysqli_real_escape_string($connection,$_POST['name']);
		$roll = mysqli_real_escape_string($connection,$_POST['roll']);
		$city = mysqli_real_escape_string($connection,$_POST['city']);
		$contact = mysqli_real_escape_string($connection,$_POST['pcontact']);
		$class = mysqli_real_escape_string($connection,$_POST['class']);
		$photo = 'pic';
		//$date = date("Y-m-d H:i:s");

		//existing photo
		if(empty($_FILES['photo']['name'])){
			$fileName = $row['photo'];
		}
		else{
			$lastId = mysqli_insert_id($connection);

			$fileName = "student_images/".$lastId.$_FILES['photo']['name'];
			$fileTemp = $_FILES['photo']['tmp_name'];
			move_uploaded_file($fileTemp, $fileName);
		}

		if(empty($name) || empty($roll) || empty($city) || empty($contact) || empty($class)){
			$error = "All fields are Required";	
		}
		else{
			$query = "UPDATE student_info SET name = '$name', roll = '$roll', city = '$city', pcontact = '$contact', class = '$class', photo = '$fileName' WHERE id = '$id' ";
			$result = mysqli_query($connection,$query);

			if($result){
				$msg = "Student updated successfully";
				header("refresh:1; url=index.php?page=update-student&id=".base64_encode($id));
			}
			else{
				$error = "Student update failed";
			}
		}

		
	}
	
?>

<h1 class="text-primary"><i class="far fa-edit"></i> Update Student <small> Update Student</small></h1>

<ol class="breadcrumb">
	<li><a href="index.php?page=dashboard"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
	<li><a href="index.php?page=all-student"><i class="fa fa-users"></i> All Student</a></li>
	<li class="active"><i class="far fa-edit"></i> Update Student</li>
</ol>


<div class="row">
	<div class="col-sm-6">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<span class="msg"><?php if(isset($msg)){echo $msg;}?></span>
				<span class="error"><?php if(isset($error)){echo $error;}?></span>

				<input type="hidden" name="id" value="<?php echo $id?>">

				<label for="name">Student Name</label>
				<input class="form-control" type="text" name="name" placeholder="Student Name" id="name" value="<?php if(isset($name)){echo $name;}?>">
				<label class="error"><?php if(isset($input_error['name'])){echo $input_error['name'];}?></label>
			</div>
			
			<div class="form-group">
				<label for="roll">Student Roll</label>
				<input class="form-control" type="text" name="roll" placeholder="Student Roll" id="roll" pattern="[0-9]{6}" value="<?php if(isset($roll)){echo $roll;}?>">
				<label class="error"><?php if(isset($input_error['roll'])){echo $input_error['roll'];}?></label>
			</div>
			
			<div class="form-group">
				<label for="city">City</label>
				<input class="form-control" type="text" name="city" placeholder="City" id="city" value="<?php if(isset($city)){echo $city;}?>">
				<label class="error"><?php if(isset($input_error['city'])){echo $input_error['city'];}?></label>
			</div>
			
			<div class="form-group">
				<label for="pcontact">Contact</label>
				<input class="form-control" type="text" name="pcontact" placeholder="01*********" id="pcontact" pattern="01[1|5|6|7|8|9][0-9]{8}" value="<?php if(isset($contact)){echo $contact;}?>">
				<label class="error"><?php if(isset($input_error['contact'])){echo $input_error['contact'];}?></label>
			</div>
			
			<div class="form-group">
				<label for="class">Class</label>
				<select id="class" class="form-control" name="class">
					<option>Select</option>
					<option <?php echo $class=='1st' ? 'selected=""' : ''; ?> >1st</option>
					<option <?php if($class == '2nd'){echo "selected";} ?> >2nd</option>
					<option <?php echo $class=='3rd' ? 'selected=""' : ''; ?> >3rd</option>
					<option <?php echo $class=='4th' ? 'selected=""' : ''; ?> >4th</option>
				</select>
			</div>
			
			<div class="form-group">
				<label for="picture">Picture</label>
				<input type="file" name="photo" id="picture">
				<img width="90px" src="<?php if(isset($photo)){echo $photo ;}?>" alt="photo">
			</div>

			<div class="form-group">
				<input type="submit" value="Update Student" name="update-student" class="btn btn-primary pull-right">
			</div>
			

		</form>
	</div>
</div>