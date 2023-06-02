<!DOCTYPE html>
<html>
<head>
  <title>try eat 소통</title>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>

  <style>
    #chatbox {
      height: 300px;
      overflow-y: scroll;
      border: 1px solid #ccc;
      padding: 10px;
    }
  </style>
</head>
<body>
  <h2>맛집 소통</h2>

  <div id="chatbox"></div>

  <form id="messageForm">
    <input type="hidden" id="login_id" value="login_id"/> <!--메모: value에는 로그인 세션 값-->
    <input type="text" id="messageInput" placeholder="메세지를 입력하세요."/>
    <input type="submit" value="전송"/>
  </form>

</body>