<?php
session_start();
if(empty($_SESSION['student']))
{
  header('location:index.php');

}

include("../controller/coursController.php");
if(!empty($_SESSION['student'])){
        $studentConnected=getStudent($_SESSION['student']);
    }  

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(
     !empty($_POST['username'])
     && !empty($_POST['email'])
     && !empty($_POST['password'])
     && !empty($_FILES['photo']['name'])
     && !empty($_POST['bio'])){


 if(str_contains($_FILES["photo"]["type"],'image')){   
         
       updateStudent($_POST['username'],$_POST['email'],$_POST['password'],$_FILES['photo']['name'],$_POST['bio']);
        move_uploaded_file($_FILES["photo"]["tmp_name"],"image/" . $_FILES["photo"]["name"]);

    }else{
          $error_img="veuillez télecharger un fichier image";
    }

     }
    }

?>

<?php include("../layouts/header.php") ?>
<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >
<?php if(!empty($_SESSION['student'])): ?>
<?php foreach($studentConnected as $student): ?>
<img class="imageStudentConnected" src="image/<?php echo $student['photo'] ?>" >
<strong class="welcome-text"><?php echo $student['name']?></strong>


<h2 class="text-secondary text-center text-muted">Setting profile</h2>
<div class="container mt-5">
    <div class="row">
        <form action="" class="form-group col-md-6 offset-3" method="POST" enctype="multipart/form-data">
           
            <input type="text" class="form-control mt-2" placeholder="username" name="username" value="<?php echo $student['name']?>">
            <input type="email" class="form-control mt-2" placeholder="email" name="email" value="<?php echo $_SESSION['student']?>">
            <input type="password" class="form-control mt-2" placeholder="password" name='password' value="<?php echo $student['password']?>"">
             <input type="file" name="photo" class="form-control mt-2">
           <div style="color:red"><?php global  $error_img; echo  $error_img; ?></div>
           <input type="text" class="form-control mt-2" placeholder="bio" name='bio' value="<?php echo $student['bio']?>"">
           <button class="form-control " style="background-color:#010101; color:white">register</button>
        </form>
    </div>
</div>









<?php endforeach ?>
<?php endif ?>
<?php include("../layouts/footer.php") ?>