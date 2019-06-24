<?php

require("../functions.php");

var_dump($_POST);

try {
    $sql = "SELECT * FROM unit;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

if(isset($_POST)){
  $now_unit = $result["unit"]-$_POST["unit"];

  try {
      $sql = "UPDATE unit SET unit=:unit WHERE church_id=:church_id";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':church_id',0);
      $stmt->bindParam(':unit',$now_unit);
      $stmt->execute();
  } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
  }

  try {
      $sql = "SELECT * FROM unit WHERE church_id=:church_id;";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':church_id',7);
      $stmt->execute();
      $unit_check = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
  }

  if(!empty($unit_check)){
    try {
        $sql = "UPDATE unit SET unit=unit+:unit WHERE church_id=:church_id;";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':church_id',7);
        $stmt->bindParam(':unit',$_POST["unit"]);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }

    try {
        $sql = "SELECT unit FROM unit WHERE church_id=:church_id;";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':church_id',7);
        $stmt->execute();
        $your_unit = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }

  }else{
    try {
        $sql = "INSERT INTO unit(church_id,unit) VALUES(:church_id,:unit);";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':church_id',7);
        $stmt->bindParam(':unit',$_POST["unit"]);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
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
    <link rel="stylesheet" href="../css/style.css">

    <title>Hello, ACC!</title>
  </head>
  <body>
    <div style="margin:30px">
      <h1 class="center">あなたは<strong>主新和教会</strong>の<strong>男性</strong>新婦です。</h1>
      <h4 class="center"><span style="font-size:3em;"><?php echo $your_unit["unit"];?></span>単位達成中！</h4>
      <form action="" method="post" class="center">
        <h6>3分を１単位として, お祈りした単位数を入力した後, 投票ボタンを押してください。</h6>
        <h6>全国目標は400単位(1200分)です。</h6>
        <h6>残りは<span style="font-size:2em;"><?php echo $now_unit;?></span>単位です。</h6>
        <input type="text" class="center" name="unit" style="width:110px;" id="unit" placeholder="単位数入力" value="<?php echo xss($_POST["unit"]);?>"> 単位<br>
        <input type="submit" value="投票する" class="btn btn-info" name="add" onclick="return confirm_test()"　style="width: 500px; height:100px">
        <div id="popup" style="width: 350px;display: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
            目的を成した生を生きなさい。<br />
            <button id="ok" onclick="okfunc()">OK</button>
            <button id="no" onclick="nofunc()">キャンセル</button>
        </div>
      </form>
      <h3 class="center" >教会ランキング！</h3>
      <p class="center" >貢献率[%]＝１教会で祈った総単位数/１教会CP全体の総担当数 により算出しています。</p>
      <canvas id="myBarChart"></canvas>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script>
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
          type: 'horizontalBar',
          data: {
            labels: [
              '聖音', '主信仰(仙台/山形)', '始音', '埼玉主バンソク', '千葉愛', '東京主信仰', '主新和',
              '主真愛','天運','主の帆','ヒマンピ','天聖','横浜主真理','名古屋 主の栄光','北陸支部',
              '京都愛火','大阪主愛','徳島支部','主聖霊','神戸主の心','岡山 主希望','広島 主平和',
              '松山 主恵城','埠頭','大分支部','熊本 明火','鹿児島支部','長崎 主多雲','沖縄 聖陽'
            ],
            datasets: [
              {
                label: 'お祈り貢献率',
                data: [1, 2, 3, 4, 5, 6, <?php echo $your_unit["unit"]; ?>,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29],
                backgroundColor: "rgba(219,39,91,0.5)"
              }
            ]
          },
          options: {
            title: {
              display: true,
              text: '教会別 貢献率'
            },
            scales: {
              yAxes: [{
                ticks: {
                  suggestedMax: 100,
                  suggestedMin: 0,
                  stepSize: 10,
                  callback: function(value, index, values){
                    return  value + '教会'
                  }
                }
              }]
            },
          }
        });
    </script>
    <script type="text/javascript" src="../js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
