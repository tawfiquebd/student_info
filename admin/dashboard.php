				<h1 class="text-primary"><i class="fa fa-tachometer-alt"></i> Dashboard <small> Statistics Overview</small></h1>

				<ol class="breadcrumb">
					<li class="active"><i class="fa fa-tachometer-alt"></i> Dashboard</li>
				</ol>
				<?php
					$query = "SELECT * FROM student_info";
					$result = mysqli_query($connection,$query);
					$studentCount = mysqli_num_rows($result);

					$query = "SELECT * FROM users";
					$result = mysqli_query($connection,$query);
					$usersCount = mysqli_num_rows($result);
				?>
					<div class="row">
						<div class="col-sm-4">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-users fa-5x"></i>
										</div>
										<div class="col-xs-9">
											<div class="pull-right"  style="font-size:45px";><?php echo $studentCount?></div>
											<div class="clearfix"></div>
											<div class="pull-right">All Student</div>
										</div>
									</div>
								</div>
								<a href="index.php?page=all-student">
									<div class="panel-footer">
										<span class="pull-left">All Student</span>
										<span class="pull-right"><i class="fa fa-users"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-xs-3">
											<i class="fa fa-users fa-5x"></i>
										</div>
										<div class="col-xs-9">
											<div class="pull-right"  style="font-size:45px";><?php echo $usersCount?></div>
											<div class="clearfix"></div>
											<div class="pull-right">All Users</div>
										</div>
									</div>
								</div>
								<a href="index.php?page=all-users">
									<div class="panel-footer">
										<span class="pull-left">All Users</span>
										<span class="pull-right"><i class="fa fa-users"></i></span>
										<div class="clearfix"></div>
									</div>
								</a>
							</div>
						</div>
					</div>

					<hr>
					<h3>New Students</h3>
					<div class="table-responsive">
						<table id="data" class="table table-hover table-bordered table-striped">
							<thead>
								<tr>
									<th>Id</th>
									<th>Name</th>
									<th>Roll</th>
									<th>City</th>
									<th>Contact</th>
									<th>Photo</th>
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
											$city = $row['city'];
											$contact = $row['pcontact'];
											$photo = $row['photo'];
								?>
								<tr>
									<td><?php echo $id?></td>
									<td><?php echo $name?></td>
									<td><?php echo $roll?></td>
									<td><?php echo $city?></td>
									<td><?php echo $contact?></td>
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
					</div>