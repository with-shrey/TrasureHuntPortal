<?php
require 'db.php';
session_start();
$message="";
if($_SERVER['REQUEST_METHOD']=='POST'){
 if(isset($_POST['submit'])){
 $enroll_id=str_replace(" ","",$_POST['er_id']);
 $dname=$_POST['dname'];
$enroll_id=strtoupper($enroll_id);   //TODO:error beutify


   if(preg_match('/^[1-1][4-7][1-1]/', $enroll_id) && strlen($enroll_id)>=6 && strlen($enroll_id)<=7 && strlen($dname)>0 && strlen($dname) <=15){
    $stmtins = $mysql->prepare("insert into users values(?,?,'0')");
    $stmtins->bind_param('ss', $enroll_id,$dname);
    $stmtins->execute();

    $res = $stmtins->get_result();
    $_SESSION['log_in']=1;
    $_SESSION['id']=$enroll_id;
    $stmtins->close();
    ob_start();
    header('Location: '.'dashboard.php');
    ob_end_flush();
    die();
   }else{

    $message = "Enrollment Not Valid";
    session_unset();
    session_destroy();
   }

 }}

?>
<!DOCTYPE html>
<html >
<head>

	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <meta charset="UTF-8">
  <title>Login To Hunt</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  
  <link rel='stylesheet prefetch' href="css/opensans.css">

      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/nav.css">
  
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
        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input name='dname' type="text" class="login__input name" placeholder="Display Name" required autocomplete="off" pattern=".{1,15}" title="Maximum 10 Characters Allowed"/>
        </div>
        <button style="background-color: #5F9EA0;" type="submit" name="submit" class="login__submit">Submit</button>
      </div>
  	</form>
    </div>
  </div>
</div>

  <script src='css/jquery-3.2.1.slim.min.js'></script>
</body>
</html>
