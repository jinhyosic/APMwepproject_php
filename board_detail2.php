<?php
include "./db/db.php";
if (!session_id()) {
		session_start();
	}
    $idcheck;
    $login_id =$_SESSION['login_id'];

    $bNo = $_GET['idx'];
    
    //로그인 시에만 조회수가 오름.
    if(!empty($bNo) && $_SESSION['login_id']) {
      $sql = 'UPDATE board SET hit = hit + 1 WHERE idx = ' . $bNo;
      $result = $db->query($sql); 
      if(empty($result)) {
        ?>
        <script>
          alert('오류가 발생함.');
          history.back();
        </script>
        <?php 
      } else {
        setcookie('board' . $bNo, TRUE, time() + (60 * 60 * 24), '/');
      }
    }
?>

<!DOCTYPE html>
<html>
  <head>
  <title>게시글 상세보기</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel = "stylesheet" href = "Css/main.css" />
        <link rel = "stylesheet" href = "Css/board_detail2.css"/>   
        <link rel = "stylesheet" href = "Css/dropdown.css" />
  </head>
  
  <body>

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

  </div>
  </div>
                        <!---게시물 상세보기 시작----->
  <div class = "main-mid">
  <h1 class = "title1">게시물 상세보기</h1>
    <div class = "post-info">
    <?php

        $idx = $_GET['idx']; //해당 게시물의 번호를 받아 알맞은 내용을 표시해줌

        $result = mq("SELECT * FROM board WHERE idx ='$idx'");

        while($row=$result->fetch_array())
    {
        $idcheck = $row[1]; //자신의 게시물이 맞는지 아닌지를 판단하고 수정삭제버튼 표시 유무를 확인.
        ?>
    <div id="post-box">

      <span>제목</span> 
      <div class = "content"><p><?=$row[2]?></p></div>
      <span>등록일</span>
      <div class = "content"><p><?=$row[8]?></p></div>
      <span>작성자</span>
      <div class = "content"><p><?=$row[1]?></p></div>
      <span>매장 이름</span>
      <div class = "content"><p><?=$row[3]?></p></div> <!---매장이름을 db에서 가져옴-->
      <span>매장 주소</span>
      <div class = "content"><p><?=$row[4]?></p></div> <!---매장주소를 db에서 가져옴-->
      <span>한줄평</span>
      <div class = "content"><p><?=$row[5]?></p></div>
      <span>카테고리</span>
      <div class = "content"><p>#<?=$row[6]?></p></div>
      <span>내용</span>
      <div id = "content1"><p><?=$row[7]?></p></div> <!---게시글 내용을 db에서 가져옴-->
   
    </div>
    </post-box>
    <?php  
    } 
    ?>

<div class="btn_edit_body">
    <div class="btn_edit">

      <button type="button" class="btn_edit gray" onclick="goBack()">목록</button>

      <!-----목록 버튼의 기능 정의----->
      <script>
        function goBack(){
          window.history.go(-1);
        }
      </script>
    <!-----목록 버튼의 기능 정의----->

      <?php //회원의 권한에 따라 아래 버튼이 나타남.
        if($login_id == $idcheck){ 
      ?>     
        <button type="button" class="btn_edit gray" onclick="location.href='./b_del_action.php?idx=<?=$idx?>'; return false;"> 삭제</button>  
        <button type="button" class="btn_edit gray" onclick="location.href='./page_edit.php?idx=<?=$idx?>'; return false;"> 수정</button>
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