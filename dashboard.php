<?php
session_start();
require 'db.php';
if($_SESSION['log_in'] == 1 && isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    
   $res_ques_sol=$mysql->query("select solved from users where enrollid='$id' ");
  if($res_ques_sol->num_rows!=0){
      while ($row1 = $res_ques_sol->fetch_assoc()) {
   $solved= $row1['solved']."<br>";
     }
  }
  $solve = (int)$solved + 1;
  $_SESSION['question']=$solve;
     $res_img_path=$mysql->query("select * from questions where sno='$solve'") or die();
     if($res_img_path->num_rows!=0){
     while ($row = $res_img_path->fetch_assoc()) {
     $path= $row['img_path']."<br>";
     }}
    if(isset($path))
    $path= str_replace("<br>","", $path);
   }
else
{
    ob_start();
    header('Location: '.'login.php');
    ob_end_flush();
    die();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap-index.css" type="text/css">
    <link rel="stylesheet" href="css/style-dashboard.css" type="text/css">
<script>
function checkAnswer() {
	str=document.getElementById("ans").value;
    if (str == "") {
        document.getElementById("output").innerHTML = "Fill In The Box First";
        return;
    } else { 
          document.getElementById('submit_btn').innerHTML='<div class="loader"></div>';
          document.getElementById("submit_btn").disabled = true;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('submit_btn').innerHTML='Submit';
                  document.getElementById("submit_btn").disabled = false;
                document.getElementById("output").innerHTML = this.responseText;
                if(this.responseText == 'Success'){
                  document.getElementById('cont_output').style.backgroundColor = '#2fb229';
                	location.reload();
                }else{
                  document.getElementById('cont_output').style.backgroundColor = '#ff1a1a';
                }
                setTimeout(function(){ 
                console.log("timeout");
                document.getElementById("cont_output").style.backgroundColor = '#ffffff'; 
                  }, 
                  6000);
            }
        };
        xmlhttp.open("GET","check.php?a="+str,true);
        xmlhttp.send();
    }
}
document.addEventListener("contextmenu", function(e){
    e.preventDefault();
}, false);
</script>


</head>

<body oncontextmenu="return false;">
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
          <div class="btn-group btn-group-lg">
            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <?php echo $id ?> </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="leaderboard.php" target="blank">LeaderBoard</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <?php 
          if(!isset($path))
          	$path='finished.jpeg';
         // echo '<img class="img-fluid d-block" src="'.$path.'" alt="Cover">'; 
          echo '<div style="background-image: url(img/'.$path.'); height: 200px; width: 600px;background-size: contain; background-repeat:no-repeat;"></div>';
          ?>
      </div>
      <div class="col-md-3"></div>
      <br>
      <br> </div>
  </div>
  <div class="py-5" id="cont_output">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
          <div>
            <h4 id="output"></h4>
          </div>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>
  <div class="py-5 text-white bg-primary text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p class="lead mb-4">Submit Your Answer</p>
          <form class="form-inline justify-content-center" onsubmit="checkAnswer();return false;">
            <div class="input-group my-1">
              <input  type="text" class="form-control mr-3 my-1" placeholder="Answer" id="ans" autocomplete="off" required> </div>
            <button  type="button" class="btn btn-secondary" id="submit_btn" onclick="checkAnswer()" >Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="js/jquery-3.2.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>
