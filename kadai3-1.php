<?php
session_start();
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
  <div id="header"><font size=5>掲示板ページ</font>
  </div>
  <div id="content">
    <div id="leftbox">
      <p>ログイン</p>
      <?php
      if(empty($_SESSION['login'])){
        echo '<form action="kadai3-2.php" method="post">
        <label for="key" accesskey="p">パスワード</label>
        <input type="password" name="password" id="key"/>
        <input type="submit"/>';
      }else{
        echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=kadai3-2.php"/>';
      }
      ?>
    </div>

    <div id="main">
      <h1>掲示板</h1>
    </div>

  </div>

  <div id="fooder">
    <p>フッダーだよ</p>
  </div>
</div>
</body>
</html>
