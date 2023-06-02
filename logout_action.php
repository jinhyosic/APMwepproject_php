<?php
session_start();
session_destroy(); //세션 종료.
?>

<script>
        alert("로그아웃 됨");
        location.replace("login.php");
</script>