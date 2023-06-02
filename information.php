<?php
include "./db/db.php";
if (!session_id()) 
{
	session_start();
}
  $idcheck;
  $login_id =$_SESSION['login_id'];
  $bNo = $_GET['idx']; //해당 게시물의 idx값을 받음
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>try eat!</title>
  <link rel = "stylesheet" href = "Css/information.css" />
  <link rel = "stylesheet" href = "Css/dropdown.css" />
</head>
<body style = "overflow-x: hidden">
<?=$loginid?>
  <div class = "main-head" >
    <nav id = "nav">
      <div>
        <!------ 메인 페이지 로고------>
        <a class = main-page-logo href = "main.php">
          <img src = "img/logo2.png" id = "main-logo" />
        </a>
        <!------ 상단 네비게이션 ------>
        <ul>
          <li><a href = "main.php" id = "nav-home">홈</a></li>
          <li><a href = "map.php">맛집 찾기</a></li>
          <li><a href = "add_restaurant.php">맛집 등록</a></li>
          <?php
          if(isset($_SESSION['login_id'])){
          ?>
          <div class="dropdown">
            <span class="dropbtn"><li><img src = "img/member.png" id = member-img  ></li> </span>
            <div class="dropdown-content">
              <div class = "dropdown-content1"><a href="information.php"><p>내 정보</p></a></div>
              <div class = "dropdown-content2"><a href="logout_action.php"><p>로그아웃</p></a></div>
            </div>
          </div>
          <?php
          }
          ?>
          <?php
          if(!isset($_SESSION['login_id'])){
          ?>
          <li><a href = "login.php">로그인</a></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </nav>
      <!------ 메인페이지 상단의 라벨 ------>
    <div class = main-label>
      <p id = "main-label1">당신이 원하는 맛집,</p>
      <p id = "main-label2">지금바로 TRY EAT 하세요!</p>
    </div>
  </div>
<div class = "main-mid">
  <div class = "title1">
    <h1>내 정보</h1>
  </div>
  <div class = "member-container">
    <?php
    $result = mq("SELECT * FROM member WHERE id ='$login_id'"); //현재 로그인된 회원의 정보를 db에서 검색
    while($row=$result->fetch_array())
    {
      $idcheck = $row[0]; 
    ?>
    <div class = "member-info">
      <label>ID</label>
      <div class = "info"><p><?=$row[0]?></p></div> <!-- 아이디-->
      <label>HP</label>
      <div class = "info"><p><?=$row[2]?></p></div> <!-- 연락처 -->
    </div>
    <?php
    }
    ?>
    <?php //회원의 권한에 따라 버튼이 나타남.
    if($login_id == $idcheck){ 
    ?>       
  </div>

  <hr>

    <div class = "title2">
      <h1>내 정보 수정</h1>
    </div>
    <div class = "edit-member">
      <form action="edit_action.php" method="post">
        <div class = "edit-container">
          <label>Password</label>
          <input type="password" name="pw" placeholder="새 비밀번호" />
        </div>
        <div class = "edit-container">
          <label>Password_Check</label>
          <input type="password" name="pw_r" placeholder="새 비밀번호 확인" />
        </div> 
        <div class = "edit-container">
          <label>HP</label>
          <input type="text" name="hp" value="<?= $hp ?>" placeholder="변경할 연락처 입력" />
        </div>
        <div class="edit-btn"><button type="submit">수정</button></div>
      </form>
      <?php    
      }
      ?>
    </div>
</div>
          <!----------bottom 부분 시작---------->
          <div class = "main-bottom">
            <img src = "img/logo2.png">
            <div class = "bottom-member">
              <div><span>진효식</span></div>
            </div>
            <div class = "bottom-title">
              <div><p>010-8518-8990</p></div>
            </div>
      </div>
          <!----------bottom 부분 끝---------->
</body>
</html>
