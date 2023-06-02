<?php
    $con = mysqli_connect("localhost", "root", "qwer", "wepproject");
    mysqli_query($con,'SET NAMES utf8');
	//세션 시작
	session_start();

    $id = $_POST['id'];
    $pw = $_POST['pw'];
	$loginCheck=false;       
    $query = "select * from member where id = '".$id."' and pw='".$pw."'";
    $result = $con->query($query);
    while($row = $result->fetch_assoc()) //로그인이 성공하면 변수 loginCheck에 true값을 줌
     {
        $loginCheck=true; 
		

		//세션 변수 등록
		$_SESSION['login_check'] = "true";		
        $_SESSION['login_id'] = $row['id']; //로그인 성공시 해당 아이디로 세션값을 저장함.
                                            //(세션의 시작이며 이 값으로 로그인정보 또는 게시글에 글쓴이 정보등등을 표현함)

        $login_id = $_SESSION['login_id']; //$_SESSION['login_id'] 은 스테틱변수 처럼 모든 페이지에 사용가능
     }

     if($loginCheck == true)
     {
		
        echo "<script>alert('$login_id' 님 환영합니다.);</script>"; 
		echo("<script>location.href='main.php';</script>"); 
       
     }
     else{
        echo "<script>alert('아이디/비번이 틀립니다.!');</script>"; 
        echo("<script>history.back();</script>"); 
     }

?> 