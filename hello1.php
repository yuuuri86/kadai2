<!doctype html>
<html>
 <head>
  <meta charset="UTF-8">
  <title>てすとだよー</title>
 </head>
 <body>
 	<form action = "hello1.php" method="POST">
 		<input type="text" name="jikan">
 		<input type="submit">
 	</form>
 	<?php
 	if(isset($_POST['jikan'])){
	 	$jikan = $_POST['jikan'];
	 	if($jikan == "朝" ){
	 		echo "good morning";
	 	}elseif($jikan == "夜"){
	 		echo "good night";
	 	}else{
	 		echo "hello";
	 	}
	 }
 	?>
 	<ul>
 		<li>第１回課題 2015/04/21</li>
 		<ul>
	 		<li>課題a <a href = "#">test</a></li>
	 		<li>課題b <a href = "#">test</a></li>
 		</ul>
 	</ul>
 </body>
</html>