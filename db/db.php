<?php
if(!session_id()){
   session_start();
}
   $db = new mysqli("localhost","root","qwer","wepproject");
   $db->set_charset("utf8");

   function mq($sql){
     global $db;
     return $db->query($sql);
   }

  ?>