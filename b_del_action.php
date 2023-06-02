<?php

include "./db/db.php";
    $con = mysqli_connect("localhost", "root", "qwer", "wepproject");
    mysqli_query($con,'SET NAMES utf8');
	//세션 데이터에 접근하기 위해 세션 시작
	if (!session_id()) {
		session_start();
	}
	$idx = $_GET['idx']; //해당 게시물의 idx값을 받아서 쿼리문에 활용
	
	$result = mq("DELETE FROM board WHERE (idx = $idx)");
	if($result==TRUE){
		echo "<script>alert('게시물 삭제완료!');</script>";
		echo("<script>history.go(-2);</script>"); 
	}

    $login_id =$_SESSION['login_id'];


    // if()
	// {
	// 	echo "<script>alert('타인의 글은 삭제 할 수 없습니다.');</script>"; 
	// 	echo("<script>history.back();</script>"); 
	// 	return;
	// }

?>