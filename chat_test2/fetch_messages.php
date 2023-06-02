<?php
//메세지텍스트파일을 읽어다가 대화창에 뿌려줍니다.

$messages = file('messages.txt');

//메세지 보여줌
foreach ($messages as $message) {
  echo "<p>$message</p>";
}
?>