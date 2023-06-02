<!DOCTYPE html>
<html lang="en">
  <head>
    <title>로그인 페이지</title>
    <link rel = "stylesheet" href = "Css/login.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />
  </head>
  <body>

    <div class="login-box">
        
        <div>
          <img src="img/logo2.png" alt="Logo" id = "logo_img">
        </div>

      <h1>로그인</h1>

      <form action="login_action.php" method="post">
        <label>ID</label>
        <input type="text" name="id" placeholder="아이디" />
        <label>Password</label>
        <input type="password" name="pw" placeholder="비밀번호" />
        <input type="submit" value="로그인" id = "loginButton" />
      </form>

      <p class="para-2">
      아직 계정이 없다면? <a href="signup.php"> 회원가입</a>
      </p>

    </div>
  </body>
</html>
