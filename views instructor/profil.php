<?php
session_start();
if(empty( $_SESSION['instructor']))
{
  header('location:../views student/index.php');

}

include("../controller/coursController.php");
if(!empty( $_SESSION['instructor'])){
        $instructorConnected=getInstructor($_SESSION['instructor']);
    }  



?>

<?php include("../layouts/header.php") ?>

<?php if(!empty($_SESSION['instructor'])): ?>
<?php foreach($instructorConnected as $instructor): ?>
<img class="imageStudentConnected" src="../views instructor/image_instructor/<?php echo $instructor['photo_instructor'] ?>" >
<h5 class="welcome-text">Bienvenue monsieur:<strong> <?php echo $_SESSION['instructor'] ?> </strong></h5>


<img class="image_logo" src="../layouts/logo-IT-TECH.png" alt="student avatar" >



<div class="container bootstrap snippets bootdey">
<div class="row">
  <div class="profile-nav col-md-3">
      <div class="panel">
          <div class="user-heading round">
              <a href="#">
                  <img src="image_instructor/<?php echo $instructor['photo_instructor'] ?>" alt="">
              </a>
              <h1><?php echo $instructor['name']?></h1>
              <h5><?php echo $_SESSION['instructor'] ?></h5>
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
             <h1>PROFIL</h1>
          </div>
          <div class="panel-body bio-graph-info">
              <h1>Biographie</h1>
              <div class="row">
                  <div class="bio-row">
                      <p><span>Username</span>:<?php echo $instructor['name']?></p>
                  </div>
                  
                  <div class="bio-row">
                      <p><span>Bio:</span><?php echo $instructor['bio']?> </p>
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