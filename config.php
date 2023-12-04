<?php

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db-app-attendance';

// Var Connection to DB 
$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
// Check connetion success
if(!$connection){
  echo "Connection to Database Failed" . mysqli_connect_error();
}

// Akses path url root
function base_url($url = null){
  $base_url = 'http://localhost/app-attendance';
  if($url != null){
    return $base_url . '/' . $url;
  }else{
    return $base_url;
  }
}
?>