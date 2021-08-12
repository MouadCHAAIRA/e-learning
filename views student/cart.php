
<?php
session_start();
if(empty($_SESSION['student']))
{
  header('location:index.php');

}


include("../controller/coursController.php");
  foreach($_SESSION['id_student'] as $studentconnected) {
  $courseFavori=getFavoriCourse($studentconnected['id']);
  }
   if($_SERVER['REQUEST_METHOD']=='POST'){
       
    if(!empty($_POST['id'])){
    deleteFavori($_POST['id']);
    
    }
  }
  if(!empty($_SESSION['student'])){
        $studentConnected=getStudent($_SESSION['student']);
    }  

?>

<?php include("../layouts/header.php") ?>
<?php if(!empty($_SESSION['student'])): ?>
<?php foreach($studentConnected as $student): ?>
<img class="imageStudentConnected" src="image/<?php echo $student['photo'] ?>" >
<strong class="welcome-text"><?php echo $student['name']?></strong>
<?php endforeach ?>
<?php endif ?>
<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >


<h2 class="text-center text-muted""> Vos cours favoris </h2>

<?php foreach($courseFavori as $course) : ?>
 
<div class="container mt-5">
    <div class="row">

        <div class="card ">
          <div class="card-body favoritCour">
            <h2 class="card-title"><?php echo $course['title']?></h2>
           <img src="../views instructor/image_course/<?php echo $course['photo'] ?>" style="height:100px; width:100px" class="card-img-top" alt="...">
</br>
</br>

             <i class="far fa-money-bill-alt" style="background-color:green; font-size:50px"></i>
            <h2 class="card-text"> <?php echo $course['price'] ?>$</h2>
               <form action="" method="post" class=""> 
                  <input type="hidden" name="id" value="<?php echo $course['id'] ?>">  
             <button class="btn btn-outline-warning "><i  style="color:black"class="fa fa-trash"></i></button>
                </form>
            
          </div>       
        </div>
    </div>
</div>

  <?php endforeach ?>

<?php include('../layouts/footer.php') ?>