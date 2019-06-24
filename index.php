<?php

require("functions.php");

var_dump($_POST);

if(isset($_POST)){
  if(empty($_POST["gender"])){
    $gender_alert = "<script type='text/javascript'>alert('性別を選択してください。');</script>";
    echo $gender_alert;
  }else{
    try {
        $sql = "SELECT url FROM unit WHERE church_id=:church_id;";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':church_id',$_POST["church"]);
        $stmt->execute();
        $church_url = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    var_dump($church_url);
    header("Location:./churchs/".$church_url["url"].".php");
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">

    <title>Hello, ACC!</title>
  </head>
  <body>
    <div style="margin:30px" class="center">
      <h2>🌟ACC 教会対抗お祈りグランプリ🌟</h2>
      <h4>あなたの教会と性別を選択してください。</h4><br>
      <form action="./index.php" method="post" class="center">
        <script>
          var churchs= [
            '聖音', '主信仰(仙台/山形)', '始音', '埼玉主バンソク', '千葉愛', '東京主信仰', '主新和',
            '主真愛','天運','主の帆','ヒマンピ','天聖','横浜主真理','名古屋 主の栄光','北陸支部',
            '京都愛火','大阪主愛','徳島支部','主聖霊','神戸主の心','岡山 主希望','広島 主平和',
            '松山 主恵城','埠頭','大分支部','熊本 明火','鹿児島支部','長崎 主多雲','沖縄 聖陽'
          ];
          var opt ='<select name="church">\n';
            for(var i=0; i<churchs.length; i++){
              opt +='<option value="'+(i+1)+'">'+churchs[i]+'教会</option>\n';
            }
          opt +='</select>';
          document.write(opt);
        </script>
        <br><br>
        <label><input type="radio" name="gender" value="man">男</label>
        <label><input type="radio" name="gender" value="woman">女</label>
        <br><br><input type="submit" class="btn btn-success" value="あなたの教会専用PageへGo!">
      </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
