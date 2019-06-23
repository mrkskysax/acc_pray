<?php

require("functions.php");


try {
    $sql = "SELECT * FROM unit;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($result);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

$now_unit = $result["unit"]-$_POST["unit"];
echo $now_unit;

try {
    $sql = "UPDATE unit SET unit=:unit WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id',1);
    $stmt->bindParam(':unit',$now_unit);
    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
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

    <title>Hello, ACC!</title>
  </head>
  <body>
    <div style="margin:30px">
      <form action="" method="post">
        <h6>3分を１単位として, お祈りした単位数を入力した後, 投票ボタンを押してください。</h6>
        <h6>全国目標は400単位(1200分)です。</h6>
        <input type="text" class="form-control" name="unit" id="unit" value="<?php echo xss($_POST["unit"]);?>">単位
        <input type="submit" value="投票する">
        <h6>残りは<?php echo $now_unit;?>単位です。</h6>
      </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
