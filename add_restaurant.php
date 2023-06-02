<?php
	include "./db/db.php";

  if (!session_id()) {
    session_start();
}
$login_st = FALSE;
$login_id =$_SESSION['login_id'];

if(isset($_SESSION['login_id'] ) ) {
  $login_st = TRUE;
}

$result = mq("SELECT * FROM board ORDER BY hit DESC LIMIT 4"); //조회수 순으로 4장의 게시글 데이터 조회
                                                            //인기게시물 카드 갯수는 숫자만 바꿔주시면 됩니다.
$con = mysqli_connect("localhost", "root", "qwer", "wepproject");
mysqli_query($con,'SET NAMES utf8');

if(!empty($bNo) && $_SESSION['login_id']) {
$sql = 'UPDATE board SET hit = hit + 1 WHERE idx = ' . $bNo;
$result = $db->query($sql); 
if(empty($result)) {
  ?>
  <script>
    alert('오류가 발생했습니다.');
    history.back();
  </script>
  <?php 
} else {
  setcookie('board' . $bNo, TRUE, time() + (60 * 60 * 24), '/'); //하루를 쿠키만료시간으로 지정
}
}

/* 페이징 시작 */
//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
if(isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

/* 검색 시작 */
/* 게시글 항목에서 검색 하는경우 */
if($_GET['to_main'] == ""){ //get 방식으로 전송된 to_main이라는 변수값이 없다면 전부 보여줌 
  if(isset($_GET['searchColumn'])) {
  $searchColumn = $_GET['searchColumn'];
  $subString .= '&amp;searchColumn=' . $searchColumn;
  }
  if(isset($_GET['searchText'])) {
  $searchText = $_GET['searchText'];
  $subString .= '&amp;searchText=' . $searchText;
  }

  if(isset($searchColumn) && isset($searchText)) {
  $searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
  } else {
  $searchSql = '';
  }
}
/*메인 검색창에서 검색하는 경우 */
else if($_GET['to_main'] == "main"){ //get 방식으로 전송된 to_main이라는 변수값이 있다면 해당 카테고리만 보여줌 
  if(isset($_GET['searchColumn'])) { 
  $searchColumn = $_GET['searchColumn'];
  $subString .= '&amp;searchColumn=' . $searchColumn;
  }
  if(isset($_GET['searchText'])) {
  $searchText = $_GET['searchText'];
  $subString .= '&amp;searchText=' . $searchText;
  }

  if(isset($searchText)) {
  $searchSql = ' where category like "%' . $searchText . '%"';
  } else {
  $searchSql = '';
  }

}

/* 검색 끝 */

$sql = "SELECT count(*) AS cnt FROM board" . $searchSql;
$result2 = $db->query($sql);
$row = $result2->fetch_assoc();

$allPost = $row['cnt']; //전체 게시글의 수

if(empty($allPost)) {
$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
} else {

$onePage = 10; // 한 페이지에 보여줄 게시글의 수.
$allPage = ceil($allPost / $onePage); //전체 페이지의 수

if($page < 1 && $page > $allPage) {
?>
  <script>
    alert("존재하지 않는 페이지입니다.");
    history.back();
  </script>
<?php
  exit;
}

$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
$currentSection = ceil($page / $oneSection); //현재 섹션
$allSection = ceil($allPage / $oneSection); //전체 섹션의 수

$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

if($currentSection == $allSection) {
  $lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
} else {
  $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
}

$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

$paging = '<ul>'; // 페이징을 저장할 변수

//첫 페이지가 아니라면 처음 버튼을 생성
if($page != 1) { 
  $paging .= '<li class="page page_start"><a href="./add_restaurant.php?page=1' . $subString . '">처음</a></li>';
}
//첫 섹션이 아니라면 이전 버튼을 생성
if($currentSection != 1) { 
  $paging .= '<li class="page page_prev"><a href="./add_restaurant.php?page=' . $prevPage . $subString . '">이전</a></li>';
}

for($i = $firstPage; $i <= $lastPage; $i++) {
  if($i == $page) {
    $paging .= '<li class="page current">' . $i . '</li>';
  } else {
    $paging .= '<li class="page"><a href="./add_restaurant.php?page=' . $i . $subString . '">' . $i . '</a></li>';
  }
}

//마지막 섹션이 아니라면 다음 버튼을 생성
if($currentSection != $allSection) { 
  $paging .= '<li class="page page_next"><a href="./add_restaurant.php?page=' . $nextPage . $subString . '">다음</a></li>';
}

//마지막 페이지가 아니라면 끝 버튼을 생성
if($page != $allPage) { 
  $paging .= '<li class="page page_end"><a href="./add_restaurant.php?page=' . $allPage . $subString . '">끝</a></li>';
}
$paging .= '</ul>';

/* 페이징 끝 */


$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

$sql = 'SELECT * FROM board' . $searchSql . ' ORDER BY idx DESC' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
$result2 = $db->query($sql);

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>맛집 추가</title>
    <link rel = "stylesheet" href = "Css/add_restaurant.css" />
    <link rel="stylesheet" href="./boardcss/normalize.css" />
	  <link rel="stylesheet" href="./boardcss/board.css" />
    <link rel = "stylesheet" href = "Css/dropdown.css" />
    <script src = "js/add_restaurant.js"></script>
</head>
<body>
  <div class = "main-head" >
    <nav id = "nav">
      <div>
        <!------ 메인 페이지 로고------>
        <a class = main-page-logo href = "main.php">
          <img src = "img/logo2.png" alt = "TRY EAT" id = "main-logo" />
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
      <p id = "main-label1">맛집 등록하기</p>
    </div>
  </div>
  <!------ 게시물 목록 시작점 ------>
    
  <div class = "main-mid">
   <div class = "menu-title1">
      <h1>최신 인기 게시물</h1>
    </div>
    <div class = "post-list">
<!-------------------------------------------게시물 카드 한장 시작------------------------------------->
                       <!-------php 안의 while문으로 4회 반복 수행되며 4장의 카드를 뿌림-------->
    <?php
    while($row=$result->fetch_array())
    {
    ?>
     <!---게시물 카드 한장--->
    
      <a href ="./board_detail2.php?idx=<?php echo $row[0]?>">
       <div class = "post">
                                <!--if 문이 카테고리에 따라 알맞은 사진을 띄움--->
          <?php
          if($row[6] == "한식"){
          ?>
            <img src = "img/korean_food.jpg" alt = "dessert" class = "main-img">
          <?php
          }
          ?>
          <?php
          if($row[6] == "중식"){
          ?>
            <img src = "img/chinese_food.jpg" alt = "dessert" class = "main-img">
          <?php
          }
          ?>
          <?php
          if($row[6] == "일식"){
          ?>
            <img src = "img/japanese_food.jpg" alt = "dessert" class = "main-img">
          <?php
          }
          ?>
          <?php
          if($row[6] == "양식"){
          ?>
            <img src = "img/western_food.jpg" alt = "dessert" class = "main-img">
          <?php
          }
          ?>
          <?php
          if($row[6] == "피자"){
          ?>
            <img src = "img/pizza.jpg" alt = "dessert" class = "main-img">
          <?php
          }
          ?>
          <?php
          if($row[6] == "치킨"){
          ?>
            <img src = "img/chicken.jpg" alt = "dessert" class = "main-img">
          <?php
          }
          ?>
          <?php
          if($row[6] == "카페"){
          ?>
            <img src = "img/cafe.jpg" alt = "dessert" class = "main-img">
          <?php
          }
          ?>
          <?php
          if($row[6] == "기타"){
          ?>
            <img src = "img/que.jpg" alt = "dessert" class = "main-img">
          <?php
          }
          ?>
                      <!-------이미지 if 문 끝--------->

          <div class = "post-title">
            <span> 제목 : <?php echo $row[2]?></span> <!-- db의 2번째 컬럼 제목 -->
          </div>
          <div class = "post-content">
            <p class = "content">한줄평 : <?=$row[5]?></p> <!-- db의 5번째 컬럼 한줄평 -->
            <p class = "content">#<?=$row[6]?></p> <!-- db의 6번째 컬럼 카테고리 -->
          </div>
          <div class = "hit">
            <img src = "img/hit2.png">
            <p><?=$row[10]?></p>
          </div>
        </div>
      </a>
    <?php
    } 
    ?>
  <!---------------------------------------------게시물 카드 한장 끝---------------------------------------------->
    </div>
  </div>
 </div>
   

   
    <hr class = "mid-line">

    <div class = "menu-title2">
   <!------메인에서 누른 카테고리에 따라 게시판명(h1태그)를 달리 표시하기 위한 조건문 시작----->
      <?php
        if($searchText == ""){ 
      ?>
          <h1>전체 게시물</h1>
      <?php
        }
      ?>

      <?php
        if($searchText == "한식"){ 
      ?>
          <h1>한식</h1>
      <?php
        }
      ?>

      <?php
        if($searchText  == "중식"){ 
      ?>
          <h1>중식</h1>
      <?php
        }
      ?>

      <?php
        if($searchText == "일식"){ 
      ?>
          <h1>일식</h1>
      <?php
        }
      ?>

      <?php
        if($searchText == "양식"){ 
      ?>
          <h1>양식</h1>
      <?php
        }
      ?>

      <?php
        if($searchText == "피자"){ 
      ?>
          <h1>피자</h1>
      <?php
        }
      ?>

      <?php
        if($searchText == "치킨"){ 
      ?>
          <h1>치킨</h1>
      <?php
        }
      ?>

      <?php
        if($searchText == "카페"){ 
      ?>
          <h1>카페</h1>
      <?php
        }
      ?>

      <?php
        if($searchText == "기타"){ 
      ?>
          <h1>기타</h1>
      <?php
        }
      ?>

     <!------메인에서 누른 카테고리에 따라 게시판명(h1태그)를 달리 표시하기 위한 조건문 끝----->
    </div>
    <div class = write-list>
          <div id="boardList">
            <!--로그인 시 에만 글쓰기 버튼 활성화-->
            <?php 
            if($login_st){ 
            ?>
            <a href = "./page_reg.php" class = "write-post">
              <img src = "img/write_post.png">
            </a>
            <?php    
            }
            ?>


            <table>
              <thead>
                <tr>
                  <th scope="col" class="title">제목</th>
                  <th scope="col" class="storename">매장명</th>
                  <th scope="col" class="storename">매장주소</th>
                  <th scope="col" class="author">작성자</th>
                  <th scope="col" class="date">작성일</th>
                  <th scope="col" class="hit">조회</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  if(isset($emptyData)) {
                    echo $emptyData;
                  } else {
                    while($row = $result2->fetch_assoc())
                    {
                      $datetime = explode(' ', $row['date']);
                      $date = $datetime[0];
                      $time = $datetime[1];
                      if($date == Date("Y-m-d H:i:s"))
                        $row['date'] = $time;
                      else
                        $row['date'] = $date;
                  ?>
                  <tr>
                    
                    <td class="title">
                      <a href="./board_detail2.php?idx=<?php echo $row['idx']?>"><?php echo $row['subject']?></a>
                    </td>
                    <td class="author"><?php echo $row['shop_name']?></td>
                    <td class="author"><?php echo $row['shop_address']?></td>
                    <td class="author"><?php echo $row['id']?></td>
                    <td class="date"><?php echo $row['date']?></td>
                    <td class="hit"><?php echo $row['hit']?></td>
                  </tr>
                  <?php
                    }
                  }
                  ?>
              </tbody>
            </table>

            <div class="paging">
              <?php echo $paging ?>
            </div>

              <!--게시글 밑 검색창--->
            <div class="searchBox">
              <form action="./add_restaurant.php" method="get">
                <select name="searchColumn">
                  <option <?php echo $searchColumn=='title'?'selected="selected"':null?> value="subject">제목</option>
                  <option <?php echo $searchColumn=='content'?'selected="selected"':null?> value="content">내용</option>
                  <option <?php echo $searchColumn=='id'?'selected="selected"':null?> value="id">작성자</option>
                </select>
                <input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
                <button type="submit">검색</button>
              </form>
            </div>
          </div>
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