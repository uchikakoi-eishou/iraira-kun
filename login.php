	
<?php
	session_start();
	require_once "header.php";				//ヘッダー
	require_once "functions/db.php";		//DB接続
	require_once "functions/validation.php"	//バリデーション

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		
		//メールアドレスとパスワードを受け取ります。
		$mail = htmlspecialchars($_POST['mail'], ENT_QUOTES);
		$password = htmlspecialchars($_POST['password'], ENT_QUOTES);

	}


			
						
	// 	//メールアドレスが空じゃなかったら、、
	// 	if(!empty($mail)){
	// 		//バリデーションチェックを実行。
	// 		$mailresult = mailcheck($mail);
	// 	}else{
	// 		//空だったら$mailresultにfalseを入力。
	// 		$mailresult = "false";
	// 	};
			
	// 	//メールアドレスに特に問題なければ、、、
	// 	if($mailresult == "true"){
			
	// 		//データベースからメールアドレスを起点にデータを呼び出します。
	// 		$userdataEdit = "select * from user_data where mail = '".$mail."' order by id DESC"; 
	// 		$userdataEdit = mysqli_query($mysqli,$userdataEdit);
			
	// 		//ユーザーのデータを呼び出していきます。
	// 		while ($userdataEditArray = mysqli_fetch_assoc($userdataEdit)) {
	// 			$userid = $userdataEditArray["id"];
	// 			// $name = $userdataEditArray["name"];
	// 			// $age = $userdataEditArray["age"];
	// 			// $skill = $userdataEditArray["skill"];
	// 			$mail = $userdataEditArray["mail"];
	// 			$hashpass = $userdataEditArray["password"];
	// 		};
	// 	};
			
	// 	//入力されたパスワードと暗号化されたパスワードを比較。
	// 	if(password_verify($_POST['password'], $hashpass)){
	// 		//もし一致したら、trueを返します。
	// 		$passresult = "true";
	// 	}else{
	// 		//一致しなければ、falseを返します。
	// 		$passresult = "false";
	// 	};
			
	// 	//メールアドレスとパスワード、ともに問題なければ、、
	// 	if($mailresult!=="false"&&$passresult!=="false"){
	// 		//セッションにtrueを入れてログイン済みの印を残します。
	// 		//セッションにtrueが保存されていればログイン済み、という意味です。
	// 		$_SESSION["login_pass"] = "true";
	// 		//よく利用するuseridも別のセッションに保存しておきましょう。
	// 		$_SESSION["userid"] = $userid;
	// 		//ログインが成功したら、ログイン完了メッセージと名前を表示。
	// 		echo $mail."さんログイン完了<br>";
	// 	};
				    
	// };

?>
		
<h2>ログインフォーム</h2>

<form method="post" action="">	
	<input type="text" name="mail" placeholder="メールアドレス" value="" /><br/>
	<!--もし$mailresultがfalseの場合はエラー表示。-->
	<!-- <?php if($mailresult == "false"){echo "メールアドレスにエラーがあります。<br/>";}; ?> -->
	<input type="password" name="password" placeholder="パスワード" value="" /><br/>
	<!--もし$passresultがfalseの場合はエラー表示。-->
	<!-- <?php if($passresult == "false"){echo "パスワードにエラーがあります。<br/>";}; ?> -->
	<input type="submit" name="loginBtn" value="ログイン" />
</form>	
	
<!-- <?php
		
	//投稿データ一覧
	$userdata = "select * from user_data order by id DESC"; 
	$userdata = mysqli_query($mysqli,$userdata);
		
	while ($userdataArray = mysqli_fetch_assoc($userdata)) {
	    echo $id = $userdataArray["id"];
	    echo ",";
		echo $name = $userdataArray["mail"];
		echo ",";
		echo $age = $userdataArray["password"];
		echo "<br>";
	};
		
?> -->
	
	
<script>
		
	//削除ボタン押された時
	$(".deleteBtn").click(function(){
		var btnid = $(this).data("id");
		deleteData(btnid);
	});
	
	//編集ボタン押された時
	$(".editBtn").click(function(){
		var btnid = $(this).data("id");
		window.location.href = "./?edit="+btnid;
	});
		
	//削除ボタン押された時に呼び出される関数
	function deleteData(btnid){
		$.ajax({
				type: 'POST',
				dataType:'json',
				url:'functions/delete_func.php',
				data:{
					btnid:btnid,
				},
				success:function(data) {
					window.location.href = "./";
				},
				error:function(XMLHttpRequest, textStatus, errorThrown) {
					alert(errorThrown);
				}
		});
	};
		
</script>

	
</body>
</html>