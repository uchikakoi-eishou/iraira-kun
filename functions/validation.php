<?php
//メールアドレスチェック
    function mailcheck($mail){
        if(preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $mail)){
                return 'true';
        }else{
                return 'false';
        }
    };
