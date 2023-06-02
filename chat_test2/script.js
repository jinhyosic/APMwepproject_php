$(document).ready(function() {
    //메세지전달 받을 시 메세지 전송
    $('#messageForm').submit(function(e) {
      e.preventDefault();
      var id = $('#login_id').val();
      var message = $('#messageInput').val();
      $('#messageInput').val(''); //메세지 전송 후 텍스트박스 공백처리하기위해 넣음
      send(id,message); //id전달
      //sendMessage(message); //메세지전달
    });
  
    //아이디를 서버로 보냄
    function send(id, message){
        $.post('send_message.php', {id: id , message: message}, function(response){});
    }
   
  
    // 서버에서 메세지를 가져오고 새 글을 업뎃함
    function fetchMessages() {
      $.get('fetch_messages.php', function(response) {
        $('#chatbox').html(response);
        //채팅창 스크롤바
        $('#chatbox').scrollTop($('#chatbox')[0].scrollHeight);
      });
    }
  
    //첨에 있던 메세지 가져오는 함수
    fetchMessages();
  
    //메세지 가져오는 시간 /현재0.5초입니다.
    setInterval(fetchMessages, 500);
  });