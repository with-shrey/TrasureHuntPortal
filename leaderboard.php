<?php
session_start();
require 'db.php';
if($_SESSION['log_in'] == 1 && isset($_SESSION['id'])){	
$id=$_SESSION['id'];
}else{
	ob_start();
    header('Location: '.'index.php');
    ob_end_flush();
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
	   <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
	  <link rel="stylesheet" href="css/bootstrap-index.css" type="text/css">
	  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/nav.css">

	<title>LeaderBoard-Hunt For Tresor</title>
</head>
<body>
  <ul>
    <li style="float:left;"><img src="img/mozguna.gif" height="60px" width="60px"></li>
  <li  style="float:left;font-family: pieces_of_eightregular; margin-left: 30% ;font-size:45px;"><span>WAR FOR TRESOR</span></li>
    <li><a class="active" href="logout.php">LOGOUT</a></li>
  <li><a href="#" class="active" style="background-color:#34495e;cursor:not-allowed;"><?php echo $id; ?></a>

  <li><a class="active" style="background-color:#1abc9c;cursor:help;" href="https://www.facebook.com/JuetFirefoxClub/" target="_blank">HINTS</a></li>
  <li><a class="active" style="background-color:#3498db;" href="dashboard.php">QUESTIONS</a></li>

</ul>
<br>
<br>
	<div class="container">
		<div class ="row">
			<div class="col-md-12">
			<table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>Rank</th>
      <th>Enrollment Number</th>
      <th>Name</th>
      <th>Score</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $rank=0;
    
    $prev=0;
    $res_score=$mysql->query("select * from users order by solved DESC");
  if($res_score->num_rows!=0){
      while ($row = $res_score->fetch_assoc()) {
      	if($row['enrollid'] === $id)
      		$attr='class=danger';
      	else $attr='';
      	if($prev != $row['solved'] )
      		$rank++;
   		$prev=$row['solved'];
   		echo'<tr '.$attr.'>
      <th scope="row">'.$rank.'</th>
      <td>'.$row['enrollid'].'</td>
      <td>'.$row['dname'].'</td>
      <td>'.$row['solved'].'</td>
    </tr>';
     }
  }
      
    
    ?>
  </tbody>
</table>
</div>
		</div>
	</div>
	<script src="js/jquery-3.2.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
