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


	<title></title>
</head>
<body>
	<div class="container">
		<div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
          <div class="btn-group btn-group-lg">
            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <?php echo $id ?> </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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