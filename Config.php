<?php 

define('DB_Server','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','project');

$link = mysqli_connect(DB_Server, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect." .mysqli_connect_error());
}

mysqli_set_charset($link,"utf8");




?>