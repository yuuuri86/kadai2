<?php
session_start();

if($_POST['flag']=="logout"){
	$_SESSION=array(); //初期化
	session_destroy();
}

?>

<META HTTP-EQUIV="Refresh" CONTENT="1; URL=kadai3-1.php" />
logouting…
