<?php
  include_once 'config/dbconnect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Managment System</title>

    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <br>
    <div class="login">
      <div class="container">
        <a href="admin/login.php" class="btn btn-primary pull-right">Login</a>
      </div>
    </div>
    <br>
    <br>

    <h1 class="text-center">Welcome to Student Information System</h1>
    
    <div class="form-area">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <form action="" method="post">

                <table class="table table-bordered">
                  <tr>
                    <td colspan="2" class="text-center"><label>Student Information</label></td>
                  </tr>
                  <tr>
                    <td><label for="choose">Choose Class</label></td>
                    <td>
                      <select class="form-control" id="choose" name="choose" required>
                        <option>Select</option>
                        <option value="1st">1th</option>
                        <option value="2nd">2th</option>
                        <option value="3rd">3th</option>
                        <option value="4th">4th</option>
                        <option value="5th">5th</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><label for="roll">Roll</label></td>
                    <td><input class="form-control" id="roll" type="text" name="roll" pattern="[0-9]{6}" placeholder="Roll"></td>
                  </tr>
                  <tr>
                    <td class="text-center" colspan="2"><input class="btn btn-default" type="submit" name="show" value="Show Info"></td>
                  </tr>
                </table>
                
            </form>
          </div>
        </div>
        <br>
        <br>
        <?php
          if(isset($_POST['show'])){
            $choose = $_POST['choose'];
            $roll = $_POST['roll'];

            if(!empty($choose) && !empty($roll)){
              $query = "SELECT * FROM student_info WHERE class = '$choose' AND roll = '$roll' ";
              $result = mysqli_query($connection,$query);
              if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_array($result);
                $id = $row['id'];
                $name = $row['name'];
                $roll = $row['roll'];
                $class = $row['class'];
                $city = $row['city'];
                $contact = $row['pcontact'];
                $photo = $row['photo'];
                ?>
                <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <table class="table table-bordered table-striped">
              <tr>
                <td rowspan="5"><img width="200px" class="img-thumbnail" src="admin/<?php echo $photo?>" alt="image"></td>
                <td>Name</td>
                <td><?php echo $name?></td>
              </tr>
              <tr>
                <td>Roll</td>
                <td><?php echo $roll?></td>
              </tr>
              <tr>
                <td>Class</td>
                <td><?php echo $class?></td>
              </tr>
              <tr>
                <td>City</td>
                <td><?php echo $city?></td>
              </tr>
              <tr>
                <td>Contact</td>
                <td><?php echo $contact?></td>
              </tr>
            </table>
          </div>
        </div>

            <?php
              }
              else{
               echo $error = "<span class='text-center error'>No Data Found</span>";
              }
            }
            else{
              echo $error = "<span class='text-center error'>All fields Required</span";
            }

          ?>
      
        
        <?php
          }
        ?>
        
      </div>
    </div>




    <!-- Js files -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>