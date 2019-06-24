<?php

  try {

      // データベースに接続
      $db = new PDO(
          'mysql:dbname=accDB;host=localhost;charset=utf8;unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock',
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

  $churchs = array(
    '聖音', '主信仰(仙台/山形)', '始音', '埼玉主バンソク', '千葉愛', '東京主信仰', '主新和',
    '主真愛','天運','主の帆','ヒマンピ','天聖','横浜主真理','名古屋 主の栄光','北陸支部',
    '京都愛火','大阪主愛','徳島支部','主聖霊','神戸主の心','岡山 主希望','広島 主平和',
    '松山 主恵城','埠頭','大分支部','熊本 明火','鹿児島支部','長崎 主多雲','沖縄 聖陽'
  );

  for($i=1;$i<=count($churchs);$i++){
    try {
        $sql = "INSERT INTO unit(church_id,unit,church_name) VALUES(:church_id,:unit,:church_name);";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':church_id',$i);
        $stmt->bindValue(':unit',0);
        $stmt->bindParam(':church_name',$churchs[$i-1]);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
  }


?>
