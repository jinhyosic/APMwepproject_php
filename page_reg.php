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
<html lang="en">
<html>
<head>
  <meta charset="UTF-8">
  <link rel = "stylesheet" href = "Css/page_reg.css" />
  <link rel = "stylesheet" href = "Css/dropdown.css" />
  <title>게시글 등록</title>
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
		<div class="main-mid" >
      <div class = "title1">
        <h1>게시글 등록</h1>
      </div>

      <div class = "write-container">

		    <form action="./store_reg.php" method="POST" enctype="multipart/form-data">

				<div class="mb-3">

					<label for="title">제목</label>

					<input type="text" class="form-control" name="subject" id="subject" placeholder="제목을 입력해 주세요"/>

				</div>

				<div class="mb-3">

					<label for="reg_id">매장명</label>

					<input type="text" class="form-control" name="store_name" id="store_name" placeholder="매장명을 입력해 주세요"/>

				</div>

				<div class="mb-3">

					<label for="content">매장 주소</label>

					<input class="form-control" rows="5" name="store_address" id="store_address" placeholder="매장주소를 입력해 주세요" ></input>

				</div>

				<div class="mb-3">

					<label for="tag">한줄평</label>

					<input type="text" class="form-control" name="short_review" id="short_review" placeholder="한줄평을 입력해 주세요"/>

				</div>

        <div class="mb-3">

					<label for="tag">#카테고리</label>

					<select type="text" class="form-control" name="category" id="category">
            <option value="" selected="selected">#키워드</option>
            <option value="한식">#한식</option>
            <option value="중식">#중식</option>
            <option value="일식">#일식</option>
            <option value="양식">#양식</option>
            <option value="피자">#피자</option>
            <option value="치킨">#치킨</option>
            <option value="카페">#카페</option>
            <option value="기타">#기타</option>
          </select>

				</div>

        <div class="mb-3">

					<label for="tag">내용</label>

					<textarea type="text" class="form-control" name="content" id="content" placeholder="이야기를 들려주세요~"></textarea>

				</div>

        <div class = "container-button">

        <button type="button" class="btn btn-sm btn-primary" id="btnList" onclick="goBack()">목록</button>

           <!-----목록 버튼의 기능 정의----->
          <script>
              function goBack(){
                window.history.go(-1);
              }
          </script>
          <!-----목록 버튼의 기능 정의 끝----->

        <button type="submit" class="btn btn-sm btn-primary" id="btnSave">등록</button>

        </div>

        </form>

      </div>

		</div>

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