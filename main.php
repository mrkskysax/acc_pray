<?php

require("functions.php");

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
          var opt ='<select>\n';
            for(var i=0; i<churchs.length; i++){
              opt +='<option>'+churchs[i]+'教会</option>\n';
            }
          opt +='</select>';
          document.write(opt);
        </script>
        <br><br>
        <label><input type="radio">男</label>
        <label><input type="radio">女</label>
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
