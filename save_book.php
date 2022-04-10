
<?php  
session_start(); 
 include  "fucntion_query.php";
 $data = $_REQUEST;
 $_SESSION["id"];
//  $book_name = $_POST["book_name"];
//  $book_user = $_POST["book_user"];
//  $book_year = $_POST["book_year"];
//  $book_code = $_POST["book_code"];
//  $date1 =date("ymd_his");
//  $numrand = (mt_rand());
//  $book_detail= (isset($_POST['book_detail']) ? $_POST['book_detail'] :'');
//  $upload =$_FILES['book_detail']['name'];
//  if($upload !=''){
//     $path="../pro/book/imag/";
//     $type = strrchr($_FILES['book_detail']['name'],".");
//     $newname =$numrand.$date1.$type;
//     $path_copy=$path.$newname;
//     $path_link="../book_detail".$newname;
//     move_uploaded_file($_FILES['book_detail']['tmp_name'],$path_copy);
//  }

// $sql = "INSERT INTO tb_book(book_id, book_name, book_detail, book_user,  book_year, book_date, book_status, book_code)
// VALUES (NULL,'$book_name','$newname','$book_user','$book_year','','ปกติ','$book_code')";

// $result = mysqli_query($conn,$sql);
//  if($result){
//      echo "alert('เพิ่มข้อมูลสำเร็จ');";
//  }
//  else{
//      echo "alert('Error!!');";
//  }
 //print_r($data);

// $ext = end(explode(".", $_FILES["upload"]["name"]));
// $avatar = "/book/images/" . md5(uniqid()) . ".{$ext}";
// move_uploaded_file($_FILES['upload']['tmp_name'],$avatar);
// exit;
// foreach($_FILES['upload']['tmp_name'] as $key => $value){
//     $file_name = $_FILES['upload']['name'];
//     $new_name = rand(0, microtime(true)).'-'.$file_names[$key];
//     if(move_uploaded_file($_FILES['upload']['tmp_name'][$key],"images/".$new_name))
       
// }
$temp = explode(".", $_FILES["book_detail"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["book_detail"]["tmp_name"], " imag/" . $newfilename);

$file =  $newfilename;
$book = InsertBook($data,$file);



header("Location: lend.php#example");