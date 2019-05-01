<?php
    $a = 1;

    if(isset($_POST['a'])){
        $a = $_POST['a'];
    }
    if(isset($_POST['plus'])){
        $a++;
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

<a href="" type="button">ログインして記録</a>
<a href="" type="button">新規登録して記録</a>

</body>
</html>
