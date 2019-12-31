

<h1 class="text-primary"><i class="fa fa-user"></i> All User <small> All User</small></h1>

<ol class="breadcrumb">
	<li><a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
	<li class="active"><i class="fa fa-user-plus"></i> All User</li>
</ol>

<table id="data" class="table table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Username</th>
			<th>Photo</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$query = "SELECT * FROM users";
			$result = mysqli_query($connection,$query);
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_array($result)){
					$id = $row['id'];
					$name = $row['name'];
					$email = $row['email'];
					$username = $row['username'];
					$password = $row['password'];
					$photo = $row['photo'];
		?>
		<tr>
			<td><?php echo ucwords($name)?></td>
			<td><?php echo $email?></td>
			<td><?php echo strtolower($username)?></td>
			<td><img style="width: 60px;" src="<?php echo $photo?>" alt="image"></td>
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