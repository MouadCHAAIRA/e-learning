
<?php 
session_start();
include('../controller/coursController.php');
   $StudentCommentaire=getstudentcommented();
    $course=showDetails($_GET['id']);
    if($_SERVER['REQUEST_METHOD']=='POST'){
    if(!empty($_POST['course_id'])&& !empty($_POST['student_id'])){
      
    
           foreach($_SESSION['id_student'] as $studentconnected){

                  $value=$studentconnected['id'];
           }  
             if(!checkFavoritCourses($_GET['id'],$value)){
                 
                 addToFavori($_POST['course_id'],$_POST['student_id']);
                 
             }
              
           
    }
        
         if(isset($_POST['comment']) && !empty($_POST['comment'])){
         addComment($_POST['course_id'], $_POST['student_id'], $_POST['comment']);
         echo "<meta http-equiv='refresh' content='0'>";  
         }   

    }
    if(!empty($_POST['comment_id'])){
      deleteComment($_POST['comment_id']);
      echo "<meta http-equiv='refresh' content='0'>";
      
    }
          
        if(!empty($_SESSION['student'])){
        $studentConnected=getStudent($_SESSION['student']);
    }  
          
     
      
 ?>

<?php include('../layouts/header.php') ?>

<?php if(!empty($_SESSION['student'])): ?>
<?php foreach($studentConnected as $student): ?>
<img class="imageStudentConnected" src="image/<?php echo $student['photo'] ?>" >
<strong class="welcome-text"><?php echo $_SESSION['student']?></strong>
<?php endforeach ?>
<?php endif ?>
<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >

<div class="container mt-5">
    <div class="row">

        <div class="card">
          <div class="card-body">
            <h2 class="card-title"><?php  echo $course['title'] ?></h2>
               <img src="../views instructor/image_course/<?php echo $course['photo'] ?>" style="height:130px; width:130px" class="card-img-top" alt="...">
            <h2>A propos:</h2>
               <h3 class="card-subtitle mb-2 text-muted"><?php echo $course['description'] ?></h3>
  </br>
            <i class="far fa-money-bill-alt" style="background-color:green; font-size:50px"></i>
            <h2 class="card-text"> <?php echo $course['price'] ?>$</h2>
            
           <?php if(!empty($_SESSION['student'])): ?>  
                <form action="" method="post" class="" id="form"> 
                  <input type="hidden" name="course_id" value="<?php echo $course['id'] ?>"> 
                  <?php foreach($_SESSION['id_student'] as $studentconnected) {?>
                  <input type="hidden" name="student_id" value="<?php echo $studentconnected['id']?>"> 
                   <?php } ?>  
             <button href="cart.php" class="btn "><i  style="color:red; font-size:50px"class="fa fa-heart"></i></button>
              
            </br>
            </br>
            </br>
 
           
<textarea name="comment" id="textarea" cols="100" rows="3" placeholder="ecrire votre commentaire"></textarea>
                  </br>
             <button id='button' style="color:white ,background-color:black" class="btn btn-success text-center ">Submit</button>
                  </form>
              <?php endif ?> 
              
                  </div>
                  </div>    
                  <h2 class="text-center text-muted">Commentaires</h2>
                  <h2><?php echo count(getCountCommentaire($_GET['id'])). " " ."commentaires"?> </h2>

         <?php foreach($StudentCommentaire as $student) { ?>
         <?php if($student['course_id']==$_GET['id']) : ?>
            
         

   <!-- COMMENT 1 - START -->
  <section class="content-item" id="comments" style="margin-bottom:50px">
    <div class="container">   
    	<div class="row">
            <div class="col-sm-8">
                <div class="media" >
                    <a class="pull-left" href="#"><img style="height:100px; width:100px; margin-right:10px"class="media-object" src="image/<?php echo  $student['photo'] ?>" alt=""></a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php  echo $student['name'];?></h4>
                        <p><?php echo $student['content'] ?></p>
                        <ul class="list-unstyled list-inline media-detail pull-left">
                            <li><i style="color:blue;" class="fa fa-calendar"></i><?php echo $student['created_at'] ?></li>
  
                        </ul>
        <ul class="list-unstyled list-inline media-detail pull-right">
                           

                            <?php if(!empty($_SESSION['student'])): ?>
             <?php  foreach($_SESSION['id_student'] as $studentconnected){ ?> 
                    
            <?php if(!empty($_SESSION['student']) && $student['id']==$studentconnected['id']) : ?>  
              
              <form action="" method="post" class=formDeleteComment>
              <input type="hidden" name="comment_id" value="<?php echo $student['comment_id'] ?>"> 
             <button  style="color:blue; padding: 0; border: none; background: none;" class="" deleteComment ">Delete</button>
            </form>
                             
        </ul>
               
           <?php endif ?> 
             <?php }  ?>
            <?php endif ?>
          
            <!-- COMMENT 1 - END -->

           </div>
                </div> 
         
          </div>
    </div>
</div>
</section>
  <?php endif ?>         
            <?php } ?>

 <script>
elt1=document.getElementById('textarea');
elt2=document.getElementById('form');
elt2.addEventListener("onsubmit",function(){
elt1.value="";

})

 </script>

<?php include('../layouts/footer.php') ?>