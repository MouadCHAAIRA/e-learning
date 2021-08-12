
<?php 
session_start();
if(empty($_SESSION['instructor']))
  {
    header('location:../views student/index.php');
  }



include("../controller/coursController.php"); 
foreach($_SESSION['id_instructor'] as $instructorconnected) { 
         $value=$instructorconnected['id'];
            } 

 //get id instructor           
$courses=getCourseInstructor($value);

//delete course
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['course_id'])){
      deleteCourse($_POST['course_id']);
        header('location:index.php');
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


<h2 class="text-center" style="color:#49526D">Vos cours sur la plateforme IT-TECH</h2>

 <div class="container "  >
    <div class="row d-flex  justify-content-between ">


<?php foreach($courses as $course) : ?>
  
<div class="card mt-5 "  style="width: 18rem;">

    
  <div class="card-body border-right-100 cours" >
   <img src="../views instructor/image_course/<?php echo $course['photo'] ?>" style="height:100px; width:100px" class="card-img-top" alt="...">
    <h2 class="card-text"><?php echo $course['title'] ?></h2>
</br>
</br>
  
  <h6><?php echo $course['description'] ?></h6>
</br>
<form action="" method="post" class="">
                <a style="background-color:black" href="edit.php?id=<?php echo $course['id'] ?>" class="btn btn-primary "><i   class="fa fa-edit"></i></a> 
                    <input type="hidden" name="course_id" value="<?php echo $course['id'] ?>">
                    <button style="background-color:#E9C121" class="btn btn-danger "><i  class="fa fa-trash"></i></button> 
           </form> 
    </div>
  

</div>
<?php endforeach ?>
</div>
</div>









<?php include("../layouts/footer.php") ?>