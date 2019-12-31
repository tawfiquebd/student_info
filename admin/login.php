<?php
  session_start();

  if(isset($_SESSION['user_login'])){
      header("Location: index.php");
    }

  include_once '../config/dbconnect.php';

  if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);

    if(empty($username) || empty($password)){
      $error = "Field cannot be empty";
    }
    else{
      $query = "SELECT * FROM users WHERE username = '$username' ";
      $result = mysqli_query($connection,$query);
          $row = mysqli_fetch_array($result);
          $stored_password = $row['password'];
          $check = password_verify($password,$stored_password);
          if($check == true){
            if($row['status'] == 'active'){
              $_SESSION['user_login'] = $username;
              header('Location: index.php');
            }
            else{
              $error = "User not active";
            }
          }
          else{
            $error = "Username or Password invalid";
          }
    }








    }
  
    function validate($data){
      $data = htmlspecialchars($data);
      $data = trim($data);
      $data = stripcslashes($data);
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
    <br>
    <div class="login-form animated shake">
      <div class="container">
        <h1 class="text-center">Student Managment System</h1>
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <h2 class="text-center">Admin Login Form</h2>
            <form action="" method="post">
              <?php
                if(isset($error)){
                  echo "<span class='error'>$error</span>";
                }
              ?>
              <div class="form-group">
                <input name="username" type="text" placeholder="Username" class="form-control">
              </div>

              <div class="form-group">
                <input name="password" type="password" placeholder="Password" class="form-control">
              </div>

              <div>
                <input type="submit" value="Login" name="login" class="btn btn-info pull-right">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>



    <!-- Js files -->
    <script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  </body>
</html>