<?php
session_start();
if(empty($_SESSION['instructor']))
{
  header('location:../views student/index.php');

}

include("../controller/coursController.php");
if(!empty( $_SESSION['instructor'])){
        $instructorConnected=getInstructor($_SESSION['instructor']);
    }  
 

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
     !empty($_POST['username'])
     && !empty($_POST['email'])
     && !empty($_POST['password'])
     && !empty($_FILES['photo']['name'])
     && !empty($_POST['bio'])){


 if(str_contains($_FILES["photo"]["type"],'image')){   
         
       updateInstructor($_POST['username'],$_POST['email'],$_POST['password'],$_FILES['photo']['name'],$_POST['bio']);
        move_uploaded_file($_FILES["photo"]["tmp_name"],"image_instructor/" . $_FILES["photo"]["name"]);
        header('location:profil.php');

    }else{
          $error_img="veuillez télecharger un fichier image";
    }

     }
    }

?>

<?php include("../layouts/header.php") ?>

<?php if(!empty($_SESSION['instructor'])): ?>
<?php foreach($instructorConnected as $instructor): ?>
<img class="imageStudentConnected" src="../views instructor/image_instructor/<?php echo $instructor['photo_instructor'] ?>" >
<h5 class="welcome-text">Bienvenue monsieur:<strong> <?php echo $_SESSION['instructor'] ?> </strong></h5>


<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >


<h2 class="text-secondary text-center text-muted">Setting profile</h2>
<div class="container mt-5">
    <div class="row">
        <form action="" class="form-group col-md-6 offset-3" method="POST" enctype="multipart/form-data">
          

            <input type="text" class="form-control mt-2" placeholder="username" name="username" value="<?php echo $instructor['name']?>">
            <input type="email" class="form-control mt-2" placeholder="email" name="email" value="<?php echo $_SESSION['instructor']?>">
            <input type="password" class="form-control mt-2" placeholder="password" name='password' value="<?php echo $instructor['password']?>"">
             <input type="file" name="photo" class="form-control mt-2">
           <div style="color:red"><?php global  $error_img; echo  $error_img; ?></div>
           <input type="text" class="form-control mt-2" placeholder="bio" name='bio' value="<?php echo $instructor['bio']?>"">
           <button class="form-control " style="background-color:#010101; color:white">SAVE</button>
        </form>
    </div>
</div>









<?php endforeach ?>
<?php endif ?>
<?php include("../layouts/footer.php") ?>