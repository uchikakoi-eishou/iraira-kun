<?php
    $mysqli = new mysqli("localhost", "iraira-kun", "aaamukatsuku", "iraira-kun");
    if($mysqli->connect_errno){
        printf("接続失敗: %s\n", $mysqli->connect_error);
        exit();
    }

    $a = 1;
    if(isset($_POST['a'])){
        $a = $_POST['a'];
    }
    if(isset($_POST['plus'])){
        $a++;
    }
    if(isset($_POST['count_data'])){
        $count_data = htmlspecialchars($_POST['count_data'], ENT_QUOTES);
        if(!empty($count_data)){
            $result = mysqli_query($mysqli, "insert into iraira_data(count_data) values('$count_data')");
            header("localhost");
        }
    }
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>iraira-kun</title>
</head>
<body>

<form action="" method="POST">
     <input type="hidden" name="a" value="<?=$a?>">
     <input type="submit" name="plus" value="iraira">
</form>
<p><?=$a?></p>

<form action="" method="POST">
     <input type="hidden" name="count_data" value="<?=$a?>">
     <input type="submit" name="" value="記録する">
</form>

<?php
    $iraira_data = "select * from iraira_data order by id DESC";
    $iraira_data = mysqli_query($mysqli, $iraira_data);
    while($iraira_data_array = mysqli_fetch_assoc($iraira_data)){
        echo $id = $iraira_data_array["id"];
        echo ",";
        echo $count_data = $iraira_data_array["count_data"];
        echo ",";
        echo $reg_date = $iraira_data_array["reg_date"];
        echo "<br>";
    }
?>

<!-- <a href="" type="button">ログインして記録</a> -->
<!-- <a href="" type="button">新規登録して記録</a> -->

</body>
</html>
