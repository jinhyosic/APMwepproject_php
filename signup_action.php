<?php
include "./db/db.php";
    $con = mysqli_connect("localhost", "root", "qwer", "wepproject");
    mysqli_query($con,'SET NAMES utf8');
	//세션 데이터에 접근하기 위해 세션 시작
	if (!session_id()) {
		session_start();
	}

   
    $id = $_POST['id'];
    $pw = $_POST['pw'];
	$pw_r = $_POST['pw_r'];
    $hp = $_POST['hp'];
    if(!$id)
	{
		echo "<script>alert('아이디를 입력하세요');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if(!$pw)
	{
		echo "<script>alert('비밀번호를 입력하세요');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if(!$pw_r)
	{
		echo "<script>alert('비밀번호확인을 입력하세요');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}
	if($pw !=$pw_r)
	{
		echo "<script>alert('비밀번호가 서로 다릅니다!');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}

    if(!$hp)
	{
		echo "<script>alert('연락처를 입력하세요');</script>"; 
		echo("<script>history.back();</script>"); 
		return;
	}

	$id_check = mq("SELECT * FROM member WHERE id='$id'");
	$id_check = $id_check->fetch_array();
	if($id_check >=1){
		echo "<script>alert('아이디가 중복됩니다.'); history.back();</script>";
	}else{
		$statement = mysqli_prepare($con, "INSERT INTO member VALUES (?,?,?)");
		mysqli_stmt_bind_param($statement, "sss", $id, $pw, $hp);
		mysqli_stmt_execute($statement);
	
			echo "<script>alert('$id 님 회원가입완료!');</script>"; 
			echo("<script>location.href='./login.php';</script>"); 
			session_destroy();
	}
?>
   
