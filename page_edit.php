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

    $db = mysqli_connect("localhost","root","qwer","wepproject");
    mysqli_query($db,'SET NAMES utf8');
    $sql1 = "select * from board where idx = $bNo"; //특정 게시물 idx($bNo)번호로 db에서 값을 검색
    $rs=$db->query($sql1);
    
    $idx = $_GET['idx'];
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">
<link rel = "stylesheet" href = "Css/main.css" />
<link rel = "stylesheet" href = "Css/page_edit.css" />
<link href="Css/dropdown.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">



<title>게시글 수정</title>

</head>

<body style="overflow-x:hidden; overflow-y:auto;">
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


	<article>

		<div class="container" role="main">
      
      <div class = "title1">
        <h1>게시글 수정</h1>
      </div>

      <div class = "write-container">

		    <form action="./b_edit_action.php" method="POST" enctype="multipart/form-data">

        <?php		
	      while($row = $rs->fetch_assoc())
        {
        ?> 

        <input type="hidden" name="idx" value="<?=$idx?>" /> <!--수정 작업시 게시물 idx를 전달하기 위함-->
				<div class="mb-3">

					<label for="title">제목</label>

					<input type="text" class="form-control" name="subject" id="subject" value="<?=$row["subject"]?>" />

				</div>


				<div class="mb-3">

					<label for="reg_id">매장명</label>

					<input type="text" class="form-control" name="store_name" id="store_name" placeholder="수정 할 매장명" value="<?=$row["shop_name"]?>"/>

				</div>

				

				<div class="mb-3">

					<label for="content">매장 주소</label>

					<input class="form-control" rows="5" name="store_address" id="store_address" placeholder="수정 할 매장 주소" value="<?=$row["shop_address"]?>" ></input>

				</div>

				

				<div class="mb-3">

					<label for="tag">한줄평</label>

					<input type="text" class="form-control" name="short_review" id="short_review" placeholder="수정 할 한줄평" value="<?=$row["short_review"]?>"/>

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

					<textarea type="text" class="form-control" name="content" id="content" placeholder="이야기를 들려주세요~"><?=$row["content"]?></textarea>

				</div>
        <?php
		    }
	      ?>

      <div class = "container-button">
			  <button type="submit" class="btn btn-sm btn-primary" id="btnSave">수정</button>
        <button type="button" class="btn btn-sm btn-primary" id="btnList"  onclick="goBack()">취소</button>
          <!-----취소 버튼의 기능 정의----->
          <script>
                function goBack(){
                  window.history.go(-1);
                }
            </script>
          <!-----취소 버튼의 기능 정의 끝----->
      </div>
			</form>
    
      </div>
      
			</div>


	</article>

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