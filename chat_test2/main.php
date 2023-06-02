<?php
if (!session_id()) {
		session_start();
	}
    $login_id =$_SESSION['login_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>메인 페이지</title>
  <link rel = "stylesheet" href = "Css/main.css" />
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
  <div class = "main-head" >
    <nav id = "nav">
      <div>
        <!------ 메인 페이지 로고------>
        <a class = main-page-logo href = "main.php">
          <img src = "img/logo2.png" id = "main-logo" />
        </a>
        <!------ 상단 네비게이션 ------>
        <ul>
          <li><a href = "">홈</a></li>
          <li><a href = "">나의 맛집</a></li>
          <li><a href = "">맛집 등록</a></li>
          <li><a href = "">스토리</a></li>
          <li><img src = "img/member.png" id = member-img></li>
        </ul>
      </div>
    </nav>
      <!------ 메인페이지 상단의 라벨 ------>
    <div class = main-label>
      <p id = "main-label1">당신이 원하는 맛집,</p>
      <p id = "main-label2">지금바로 TRY EAT 하세요!</p>
    </div>
      <!------ 메인페이지 상단의 검색창 ------>
    <div class = "search-bar">
      <img src = "img/search.png" id = "search-icon">
      <input type = "text" placeholder = "검색어 입력" >
      <button>검색</button>
    </div>
  </div>

  <div class = main-mid>
  <!------ 카테고리 첫 번째 시작점 ------>
    <div id = "menu-title1">
      <h1>카테고리 첫 번째</h1>
    </div>
    <div class = "category1">
      <!------ 메뉴 카테고리 배너 왼쪽기준 1번째 ------>
      <ul class = "banner">
        <li class = "banner1">
          <a href = "menu.php?menu=한식" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/korean_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">대충 적당한 타이틀 1.</span>
              <p class = "banner-content">"--- 대충 설명 해주는 내용 1 ---"</p>
            </div>
          </a>
        </li>
        <li class = "banner1">
          <a href = "menu.php?menu=피자" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/korean_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">대충 적당한 타이틀 5.</span>
              <p class = "banner-content">"--- 대충 설명 해주는 내용 5 ---"</p>
            </div>
          </a>
        </li>
      </ul>
      <!------ 메뉴 카테고리 배너 왼쪽기준 2번째 ------>
      <ul class = "banner">
        <li class = "banner1">
          <a href = "menu.php?menu=중식" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/chinese_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">대충 적당한 타이틀 2.</span>
              <p class = "banner-content">"--- 대충 설명 해주는 내용 2 ---"</p>
            </div>
          </a>
        </li>
        <li class = "banner1">
          <a href = "menu.php?menu=치킨" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/chinese_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">대충 적당한 타이틀 6.</span>
              <p class = "banner-content">"--- 대충 설명 해주는 내용 6 ---"</p>
            </div>
          </a>
        </li>
      </ul>

      <!------ 메뉴 카테고리 배너 왼쪽기준 3번째 ------>
      <ul class = "banner">
        <li class = "banner1">
          <a href = "menu.php?menu=일식" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/western_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">대충 적당한 타이틀 3.</span>
              <p class = "banner-content">"--- 대충 설명 해주는 내용 3---"</p>
            </div>
          </a>
        </li>
        <li class = "banner1">
          <a href = "menu.php?menu=카페" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/western_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">대충 적당한 타이틀 7.</span>
              <p class = "banner-content">"--- 대충 설명 해주는 내용 7 ---"</p>
            </div>
          </a>
        </li>
      </ul>

      <!------ 메뉴 카테고리 배너 왼쪽기준 4번째 ------>
      <ul class = "banner">
        <li class = "banner1">
          <a href = "menu.php?menu=양식" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/dessert.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">대충 적당한 타이틀 4.</span>
              <p class = "banner-content">"--- 대충 설명 해주는 내용 4---"</p>
            </div>
          </a>
        </li>
        <li class = "banner1">
          <a href = "menu.php?menu=기타" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/dessert.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">대충 적당한 타이틀 8.</span>
              <p class = "banner-content">"--- 대충 설명 해주는 내용 8 ---"</p>
            </div>
          </a>
        </li>
      </ul>
    </div>
    <!------ 카테고리 첫 번째 끝 ------>

    <hr class = "mid-line">

    <!------ 카테고리 두 번째 시작점 ------>
    <div id = "menu-title2">

      <!----------대화창 시작---------->
    <h2>맛집 소통</h2>

<div id="chatbox"></div>

<form id="messageForm">
  <input type="hidden" id="login_id" value="login_id"/> <!--메모: value에는 로그인 세션 값-->
  <input type="text" id="messageInput" placeholder="메세지를 입력하세요."/>
  <input type="submit" value="전송"/>
</form>

</div>
      <!----------대화창 끝---------->
</body>
</html>