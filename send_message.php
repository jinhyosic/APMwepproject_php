<?php
// main.php에서 요청시 
$id = $_POST['id'];
$message = $_POST['message'];

//대화내용은 messages.txt 파일이 만들어저서 보관됩니다.
if($message == ""){
    echo "<script>alert(\"$id 님 공백값은 입력될 수 없습니다.\");</script>";
}
else{
    $file = fopen('messages.txt', 'a'); //a는 append(덧붙이기형식) !-파일을 덧붙이기 형식으로 열어서 대화 내용이 누적으로 붙어 저장됨.
    date_default_timezone_set('Asia/Seoul');//php 내 함수이며 한국시간으로 세팅하기 위한 코드
    fwrite($file, "- ".$id." : ".$message."     (".date("Y-m-d / H:i:s").")". PHP_EOL); //텍스트 파일에 유저의 메세지가 적힘.
    fclose($file); //입력이 끝난 후 텍스트파일 닫아줌
}
?>