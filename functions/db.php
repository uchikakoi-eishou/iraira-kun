<?php
    $mysqli = new mysqli("localhost", "iraira-kun", "aaamukatsuku", "iraira-kun");
    if($mysqli->connect_errno){
        printf("接続失敗: %s\n", $mysqli->connect_error);
        exit();
    }
