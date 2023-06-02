<?php
//게시글 등록 action을 진행하는 페이지.
$con = mysqli_connect("localhost", "root", "qwer", "wepproject");
mysqli_query($con,'SET NAMES utf8');

if (!session_id()) {
    session_start();
}

$login_id =$_SESSION['login_id']; //로그인 정보 세션

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
$statement = mysqli_prepare($con, "INSERT INTO board VALUES (NULL,?,?,?,?,?,?,?,?,NULL,0)");
mysqli_stmt_bind_param($statement, "ssssssss", $login_id, $subject, $store_name, $store_address, $short_review, $category, $content, $time);
mysqli_stmt_execute($statement);

echo "<script>alert('$store_name 등록 완료!');</script>"; 
echo("<script>location.href='main.php';</script>"); 
?> 