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
<html >
<head>
  <meta charset="UTF-8">
  <title>Login/Logout animation concept</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  
  <link rel='stylesheet prefetch' href="css/opensans.css">

      <link rel="stylesheet" href="css/style.css">
  
</head>

<body>
  
  <div class="cont" style="background-image: url(img/front.jpg);">
  <div class="demo">
    <div class="login">
      
      <form action="login.php" method="POST">
        <div >
        <img src="img/mozguna.gif" height="220px" width="220px" style="margin-left: 12%;margin-top: 12%" />
      </div>
      <div class="login__form">
        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input name='er_id' type="text" class="login__input name" placeholder="Enrollment Number" required autocomplete="off" pattern=".{6,7}" title="Min 6 Character & Max 7 Characters"/>
        </div>
        <div style="font-size:12px; color: red;"><?php echo $message ?></div>
        <button type="submit" name="submit" class="login__submit">Submit</button>
      </div>
  	</form>
    </div>
  </div>
</div>

  <script src='css/jquery-3.2.1.slim.min.js'></script>
</body>
</html>
