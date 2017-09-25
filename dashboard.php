<?php
session_start();
require 'db.php';
if($_SESSION['log_in'] == 1 && isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    
   $res_ques_sol=$mysql->query("select solved from users where enrollid='$id' ");
  if($res_ques_sol->num_rows!=0){
      while ($row1 = $res_ques_sol->fetch_assoc()) {
   $solved= $row1['solved'];
     }
  }
  $solve = (int)$solved + 1;
  $_SESSION['question']=$solve;
     $res_img_path=$mysql->query("select * from questions where sno='$solve'") or die();
     if($res_img_path->num_rows!=0){
     while ($row = $res_img_path->fetch_assoc()) {
     $path= $row['img_path'];
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
<html >
<head>
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <meta charset="UTF-8">
  <title>Questions-War For Tresor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
      <link rel="stylesheet" href="css/nav.css">
      <link rel="stylesheet" href="css/style-dash.css">
<script>
  function redirectLeaderBoard(){

    document.location.href='leaderboard.php';
  }
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
                 var res= this.responseText;
		var response=parseInt(res)
                if(response === 1){
                  document.getElementById("output").innerHTML="Success";
                  document.getElementById('output').style.color = '#80ff80';
                  location.reload();
                }else if( response === 0){
                  document.getElementById("output").innerHTML="Wrong Answer";
                  document.getElementById('output').style.color = '#ff3333';
                }else{
                  document.getElementById("output").innerHTML="Database Error !!";
                  console.log(response);
                  document.getElementById('output').style.color = '#ff3333';
                }
                setTimeout(function(){ 
                console.log("timeout");
                document.getElementById("output").style.color = 'transparent'; 
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

<body style="background-image: url(img/bg.jpg);background-repeat: no-repeat;background-size: cover;" oncontextmenu="return false;">
  <ul>
    <li style="float:left;"><img src="img/mozguna.gif" height="60px" width="60px"></li>
  <li  style="float:left;font-family: pieces_of_eightregular; margin-left: 30% ;font-size:45px;"><span>WAR FOR TRESOR</span></li>
    <li><a class="active" href="logout.php">LOGOUT</a></li>
  <li><a href="#" style="background-color:#34495e"><?php echo $id; ?></a>

  <li><a style="background-color:#1abc9c;" href="https://www.facebook.com/JuetFirefoxClub/" target="blank">HINTS</a></li>
  <li><a style="background-color:#3498db;" href="leaderboard.php" target="blank">SCORE</a></li>

</ul>
  <div class="cont">
  <div class="demo">
    <div class="login">
      <div class="login__check"></div>
      <div >
        <?php 
          if(!isset($path))
            $path='finished.jpeg';
          echo '<img src="img/'.$path.'" height="350px" width="350px" style="margin:1% 35% 45% 35%;" />'; 
 
          ?>
      </div>
      <form onsubmit="checkAnswer();return false;">
      <div class="login__form">
      
        <div class="login__row">
          
          <?php
          if($path != 'finished.jpeg'){
          echo '<svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>';
          echo '<input id="ans" type="text" class="login__input pass" placeholder="Khul Jaa Sim SIm" autocomplete="off" required/>';
        }
          ?>
        </div>
        <div id="output" style="font-size:20px; color: white; height: 30px;"></div>
        <?php 
          if($path == 'finished.jpeg')
            echo '<button id="submit_btn" type="button" class="login__submit" onclick="redirectLeaderBoard()">LeaderBoard</button>';
          else
            echo '<button id="submit_btn" type="button" class="login__submit" onclick="checkAnswer()">Submit Answer</button>';
         ?>
      </div>
      </form>
    </div>
  </div>
</div>

    

</body>
</html>
