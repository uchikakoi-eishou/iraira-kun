<?php
    require_once "header.php";
    require_once "functions/db.php";

    $a = 1;
    if(isset($_POST['a'])){
        $a = $_POST['a'];
    }
    if(isset($_POST['plus'])){
        $a++;
    }
    if(isset($_POST['countData'])){
        $countData = $_POST['countData'];
        if(!empty($countData)){
            $result = mysqli_query($mysqli, "insert into iraira_data(count_data) values('$countData')");
            header('Location: http://localhost');
        }
    }
?>

<form action="" method="POST">
     <input type="hidden" name="a" value="<?=$a?>">
     <input type="submit" name="plus" value="iraira">
</form>
<p><?=$a?></p>

<form action="" method="POST">
     <input type="hidden" name="countData" value="<?=$a?>">
     <input type="submit" name="" value="ログインして記録する">
</form>

<?php
    $irairaData = "select * from iraira_data order by id DESC";
    $irairaData = mysqli_query($mysqli, $irairaData);
    while($irairaDataArray = mysqli_fetch_assoc($irairaData)){
        echo $id = $irairaDataArray["id"];
        echo ",";
        echo $countData = $irairaDataArray["count_data"];
        echo ",";
        echo $regDate = $irairaDataArray["reg_date"];
        echo "<br>";
    }
?>

<!-- <a href="" type="button">ログインして記録</a> -->
<!-- <a href="" type="button">新規登録して記録</a> -->

</body>
</html>
