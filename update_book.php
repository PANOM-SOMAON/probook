<?php  
session_start(); 
include  "fucntion_query.php";
$data = $_REQUEST;

if(!file_exists($_FILES['book_detail']['tmp_name']) || !is_uploaded_file($_FILES['book_detail']['tmp_name'])) {
   $name_file =$data['files'];
}else{
	$temp = explode(".", $_FILES["book_detail"]["name"]);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	move_uploaded_file($_FILES["book_detail"]["tmp_name"], "imag/" . $newfilename);

	$name_file =  $newfilename;
}

$update = UpadateBook($data,$name_file);


header("Location: book_update.php?book_id={$data['book_id']}");
