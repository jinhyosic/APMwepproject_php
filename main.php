<?php
include "./db/db.php";

if (!session_id()) {
		session_start();
}

$login_st = FALSE; //로그인 상태를 표현하는 변수
$login_id =$_SESSION['login_id']; //로그인 정보 또는 채팅기능에 들어갈 유저id값을 위해 세션을 받아둠.

if(isset($_SESSION['login_id'] ) ) { //세션값이 존재한다면
  $login_st = TRUE; //로그인 상태에 TRUE
}
	/* 검색 시작 */
  if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString .= '&amp;searchColumn=' . $searchColumn;
	}
	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
		$subString .= '&amp;searchText=' . $searchText; 
	}
	
	if(isset($searchText)) {
		$searchSql = ' where category like "%' . $searchText . '%"'; //카테고리 컬럼에서 $searchText와 같은 값인 게시물을 찾는 쿼리문
	} else {
		$searchSql = '';
	}

	$sql = "SELECT count(*) AS cnt FROM board" . $searchSql;
	$result2 = $db->query($sql);
	$row = $result2->fetch_assoc(); 
	/* 검색 끝 */
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
                  <!--대화창 기능을 위한 제이쿼리-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/script.js"></script> <!---채팅창기능을 위한 자바스크립트--->
  
  <title>메인 페이지</title>
  <link rel = "stylesheet" href = "Css/main.css" />
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
            <span class="dropbtn"><li><img src = "img/member.png" id = member-img ></li> </span>
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
      <!------ 메인페이지 상단의 검색창 ------>
         <form action="./add_restaurant.php" method="get"> <!--메인에서 검색버튼 누를 시 GET방식으로 검색어를 전달함-->
        <div class = "search-bar">
        <img src = "img/search.png" id = "search-icon">
        <input type = "text" name="searchText" placeholder = "#카테고리를 입력해보세요." value="<?php echo isset($searchText)?$searchText:null?>"/> <!--사용자가 입력한 검색어를 담음-->
        <input type = "hidden" name = "to_main" name="to_main" value="main"/> <!--메인검색창에서의 검색 결과를 구분 하기위한 전송값, 이 값은(add_restaurant.php)로 전달됨-->
        <button>검색</button>
        </div>
      </form>
  </div>

  <div class = main-mid>
  <!------ 카테고리 첫 번째 시작점 ------>
    <div id = "menu-title1">
      <h1>먹거리 카테고리</h1>
    </div>
    <div class = "category1">
      <!------ 메뉴 카테고리 배너 왼쪽기준 1번째 ------>
      <ul class = "banner">
        <li class = "banner1">
          <a href = "add_restaurant.php?searchText=한식&to_main=main" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/korean_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">[한식]</span>
              <p class = "banner-content">"한국인은 얼큰하고 든든한게!"</p>
            </div>
          </a>
        </li>
        <li class = "banner1">
          <a href = "add_restaurant.php?searchText=치킨&to_main=main" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/chicken.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">[치킨]</span>
              <p class = "banner-content">"맛이 없을 수가 없는 맥주 친구~"</p>
            </div>
          </a>
        </li>
      </ul>
      <!------ 메뉴 카테고리 배너 왼쪽기준 2번째 ------>
      <ul class = "banner">
        <li class = "banner1">
          <a href = "add_restaurant.php?searchText=중식&to_main=main" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/chinese_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">[중식]</span>
              <p class = "banner-content">"얼큰한 짬뽕 국물에 자장밥이 땡긴다~"</p>
            </div>
          </a>
        </li>
        <li class = "banner1">
          <a href = "add_restaurant.php?searchText=피자&to_main=main" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/pizza.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">[피자]</span>
              <p class = "banner-content">"쫄깃한 도우에 쫀득한 치즈!"</p>
            </div>
          </a>
        </li>
      </ul>

      <!------ 메뉴 카테고리 배너 왼쪽기준 3번째 ------>
      <ul class = "banner">
        <li class = "banner1">
          <a href = "add_restaurant.php?searchText=일식&to_main=main" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/japanese_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">[일식]</span>
              <p class = "banner-content">"회? 초밥? 돈까스?"</p>
            </div>
          </a>
        </li>
        <li class = "banner1">
          <a href = "add_restaurant.php?searchText=카페&to_main=main" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/cafe.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">[카페]</span>
              <p class = "banner-content">"아이스아메리카노에 치즈케잌?"</p>
            </div>
          </a>
        </li>
      </ul>

      <!------ 메뉴 카테고리 배너 왼쪽기준 4번째 ------>
      <ul class = "banner">
        <li class = "banner1">
          <a href = "add_restaurant.php?searchText=양식&to_main=main" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/western_food.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">[양식]</span>
              <p class = "banner-content">"스테이크?파스타? 느끼~한것이 땡긴다!"</p>
            </div>
          </a>
        </li>
        <li class = "banner1">
          <a href = "add_restaurant.php?searchText=기타&to_main=main" class = "banner-link">
            <div class = "banner-container">
              <img src = "img/que.jpg">
              <div class = "overlay"></div>
              <span class = "banner-title">[기타]</span>
              <p class = "banner-content">"애매한 매장의 카테고리는 이곳으로!"<br>"더욱 다양한 카테고리들이 준비중!!"</p>
            </div>
          </a>
        </li>
      </ul>
    </div>
    <!------ 카테고리 첫 번째 끝 ------>

         <!----------------채팅창 시작--------------------->
    <hr class = "mid-line">
      <h1 class = "chatBox-title">실시간 맛집 소통</h1>
    <div class = "chatBox-layout">
      <div id="chatbox"></div>
      <div class = "inputBox">
        <form id="messageForm">
          <input type="hidden" id="login_id" value="<?=$login_id?>"/> <!-- <= 메모: value에는 로그인 세션 값 -->
        
          <!--로그인 시에만 글쓰기 창과 버튼이 보임--->
          <?php
          if($login_st == TRUE){
          ?>
          <input type="text" id="messageInput" placeholder="메세지를 입력하세요."/>
          <input type="submit" value="전송" id = "enter"/>
          <?php
          }
          ?>
        </form>
      </div>
    </div>
      <!---------------------채팅창 끝------------------------->

  <footer>
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
  </footer>
</body>
</html>