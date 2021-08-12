
<?php 
session_start();
if(empty($_SESSION['instructor']))
  {
    header('location:../views student/index.php');
  }



include("../controller/coursController.php");
$course=showDetails($_GET['id']);

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['title'])
     && !empty($_POST['desc'])
      && !empty($_POST['price'])
       && !empty($_FILES['photo']['name'])
       ){

         
          if(str_contains($_FILES["photo"]["type"],'image')){
          updateCourse($_GET['id'],$_POST['title'],$_POST['desc'],$_POST['price'], $_FILES['photo']['name']);
           move_uploaded_file($_FILES["photo"]["tmp_name"],"image_course/" . $_FILES["photo"]["name"]);
            header('location:index.php');
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
<img class="imageStudentConnected" src="../views instructor/image_instructor/<?php echo $instructor['photo_instructor'] ?>" >
<h5 class="welcome-text">Bienvenue monsieur:<strong> <?php echo $_SESSION['instructor'] ?> </strong></h5>
<?php endforeach ?>
<?php endif ?>
<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >

<div class="container">
    <div class="row">
        <form action="" method="post" class="form-group mt-5 col-md-6 offset-3" enctype="multipart/form-data">
          <h2 class="text-center "> Cette page vous donne l'accès à apporter des modification à ce cour </h2>
            <input type="text" name="title" class="form-control mt-2" placeholder="title"  value="<?php echo $course['title'] ?>">
            <textarea name="desc"  class="form-control" placeholder="description" rows="3"><?php echo $course['description'] ?></textarea>
            <input type="text" name="price" class="form-control mt-2" placeholder="price"  value="<?php echo $course['price'] ?>">
            <input type="file" name="photo" class="form-control mt-2"  value="image_course/<?php echo $course['photo'] ?>">
              <div style="color:red"><?php $course['title'] ?></div>
            <div style="color:red"><?php global  $error_img; echo  $error_img; ?></div>
            <button class="btn btn-dark form-control mt-2">save</button>
        </form>
</div>












<?php include("../layouts/footer.php") ?>