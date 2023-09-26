<?php
require "partials/_dbconnect.php";

$userRegister = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $userExistsSql = "SELECT * FROM `users` WHERE `username` = '$username';";
    $userExistsResult = mysqli_query($conn,$userExistsSql);
    $noOfRows = mysqli_num_rows($userExistsResult);
    if ($noOfRows>0) {
        $showError = " UserName Already Exists! please Enter an unique username";
    }
    else{
      if(($password == $cpassword)){
         $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` ( `username`, `password`, `date`) 
        VALUES ( '$username', '$hashedPassword', current_timestamp());";
        $result = mysqli_query($conn,$sql);
        if($result){
         $userRegister=true;
        }
    }
    else{
         $showError = "password and confirm password must be same";
    }
    }
   
    
       
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign-Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <?php  require "partials/_nav.php" ?>
  <?php
  if ($userRegister) {
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sucess!</strong> Your account has been registerd sucessfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  if ($showError) {
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>'.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>
 <div class="container my-3 ">
    <h2 class="text-center">Sign-Up To our Website</h2>
    <form class="d-flex flex-column align-items-center my-3" action="/loginSystem/signup.php" method="post">
        <div class="mb-3 col-md-6 ">
          <label for="username" class="form-label">User-Name</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
         
        </div>
        <div class="mb-3 col-md-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3 col-md-6">
          <label for="cpassword" class="form-label">Confirm-Password</label>
          <input type="password" class="form-control" id="cpassword" name="cpassword">
          
      
        </div>
      
        <button type="submit" class=" btn btn-primary col-md-6">Sign-Up</button>
      </form>
 </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>