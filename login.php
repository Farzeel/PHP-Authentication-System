<?php

require "partials/_dbconnect.php";
$userlogin = false;
$error = false;

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
 
  
 
        $sql = "SELECT * FROM users WHERE username = '$username' ;";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num==1){
          while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['password'])){
              $userlogin = true;
              session_start();
              $_SESSION['loggedin']=true;
              $_SESSION['username']= $username;
             
              header("Location: welcome.php");
            }
            else{
              $error=true;
          }
          }
        
        }else{
            $error=true;
        }
    
       
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <?php  require "partials/_nav.php" ?>

  <?php
  if ($userlogin) {
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sucess!</strong> login sucessfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  if ($error) {
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Invalid Credentials.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>
  <div class="container my-3 ">
    <h2 class="text-center">Login to Your Account</h2>
    <form class="d-flex flex-column align-items-center my-3" action="/loginSystem/login.php" method="post">
        <div class="mb-3 col-md-6 ">
          <label for="username" class="form-label">User-Name</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
         
        </div>
        <div class="mb-3 col-md-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
       
      
        <button type="submit" class=" btn btn-primary col-md-6">Login</button>
      </form>
 </div>
  
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>