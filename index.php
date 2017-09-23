<?php
require 'db.php';
session_start();
$message="";
if($_SERVER['REQUEST_METHOD']=='POST'){
 if(isset($_POST['submit'])){
 $enroll_id=str_replace(" ","",$_POST['er_id']);
$enroll_id=strtoupper($enroll_id);   //TODO:error beutify


   if(preg_match('/^[1-1][4-7][1-1]/', $enroll_id) && strlen($enroll_id)>=6 && strlen($enroll_id)<=7){
  $res=$mysql->query("insert into users values('$enroll_id','0')"); //or die($mysql->error);
    $_SESSION['log_in']=1;
    $_SESSION['id']=$enroll_id;
     
    ob_start();
    header('Location: '.'dashboard.php');
    ob_end_flush();
    die();
   }else{

    $message = "Wrong Enrollment Number";
    session_unset();
    session_destroy();
   }

 }}
 
 
 
 
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
 <link rel="stylesheet" href="css/bootstrap-index.css" type="text/css">
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
</head>

<body>        

  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3"> </div>
        <div class="col-md-6">
          <div class="card p-5 bg-warning text-dark">
            <div class="card-body">
              <h1 class="mb-4">Treasure Loot</h1>
              <?php echo $message; //error message
              ?> 
              <form action="index.php" method="POST">
                <div class="form-group"> <label>Enrollment Number</label>
                    <input type="text" class="form-control" name="er_id" placeholder="Enrollment Number" required autocomplete="off" pattern=".{6,7}" title="Min 6 Character & Max 7 Characters"> </div>
                <button type="submit" name="submit" class="btn btn-secondary">Submit</button>
              </form>
            </div>
          </div>
          <p>JavaScript Is Required For your Answer To Submit!!</p>
        </div>
      </div>
    </div>
  </div>
 <script src="js/jquery-3.2.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>