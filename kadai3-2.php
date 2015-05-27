<?php
session_start();
?>

<?php
	$db_user="yuri";
	$db_pass="yuri0929";
	$db_name="yuri";

	$mysqli=new mysqli("localhost",$db_user,$db_pass,$db_name);
	$result=$mysqli->query("SELECT*FROM `kadai3` LIMIT 0,30");
	$row=$result->fetch_assoc();
?>

<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>掲示板</title>
  <link type="text/css" rel="stylesheet" href="./kadai3.css">
</head>

<body>
  <div id="ccontainer">
  <div id="header"><font size=5>掲示板ページ(ログイン後)</font>
  </div>
  <div id="content">
    <div id="leftbox">
      <p>ログイン</p>
      <?php
      if(empty($_SESSION['login'])){
        if(!empty($_POST['password'])){
          $password="hoge";
          $input_pass=$_POST['password'];

          if($password==$input_pass){
            echo "ログイン中";
            $_SESSION['login'] = "ログイン中";
            echo '<form action="kadai3-3.php" method="post">
            <input type="hidden" name="flag" value="logout"/>
            <input type="submit" velue="ログアウト" />
            </form>';
          }else{
            echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=kadai3-1.php">';
          }
        }else{
          echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=kadai3-1.php">';
        }
        }else{
          echo "ログイン中";
          echo '<form action="kadai3-3.php" method="post">
				<input type="hidden" name="flag" value="logout"/>
				<input type="submit" value="ログアウト" />
				</form>';
        }
      ?>

      <HR>


      <p>書き込み</p>
      <form action="kadai3-2.php" method="post" enctype="multipart/form-data">
        <p>名前<input type="text" name="name"/></p>
        <p>コメント<input type="text" name="comment"/></p>
				<p><label for="upload">画像のアップロード</label>
				<input type="file" name="upfile" size="30" id="upload"></p>
        <input type="submit"/>
      </form>

			<HR>

      <?php

			if(!empty($_POST['name'])&&!empty($_POST['comment'])){
			if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
				$newfilename= date("Ymd-His")."-".$_FILES['upfile']['name'];
				if (move_uploaded_file ($_FILES["upfile"]["tmp_name"], "files/" .date("Ymd-His") . $_FILES["upfile"]["name"])) {
					chmod("files/" . date("Ymd-His") . $_FILES["upfile"]["name"], 0644);
					echo $_FILES["upfile"]["name"] . "をアップロードしました。";
					$mysqli->query("INSERT INTO `kadai3` (`comment`,`file`,`name`)
					VALUES ('".$_POST['comment']."','".$newfilename."','".$_POST['name']."')");
				} else {
					echo "ファイルをアップロードできません。";
				}
			} else { //画像アップロードなしの場合
				$mysqli->query("INSERT INTO `kadai3` (`comment`,`name`)
				VALUES ('".$_POST['comment']."','".$_POST['name']."')");
			}
}

      ?>

    </div>

    <div id="main">
      <h1>掲示板</h1>
			<form action="kadai3-2.php" method="post">
				<input type="text" name="search">
				<input type="submit" value="検索">
			</form>

			<form action="kadai3-2.php" method="post">
				<select name="syoukou">
						<option value="syou">昇順</option>
						<option value="kou">降順</option>
						<input type="submit">
					</select>
			</form>

			<HR>


			<?php
			//コメントを削除
			if(!empty($_POST['del'])){ //削除ボタンを押されたら実行
			$mysqli->query("DELETE FROM `kadai3` WHERE `id`=".$_POST['del']);
			}

			//コメント編集
			if(!empty($_POST['id2'])&&!empty($_POST['name2'])&&!empty($_POST['comment2'])){
				$mysqli->query("UPDATE kadai3 set name='".$_POST['name2']."',
				comment='".$_POST['comment2']."' WHERE id=".$_POST['id2']);
			}
			$sql = "SELECT*FROM `kadai3`LIMIT 0,30";

			//検索
			if(!empty($_POST['search'])){
			$sql="SELECT * FROM `kadai3` WHERE comment LIKE "%$_POST['search']%"";
			var_dump($sql);
			}


			//ソート
			if(!empty($_POST['syoukou'])){
				if($_POST['syoukou']=="syou"){
					echo "昇順です";
				$sql = "SELECT*FROM `kadai3`ORDER BY `id` ASC";
			}else{
				echo "降順です";
				$sql = "SELECT*FROM `kadai3`ORDER BY `id` DESC";
			}
			}
			?>



			<?php	foreach ($mysqli->query($sql) as $key=>$value): ?>
				
			<form action="kadai3-2.php" method="post">
      <?php	echo $value['id']; ?>:
			<?php echo $value['name'];?>,
			<?php echo $value['comment'];?>
			<?php echo $value['timestamp']; ?>
			<?php var_dump( $value['file']);
			$name = "43513234.jpeg";
			?>
			<img src="./files/20150526-130324100502.jpg">

			<img src="./files/<?php echo $name?>">
			<input type="hidden" name="del" value=<?php echo $value['id']; ?>><br />
			<input type="submit" value="削除">
			</form>
			<form action="kadai3-4.php" method="post">
				<input type="hidden" name="id2" value=<?php echo $value['id']; ?>>
				<input type="hidden" name="name2" value=<?php echo $value['name']; ?>>
				<input type="hidden" name="comment2" value=<?php echo $value['comment']; ?>>
				<input type="submit" value="編集">
			</form>
		<?php endforeach; ?>

    </div>

  </div>

  <div id="fooder">
    <p>フッダーだよ</p>
  </div>
</div>
</body>
</html>
