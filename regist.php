	
<?php
	require_once "header.php";
	require_once "functions/db.php";
	
	//メールアドレスが正しいメールアドレスかどうかを確認する関数です。
	function mailcheck($mail){
		//こちらの記号は正規表現と言います。
		//今回は、メールアドレスの形を表しています。
		//正規表現で$mail内に入っているデータがメールアドレスの形じゃなければfalseを返します。
		if(preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $mail)){
			 return 'true';
		}else{
			 return 'false';
		}
	};

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		//ポストされたメールアドレスとパスワードをキャッチします。
		$mail = htmlspecialchars($_POST['mail'], ENT_QUOTES);
		$password = htmlspecialchars($_POST['password'], ENT_QUOTES);
			
		//$mailが空じゃなければバリデーションチェック呼び出します。
		//空の場合は$mailresultにfalseを返します。
		if(!empty($mail)){
			$mailresult = mailcheck($mail);
		}else{
			$mailresult = "false";
		};
			
		//パスワード暗号化と空欄チェックを行います。
		if(!empty($password)){
			//パスワードは、管理者にも知られてはいけません。
			//必ず、受けとったパスワードのデータを暗号化します。
			//$passwordに文字列が入っていれば、それが暗暗号化され$hashpassに入ります。
			$hashpass = password_hash($password, PASSWORD_BCRYPT);
		};
			
		//もし暗号化されたパスワードが$hashpassになければ$passresultがfalseに。
		if(empty($hashpass)){
			$passresult = "false";
		};
			
		$userDataSql = "select * from user_data where mail = '".$mail."' order mail DESC";
		$userDataSql = mysqli_query($mysqli, $userDataSql);
		$userCount = $userDataSQL->num_rows;

		//すでにユーザーが存在していた場合はアップデート。
		//メールアドレスとパスワードが入力されていた場合に実行。
		if($userCount !== 0&&$mailresult!=="false"&&$passresult!=="false"){			
			$result = "false";
		}
			
		if($userCount == 0&&$mailresult!=="false"&&$passresult!=="false"){
			//$userCountが0だった場合は新規で登録。
			//メールアドレスとハッシュパスがあれば登録可能。
			$result = mysqli_query($mysqli,"insert into userdata(name,age,skill,mail,password) VALUES('$name','$age','$skill','$mail','$hashpass')");
			echo "新規登録完了";
		};
		    
	};

?>
		
<h1>登録フォーム</h1>
<form method="post" action="">		
	<!-- <input type="text" name="mail" placeholder="メールアドレス" value="<?php echo $mail; ?>" /><br/> -->
	<input type="text" name="mail" placeholder="メールアドレス" value="" /><br/>
	<!--もし$mailresultがfalseの場合はエラー表示。-->
	<?php if($mailresult == "false"){echo "メールアドレスにエラーがあります。<br/>";}; ?>
	<?php if($result == "false"){echo "既に登録されているメールアドレスです。<br/>";}; ?>
	<input type="password" name="password" placeholder="パスワード" value="" /><br/>
	<!--もし$passresultがfalseの場合はエラー表示。-->
	<?php if($passresult == "false"){echo "パスワードにエラーがあります。<br/>";}; ?>
	<input type="submit" name="submitBtn" value="登録" />
</form>
	
	
<?php
		
	//投稿データ一覧
	$userdata = "select * from userdata order by id DESC"; 
	$userdata = mysqli_query($mysqli,$userdata);
		
	while ($userdataArray = mysqli_fetch_assoc($userdata)) {
	    echo $id = $userdataArray["id"];
	    echo ",";
		echo $name = $userdataArray["name"];
		echo ",";
		echo $age = $userdataArray["age"];
		echo ",";
		echo $skill = $userdataArray["skill"];
		echo "｜";
		echo "<button class='deleteBtn' data-id='".$id."'>削除する</button>";
		echo "｜";
		echo "<button class='editBtn' data-id='".$id."'>編集する</button>";
		echo "<br>";
	};
		
?>
	
	
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