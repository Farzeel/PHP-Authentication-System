<?php


if(isset($_SESSION["loggedin"]) && $_SESSION==true){
  $login = true;
}else{
  $login=false;
}

echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="font-weight-bold text-danger navbar-brand" href="#">Authentication-System</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link text-light" aria-current="page" href="/loginSystem/welcome.php">Home</a>
      </li>';
      if(!$login){
        echo' <li class="nav-item">
        <a class="nav-link text-light" aria-current="page" href="/loginSystem/signup.php">Sign-Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="/loginSystem/login.php">Login</a>
      </li>';
      }
      if($login){
        echo' <li class="nav-item">
        <a class="nav-link text-light" href="/loginSystem/logout.php">Logout</a>
      </li>';
      }
  
 

  echo'   </ul>

  </div>
</div>
</nav>';

?>

       
       
        
   