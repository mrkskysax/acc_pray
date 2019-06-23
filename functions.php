<?php

  try {

      // データベースに接続
      $db = new PDO(
          'mysql:dbname=accDB;host=localhost;charset=utf8;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
          'root',
          'root'
      );
      //echo "success connecting DB";

  } catch (PDOException $e) {
      /* エラー時は、とりあえず、エラーメッセージを表示 */
      echo "DB Error";
      echo $e->getMessage();
      exit;
  }

  function xss($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
  }

?>
