<?php 
include('../db/config.php');

$pdo=new PDO(ROOT,USERNAME,PASSWORD);


function checkStudent($username,$email)
{
    global $pdo;

    if($pdo)
    {

        $query='SELECT *from studens where email=:email or name=:name';
    
        $statement=$pdo->prepare($query);
    
        $statement->execute([
            ':name'=>$username,
            ':email'=>$email
        ]);
    
        $result=$statement->fetchAll();

        return  count($result)==1 ? true : false;
    }
}


function addStudent($name,$email,$password,$photo,$bio){
    global $pdo;
    if($pdo)
    {
      if(!checkStudent($name,$email)){

        $query="INSERT INTO studens (name,email,password,photo,bio) values(:name,:email,:password,:photo,:bio)";

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':name'=>$name,
            ':email'=>$email,
            ':password'=>$password,
            ':photo'=>$photo,
            ':bio'=>$bio,

        ]);
      return true;
    }
    return false;
    }
}

function checkInstructor($username,$email)
{
    global $pdo;

    if($pdo)
    {
        

        $query='SELECT *from instructor where email=:email or name=:name';
    
        $statement=$pdo->prepare($query);
    
        $statement->execute([
            ':name'=>$username,
            ':email'=>$email
        ]);
    
        $result=$statement->fetchAll();

        return  count($result)>=1 ? true : false;
    }
}

function addInstructor($name,$email,$password,$photo,$bio){
    global $pdo;
    if($pdo)
    {
     
    if(!checkInstructor($name,$email)){
        $query="INSERT INTO instructor (name,email,password,photo_instructor,bio) values(:name,:email,:password,:photo_instructor,:bio)";

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':name'=>$name,
            ':email'=>$email,
            ':password'=>$password,
            ':photo_instructor'=>$photo,
            ':bio'=>$bio,

        ]);
            return true;
    }
     return false;
}

}

function addCourse($title, $desc, $price,$photo,$instructor)
{
 global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
          $query="INSERT INTO course (title,description,price,creation_date,photo,instructor_id) values(:title,:description,:price,:creation_date,:photo,:instructor_id)";

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':title'=>$title,
            ':description'=>$desc,
            ':price'=>$price,
            ':creation_date'=>date("Y-m-d H:i:s"),
            ':photo'=>$photo,
            ':instructor_id'=>$instructor,
        
        ]);
 
}
}

function getCourse(){

 global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query="SELECT course.title, course.photo, course.id, instructor.name, instructor.photo_instructor, instructor.bio
         FROM course
         INNER JOIN instructor ON course.instructor_id=instructor.id
          ORDER BY creation_date DESC";

        $statement=$pdo->prepare($query);

        $statement->execute();

         return $statement->fetchAll();
    }


}

function showDetails($id)
{
      global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query='SELECT *from course where id=:id';
        $statement=$pdo->prepare($query);

        $statement->execute([
            ':id'=>$id
        ]);

        return $statement->fetch();
    }
}

function addToFavori($course_id,$student_id){

  global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query="INSERT INTO bascket (course_id,student_id) values(:course_id,:student_id) ";
        $statement=$pdo->prepare($query);

        $statement->execute([
            ':course_id'=>$course_id,
            ':student_id'=>$student_id,
        ]);
        
    }
   
}

function getFavori($id){
global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query='SELECT *from bascket where id=:id';

        $statement=$pdo->prepare($query);

        $statement->execute([
           ":id"=>$id,
       
        ]);

         return $statement->fetchAll();
    }
     return count($result)>=1 ? true : false;
}


function getFavoriCourse($id){
     global $pdo;
    

    
        $query='SELECT *from course INNER JOIN bascket ON course.id=bascket.course_id WHERE student_id=:student_id';

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':student_id'=>$id,
        ]);

         return $statement->fetchAll();
    
}

function deleteFavori($id)
{
    global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query='DELETE from bascket where id=:id';
        $statement=$pdo->prepare($query);

        $statement->execute([
            ':id'=>$id
        ]);
    }
}

function search($name){

    global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
         $query="SELECT course.title, course.photo, course.id, instructor.name, instructor.photo_instructor, instructor.bio
         FROM course
         INNER JOIN instructor ON course.instructor_id=instructor.id
          where title like :title
          ORDER BY creation_date DESC";
        
        $statement=$pdo->prepare($query);
        $statement->execute([
            ':title'=>"$name%"
        ]);
        return $statement->fetchAll();
    }

}

function loginInstructor($email,$password)
{
    global $pdo;

    if($pdo)
    {

        $query='SELECT *from instructor where email=:email and password=:password';
    
        $statement=$pdo->prepare($query);
    
        $statement->execute([
            ':email'=>$email,
            ':password'=>$password,
        ]);
    
        $result=$statement->fetchAll();

        return  count($result)==1 ? true : false;
    }
}
function loginStudent($email,$password)
{
    global $pdo;

    if($pdo)
    {

        $query='SELECT *from studens where email=:email and password=:password';
    
        $statement=$pdo->prepare($query);
    
        $statement->execute([
            ':email'=>$email,
            ':password'=>$password,
        ]);
    
        $result=$statement->fetchAll();

        return  count($result)==1 ? true : false;
    }
}

function getStudent($email){

 global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query="SELECT id,photo,name,bio,password FROM  studens WHERE email=:email";

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':email'=>$email
        ]);

         return $statement->fetchAll();
    }

}

function getInstructor($email){

 global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query="SELECT id,photo_instructor FROM  instructor WHERE email=:email";

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':email'=>$email
        ]);

         return $statement->fetchAll();
    }

}


function getCourseInstructor($id){
     global $pdo;
    

    
        $query='SELECT *from course WHERE instructor_id=:instructor_id';

        $statement=$pdo->prepare($query);

        $statement->execute([
            'instructor_id'=>$id,
        ]);

         return $statement->fetchAll();
    
}

function updateCourse($id,$title, $desc, $price,$photo)
{
    global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query='UPDATE course set title=:title, description=:description, price=:price,creation_date=:creation_date, photo=:photo where id=:id';

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':id'=>$id,
            ':title'=>$title,
            ':description'=>$desc,
            ':price'=>$price,
            ':creation_date'=>date("Y-m-d H:i:s"),
            ':photo'=>$photo,
            
        
        ]);

    }
}

function deleteCourse($id)
{
    global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query='DELETE from course  where id=:id';
        $statement=$pdo->prepare($query);

        $statement->execute([
            ':id'=>$id
        ]);
    }
}

function addComment($course_id, $student_id, $content)
{
 global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
          $query="INSERT INTO comments (course_id,student_id,content,created_at) values(:course_id,:student_id,:content,:created_at)";

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':course_id'=>$course_id,
            ':student_id'=>$student_id,
            ':content'=>$content,
            ':created_at'=>date("Y-m-d H:i:s"),
            
        ]);
 
}
}

function getcommentaire($id){
    global $pdo;
    

    
        $query='SELECT *from comments where course_id=:course_id';

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':course_id'=>$id
        ]);

        $result= $statement->fetch();
          return  count($result)==1 ? true : false;
}

function getstudentcommented(){
global $pdo;
    
    
        $query='SELECT comments.content, studens.name, studens.photo,comments.course_id,studens.id,comments.id AS comment_id  from studens
         INNER JOIN comments ON studens.id=comments.student_id 
         INNER JOIN course ON course.id=comments.course_id 
         ORDER BY comments.created_at DESC';

        $statement=$pdo->prepare($query);

        $statement->execute();

         return $statement->fetchAll();
    
}



function checkFavoritCourses($course_id,$student_id){

  global $pdo;
    
    
        $query='SELECT *from bascket where course_id=:course_id AND student_id=:student_id';
               

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':course_id'=>$course_id,
            ':student_id'=>$student_id,
        ]);

        $result= $statement->fetchAll();

         return  count($result)==1 ? true : false;

}

function deleteComment($id){
  global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query='DELETE from comments where id=:id';
        $statement=$pdo->prepare($query);

        $statement->execute([
            ':id'=>$id
        ]);
    }

}


function updateStudent($name, $email, $password,$photo,$bio)
{
    global $pdo;
    if(!$pdo)
    {
        echo 'error conexion';
    }
    else{
        $query='UPDATE studens set name=:name, email=:email, password=:password, photo=:photo, bio=:bio where email=:email';

        $statement=$pdo->prepare($query);

        $statement->execute([
            ':name'=>$name,
            ':email'=>$email,
            ':password'=>$password,
            ':photo'=>$photo,
            ':bio'=>$bio,
            
        
        ]);

    }
}
