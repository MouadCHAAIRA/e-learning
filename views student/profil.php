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



?>



<?php include("../layouts/header.php") ?>
<?php if(!empty($_SESSION['student'])): ?>
<?php foreach($studentConnected as $student): ?>
<img class="imageStudentConnected" src="image/<?php echo $student['photo'] ?>" >
<strong class="welcome-text"><?php echo $student['name']?></strong>


<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >

<div class="container bootstrap snippets bootdey">
<div class="row">
  <div class="profile-nav col-md-3">
      <div class="panel">
          <div class="user-heading round">
              <a href="#">
                  <img src="image/<?php echo $student['photo'] ?>" alt="">
              </a>
              <h1><?php echo $student['name']?></h1>
              <h5><?php echo $_SESSION['student'] ?></h5>
          </div>

          <ul class="nav nav-pills nav-stacked">
              
              <li><a href="setting.php"> <i class="fa fa-edit"></i> Edit profile</a></li>
          </ul>
      </div>
  </div>
  <div class="profile-info col-md-9">
      <div class="panel">
          
      </div>
      <div class="panel">
          <div class="bio-graph-heading">
              Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
          </div>
          <div class="panel-body bio-graph-info">
              <h1>Biographie</h1>
              <div class="row">
                  <div class="bio-row">
                      <p><span>Username</span>:<?php echo $student['name']?></p>
                  </div>
                  
                  <div class="bio-row">
                      <p><span>Bio:</span><?php echo $student['bio']?> </p>
                  </div>
                
              </div>
          </div>
      </div>
      <div>
          
             
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</div>
<?php endforeach ?>
<?php endif ?>
<?php include("../layouts/footer.php") ?>