<?php

include "./db/db.php";
    $con = mysqli_connect("localhost", "root", "qwer", "wepproject");
    mysqli_query($con,'SET NAMES utf8');
	//세션 데이터에 접근하기 위해 세션 시작
	if (!session_id()) {
		session_start();
	}
	$idx = $_POST['idx'];
    $subject = $_POST['subject'];
    $store_name = $_POST['store_name'];
    $store_address = $_POST['store_address'];
    $short_review = $_POST['short_review'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    date_default_timezone_set('Asia/Seoul'); //한국시간으로 설정하기 위한 코드
    $time = date("Y-m-d H:i:s");
 
	if(!$subject){
        echo "<script>alert('글 제목을 입력하세요');</script>"; 
        echo("<script>history.back();</script>"); 
    }
    if(!$store_name){
        echo "<script>alert('매장명을 입력하세요');</script>"; 
        echo("<script>history.back();</script>"); 
    }
    
    if(!$store_address){
        echo "<script>alert('매장 주소를 입력하세요');</script>"; 
        echo("<script>history.back();</script>"); 
    }
    
    if(!$short_review){
        echo "<script>alert('한줄평은 필수 입니다.');</script>"; 
        echo("<script>history.back();</script>"); 
    }
    
    if(!$category){
        echo "<script>alert('카테고리 미정.');</script>"; 
        echo("<script>history.back();</script>"); 
    }
    if(!$content){
        echo "<script>alert('내용을 입력해주세요.');</script>"; 
        echo("<script>history.back();</script>"); 
    }

   

	$result = mq("update board set subject = '".$subject."' , shop_name =  '".$store_name."', shop_address = '".$store_address."', short_review = '".$short_review."', category = '".$category."', content = '".$content."', date = '".$time."'  where idx = '".$idx."'");
    
    //$sql1 = "UPDATE board SET 'subject' = $subject , 'shop_name' =  $store_name, 'shop_address' = $store_address, 'short_review' = $short_review, 'category' = $category, 'content' = $content, 'date' = $time  WHERE 'idx' = $idx";
	 if($result==TRUE){
		echo "<script>alert('게시물 수정완료!');</script>";
	 	echo("<script>history.go(-2);</script>"); 
	}

    $login_id =$_SESSION['login_id'];


?>