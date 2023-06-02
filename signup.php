<?php include "./db/db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>회원가입</title>
<link rel = "stylesheet" href = "Css/signup.css" />
<link rel = "stylesheet" href = "https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" />
<script type = "text/javascript" src = "./js/jquery-3.2.1.js"></script> <!--제이쿼리 사용을 위한 코드-->

<!------------------------------실시간 아이디 중복 체크 시작---------------------------------->
<script>
$(document).ready(function(e) { 
	$(".check").on("keyup", function(){ //check클래스(아이디 입력받는 칸) 에서 입력을 감지
		var self = $(this); //아이디텍스트
		var id; 
		
		if(self.attr("id") === "id"){  
			id = self.val(); 
		} 
		
		$.post( //post방식으로 id_check.php에 입력한 id값을 넘김
			"id_check.php",
			{ id : id }, 
			function(data){ 
				if(data){ //만약 data값이 전송되면
					self.parent().parent().find("div.idcheck").html(data); //idcheck라는 이름의 클래스를 가진 div요소에 html방식으로 data를 뿌림
				}
			}
		);
	});
});
	//---------------------------실시간 아이디 중복 체크 끝----------------------------------------------------------------

	//---------------------------실시간 비밀번호 체크 시작----------------------------------------------------------
$(document).ready(function() {
  $('#btn_sign').attr('disabled', 'disabled');
  $('input[type=text]').on('input', function() {
    if ($(this).val() !== '') {
      $('#btn_sign').removeAttr("disabled");
    } else {
      $('#btn_sign').attr('disabled', 'disabled');
    }
  });
});

    $(function(){
		$("#default").show();
        $("#pwok").hide();
        $("#pwno").hide();
        $("input").keyup(function(){
            var pwd1=$("#pwd1").val();
            var pwd2=$("#pwd2").val();
            if(pwd1 != "" || pwd2 != ""){
				      $("#default").hide();
				      $("#pwno").hide();
				      $("#pwok").hide();
                if(pwd1 == pwd2){
                    $("#pwok").show(); //두 비밀번호 일치시 해당 문구 보여줌
                    $("#pwno").hide();
                    $("#submit").removeAttr("disabled");
                }else{
                    $("#pwok").hide();
                    $("#pwno").show(); //불일치시 해당 문구 보여줌
                    $("#submit").attr("disabled", "disabled");
                }    
            }
			      else if(pwd1 == "" && pwd2 == ""){ //두 칸 모두 공백일시
			        $("#default").show(); //해당 문구 보여줌
			        $("#pwok").hide();
			        $("#pwno").hide();
			}
			
        });
    });
</script>
	<!----------------------실시간 비밀번호 체크 끝----------------------------------->

</head>
<body>
	<div class="signup-box">
        
        <div>
          <img src="img/logo2.png" alt="Logo" id = "logo_img">
        </div>

      <h1>회원가입</h1>

      <form action="signup_action.php" method="post">
        <label>ID</label>
        <input type="text" name="id" id="id" class="check" placeholder="아이디" />
		    <div class= "idcheck"> 아이디를 입력해주세요. </div> <!--id_check.php에서 해당 문구를 제어함.-->
        
        <label>Password</label>
        <input type="password" name="pw" id="pwd1" class="pw" placeholder="비밀번호" />
		    
        <label>Password Check</label>
        <input type="password" name="pw_r" id= "pwd2" class= "pw_r" placeholder="비밀번호 확인" />

        <!-- 세개의 div요소는 위의 자바스크립트의 제어를 받아 출력문을 띄움 -->
        <div class="alert default" style="color:#000000"; id="default"> 비밀번호를 입력해주세요. </div>
        <div class="alert pwok" style="color:#0100FF"; id="pwok"> (O) 비밀번호가 일치합니다.</div>
        <div class="alert pwno" style="color:#FF0000"; id="pwno"> (X) 비밀번호가 일치하지 않습니다.</div>
        <!----------------------------------------------------------------->

		    <label>Hp</label>
        <input type="tel" name="hp" placeholder="연락처" />

        <input type="submit" value="회원가입" id = "btn_sign" />
      </form>

      <p class="para-2">
      이미 계정이 존재한다면? <a href="login.php">로그인</a>
      </p>

    </div>
</body>
</html>