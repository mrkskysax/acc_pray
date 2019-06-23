<?php

  try {

      // データベースに接続
      $pdo = new PDO(
          'mysql:dbname=testDB;host=localhost;charset=utf8',
          'root',
          'root'
      );
      echo "success connecting DB";

  } catch (PDOException $e) {
      /* エラー時は、とりあえず、エラーメッセージを表示 */
      echo "DB Error";
      echo $e->getMessage();
      exit;
  }

?>
