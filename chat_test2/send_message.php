<?php
// ajax 요청시 메세지검새ㅔㄱ
$id = $_POST['id'];
$message = $_POST['message'];

//대화내용은 messages.txt 파일이 만들어저서 보관됩니다. 
$file = fopen('messages.txt', 'a');
date_default_timezone_set('Asia/Seoul');//한국시간
fwrite($file, "- ".$id." : ".$message."     (".date("Y-m-d / H:i:s").")". PHP_EOL); //메세지 전송부
fclose($file);
?>