

<h1 class="text-primary"><i class="fa fa-user"></i> All Students <small> All Students</small></h1>

<ol class="breadcrumb">
	<li><a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
	<li class="active"><i class="fa fa-user-plus"></i> All Students</li>
</ol>

<table id="data" class="table table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Roll</th>
			<th>Class</th>
			<th>City</th>
			<th>Contact</th>
			<th>Photo</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$query = "SELECT * FROM student_info";
			$result = mysqli_query($connection,$query);
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_array($result)){
					$id = $row['id'];
					$name = $row['name'];
					$roll = $row['roll'];
					$class = $row['class'];
					$city = $row['city'];
					$contact = $row['pcontact'];
					$photo = $row['photo'];
		?>
		<tr>
			<td><?php echo $id?></td>
			<td><?php echo ucwords($name)?></td>
			<td><?php echo $roll?></td>
			<td><?php echo $class?></td>
			<td><?php echo ucwords($city)?></td>
			<td><?php echo $contact?></td>
			<td><img style="width: 60px;" src="<?php echo $photo?>" alt="image"></td>
			<td>
				<a class="btn-xs btn btn-warning" href="index.php?page=update-student&id=<?php echo base64_encode($id) ;?>"><i class="fa fa-pencil-alt"></i> Edit</a>
				&nbsp;
				<a class="btn-xs btn btn-danger" href="delete-student.php?id=<?php echo base64_encode($id) ;?>"><i class="fa fa-trash"></i> Delete</a>
			</td>
		</tr>
		<?php

				}
			}
			else{
				echo "<h2 style='color:red;' class='text-center'>No data found</h2>";
			}
			
		?>
	</tbody>
</table>