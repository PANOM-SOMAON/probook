<?php
 session_start(); 
 $_SESSION["id"];
 include  "fucntion_query.php";

 //print_r($_POST['book_id']);
$student_id = $_POST["student_id"];
$data = $_POST['detail_id'];
$fine = $_POST['fine'];
$book_status = $_POST['book_statue'];

$i= 0;
foreach ($data as $key => $value) {

   $update = UpdateDataLend($value,$fine[$i]);
 
   $update_get =GetDataBooks($value,'ปกติ');
   $update_status = UpdatestatusBook($value,'ปกติ');
   $i++;
}

header("Location: returns.php#example");
