<?php
	session_start();
	require 'db.php';
	if($_SESSION['log_in'] == 1 && isset($_SESSION['id'])){
    $id=$_SESSION['id'];
	}
	$ques=$_SESSION['question'];
	$res_ans=$mysql->query("select answer from questions where sno='$ques'");
  	if($res_ans->num_rows!=0){
      while ($row1 = $res_ans->fetch_assoc()) {
     $ans= $row1['answer'];
     }
  }
  if(isset($ans)){
        $ans=strtolower($ans);
        if($ans == $_GET['a']){
        	$res_query=$mysql->query("update  users set solved = '$ques' where enrollid='$id'") or die("SQL Error + '$mysql->error'");
        	if($res_query)
        	echo 'Success';
        	else
        		echo 'Database Error!!';
       }else
        	echo 'Wrong Answer';
  }else
      echo 'Well Done You Made It';
?>