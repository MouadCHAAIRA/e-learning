
<?php
session_start();
include("../controller/coursController.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
     !empty($_POST['username'])
     && !empty($_POST['email'])
     && !empty($_POST['password'])
     && !empty($_FILES['photo']['name'])
     && !empty($_POST['bio'])
     ){

      
        if(str_contains($_FILES["photo"]["type"],'image')){   
          if(!addStudent($_POST["username"],$_POST["email"],$_POST["password"], $_FILES['photo']['name'],$_POST["bio"])){
           $error_registre="Ce compte existe deja"; 
       }
       else{
           $_SESSION['student']=$_POST['email']; 
           header('location:index.php');

       }
        move_uploaded_file($_FILES["photo"]["tmp_name"],"image/" . $_FILES["photo"]["name"]);

    }else{
          $error_img="veuillez télecharger un fichier image";
    }
}
}

?>
<?php include("../layouts/header.php") ?>
<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >
          

</br>
<img class="image_login" src="image/student1.jpg" alt="student avatar" >
<h2 class="text-secondary text-center text-muted">Créez un compte etudiant</h2>
<div class="container mt-5">
    <div class="row">
        <form action="" class="form-group col-md-6 offset-3" method="POST" enctype="multipart/form-data">
            <h2 style="color:red"><?php global  $error_registre; echo  $error_registre; ?></h2>
            <input type="text" class="form-control mt-2" placeholder="username" name="username">
            <input type="email" class="form-control mt-2" placeholder="email" name="email">
            <input type="password" class="form-control mt-2" placeholder="password" name='password'>
             <input type="file" name="photo" class="form-control mt-2">
           <div style="color:red"><?php global  $error_img; echo  $error_img; ?></div>
           <input type="text" class="form-control mt-2" placeholder="bio" name='bio'>
           <button class="form-control " style="background-color:#010101; color:white">register</button>
        </form>
    </div>
</div>



<?php include("../layouts/footer.php") ?>
