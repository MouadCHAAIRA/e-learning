
<?php 
session_start();
if(!empty($_SESSION['instructor']))
  {
    header('location:index.php');
  }


include("../controller/coursController.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    if( !empty($_POST['email']) && !empty($_POST['password'])){
        if(!loginInstructor($_POST['email'],$_POST['password'])){
            $error_login="email ou password est incorrect";
         }
         else{
             $_SESSION['instructor']=$_POST['email'];
               $_SESSION['id_instructor']=getInstructor($_POST['email']);
              header('location:index.php');
           }
}
}
?>
<?php include("../layouts/header.php") ?>
<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >
</br>
<h2 class="text-center text-muted" style="color:#49526D">Espace Formateur</h2>
<img class="image_login" src="image_instructor/formateur1.png" alt="student avatar" >
<div class="container mt-5">
    <div class="row">
        <form action="" class="form-group col-md-6 offset-3" method="POST">
            <h2 class="text-secondary text-center">Se connecter</h2>
            <input type="email" class="form-control mt-2" placeholder="email" name="email">
            <input type="password" class="form-control mt-2" placeholder="password" name='password'>
             <div style="color:red"><?php global  $error_login; echo  $error_login; ?></div>
            <button class="form-control " style="background-color:#E9C121; color:white">login</button>
           <a href="register.php" ><button type="button" class="form-control " style="background-color:#010101; color:white">sign-up</button></a>
        </form>
        
    </div>
    
</div>




<?php include("../layouts/footer.php") ?>