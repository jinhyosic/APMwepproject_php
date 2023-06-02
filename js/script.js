$(document).ready(function() {
    //메세지전달 받을 시 메세지 전송
    $('#messageForm').submit(function(e) {
      e.preventDefault();
      var id = $('#login_id').val(); //main.php에서 얻어온 세션값을 통해 로그인한 유저 id를 변수에 저장함
      var message = $('#messageInput').val(); //main.php에서 유저가 입력한 채팅내용을 변수에 저장함
      $('#messageInput').val(''); //메세지 전송 처리 후 텍스트박스 공백처리하기위해 넣음
      send(id,message); //유저id와 유저의 채팅내용을 전달하는 send 함수
     
    });
  
    //아이디와 메세지를 post방식으로 서버에 전달하는 함수
    function send(id, message){
        $.post('send_message.php', {id: id , message: message}, function(response){});
    }
   
  
    // 서버에 있는 텍스트파일을 브라우저에 뿌리는 함수
    function fetchMessages() {
      $.get('fetch_messages.php', function(response) {
        $('#chatbox').html(response);
        //채팅창 스크롤바
        $('#chatbox').scrollTop($('#chatbox')[0].scrollHeight);
      });
    }
  
    
    fetchMessages();
  
    //fetchMessages함수를 0.5초 단위로 호출함 (메세지를 0.5초 단위로 가져옴.)
    setInterval(fetchMessages, 500);
  });