<?php

// Database Constants
define("DB_SERVER", "localhost");
define("DB_USER", "xxx");
define("DB_PASS", "xxx");
define("DB_NAME", "xxx");

//Getting Day first
$day = date("D");
if($day == Mon){
   $today = 1;
   $todayshow = Monday;
   }else if($day == Tue){
   $today = 2;
   $todayshow = Tuesday;
   }else if($day == Wed){
   $today = 3;
   $todayshow = Wednesday;
   }else if($day == Thu){
   $today = 4;
   $todayshow = Thursday;
   }else if($day == Fri){
   $today = 5;
   $todayshow = Friday;
   }else if($day == Sat){
   $today = 6;
   $todayshow = Saturday;
   }else if($day == Sun){
   $today = 7;
   $todayshow = Sunday;
   }else{
   echo "Don't know what happened?!";
   }
//Ending Got day


?>
