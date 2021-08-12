<?php 
if(isset($_POST['logout']))
{
  session_destroy();
  session_destroy();
  header('location:login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">



<link rel="stylesheet" href="../style/index.css">

<link rel="stylesheet" href="../style/index2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<title>IT-TECH_course</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg " style="background-color: #E9C121">
  <div class="container-fluid ">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
      <div class="navbar-nav navbar-right">
        
       <a style="color:black" class="nav-link" href="../views student/index.php"><i class="fas fa-home " style="color:white; font-size:2rem"></i> </a>

         <?php if(empty($_SESSION['student']) && empty($_SESSION['instructor'])): ?>
        <a style="color:black" class="nav-link" href="../views student/login.php"><i class="fas fa-user-graduate" style="color:white; font-size:2rem"></i></a>
        <?php endif ?>

        <?php if(empty($_SESSION['student']) && empty($_SESSION['instructor']) ): ?>
          <a  style="color:black" class="nav-link" href="../views instructor/login.php"><i class="fas fa-chalkboard-teacher"  style="color:white; font-size:2rem""></i><a>
           <?php endif ?>

        
        
        <?php if(!empty($_SESSION['student'])): ?>
        <a style="color:black" class="nav-link" href="../views student/cart.php"><i class="fas fa-shopping-cart" style="color:white; font-size:2rem"></i></a>
        <a style="color:black" class="nav-link" href="../views student/profil.php"><i class="fas fa-user-alt" style="color:white; font-size:2rem"></i></a>
         <?php endif ?>

           <?php if(!empty($_SESSION['instructor'])): ?>
       <a href="../views instructor/index.php" style="color:black" class="btn " style="background-color:#E9C121; color:white ; font-size:2rem"><button type="button" class="btn btn-secondary btn-lg">Votre Espace</button></a> 
       <?php endif ?> 
        
          <?php if(!empty($_SESSION['instructor'])): ?>
      <a href="../views instructor/form.php" style="color:black" class="btn " style="background-color:#E9C121; color:white ; font-size:2rem"><i style="font-size:2rem; color:white" class="fas fa-plus"></i></a>
       <?php endif ?>


         <?php if(!empty($_SESSION['student']) || !empty($_SESSION['instructor']) ): ?>
         <form action="" method="post">
    <input type="hidden" name="logout">
<button  class="btn  btn_lougout" style="background-color:#E9C121; color:white ; font-size:2rem"><i class="fas fa-sign-out-alt"></i></button>
  </form>
  <?php endif ?>
  
        
         </div>
         </div>
  </div>
</nav>
