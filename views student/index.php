
<?php 
session_start();


include("../controller/coursController.php");
 
 $courses=getCourse();
  if(isset($_POST['name']))
  {
      $courses=search($_POST['name']);
      
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
<div class="container mt-5">
    <form action="" class="form-group" method="POST">
        <input type="text" class="form-control shadow active" name="name" placeholder="Rehercher(cour,formation...)">
        <button class="btn btn-secondary my-2"  style="background-color:#010101; color:white">search</button>
    </form>
</div>


<h2 class="text-center"> cours IT-TECH </h2>

 <div class="container "  >
    <div class="row d-flex  justify-content-between ">


<?php foreach($courses as $course) : ?>
  
<div class="card mt-5 "  style="width: 18rem;">

    
  <div class="card-body border-right-300 cours" >
   <img src="../views instructor/image_course/<?php echo $course['photo'] ?>" style="height:100px; width:100px" class="card-img-top" alt="...">
    <h2 class="card-text"><?php echo $course['title'] ?></h2>
</br>
</br>
  <h3>créateur:</h3>
    <img src="../views instructor/image_instructor/<?php echo $course['photo_instructor'] ?>" style="height:50px; width:50px; border-radius:100%;" class="card-img-top" >
  
  <h3 class="card-title"><?php echo $course['name'] ?></h3>
  <h6><?php echo $course['bio'] ?></h6>
</br>
 <a style="background-color:black" href="details.php?id=<?php echo $course['id'] ?>" class="btn btn-primary "><i  class="fa fa-eye"></i></a> 

    </div>
  

</div>
<?php endforeach ?>
</div>
</div>

<?php include("../layouts/footer.php") ?>