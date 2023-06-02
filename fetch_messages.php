<?php
//이 php 파일은 메세지 텍스트파일을 읽어다가 대화창에 뿌려줌.

$messages = file('messages.txt');

//텍스트파일에 저장된 대화를 브라우저에 보여줌
foreach ($messages as $message) {
  echo "<p>$message</p>";
}
?>