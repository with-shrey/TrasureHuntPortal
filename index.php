<!DOCTYPE html>
<html>
<head>
	<title>War for Tresor</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="all" href="css/mainpage.css">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
    var fontSize = parseInt($("#anchor").width());
    var winWidth=$(window).width();
    var temp=winWidth*100/fontSize;
    $("#anchor").css('font-size', temp+"%");
});
	</script>
</head>
<body style="background-image: url(img/front.jpg);">
<a href="login.php" id="anchor" >
	Up for Hunt?
  <i></i>
</a>

</body>
</html>