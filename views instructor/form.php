
<?php 
session_start();
if(empty($_SESSION['instructor']))
  {
    header('location:../views student/index.php');
  }

include("../controller/coursController.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['title'])
     && !empty($_POST['desc'])
      && !empty($_POST['price'])
       && !empty($_FILES['photo']['name'])
       && !empty($_POST['instructor_id'])
       ){

         
          if(str_contains($_FILES["photo"]["type"],'image')){
          addCourse($_POST['title'],$_POST['desc'],$_POST['price'], $_FILES['photo']['name'], $_POST['instructor_id']);
           move_uploaded_file($_FILES["photo"]["tmp_name"],"image_course/" . $_FILES["photo"]["name"]);

            }
            else{
                $error_img="veuillez télecharger un fichier image";
            }
        }
    }

if(!empty( $_SESSION['instructor'])){
        $instructorConnected=getInstructor( $_SESSION['instructor']);
    }
 
?>
<?php include("../layouts/header.php") ?>
<?php if(!empty($_SESSION['instructor'])): ?>
<?php foreach($instructorConnected as $instructor): ?>
<img class="imageStudentConnected" src="image_instuctor/<?php echo $instructor['photo_instructor'] ?>" >
<h5 class="welcome-text">Bienvenue monsieur:<strong> <?php echo $_SESSION['instructor'] ?> </strong></h5>
<?php endforeach ?>
<?php endif ?>

<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >
<?php foreach($_SESSION['id_instructor'] as $instructorconnected) { 
         $value=$instructorconnected['id'];
            } ?> 


<div class="container">
    <div class="row">
        <form action="" method="post" class="form-group mt-5 col-md-6 offset-3" enctype="multipart/form-data">
            
             <h2 class="text-center text-muted"">  Ajouter un cour sur la plateforme </h2>
            <input type="text" name="title" class="form-control mt-2" placeholder="title">
            <textarea name="desc"  class="form-control" placeholder="description" rows="3"></textarea>
            <input type="text" name="price" class="form-control mt-2" placeholder="price">
            <input type="file" name="photo" class="form-control mt-2">
            <input type="hidden" name="instructor_id" class="form-control mt-2" value="<?php echo $value?>">
            <div style="color:red"><?php global  $error_img; echo  $error_img; ?></div>
            <button class="btn btn-dark form-control mt-2">save</button>
        </form>
</div>





<?php include("../layouts/footer.php") ?>