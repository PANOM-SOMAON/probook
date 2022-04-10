<?php  
session_start();  
include  "fucntion_query.php";


$errors = array();
if(isset($_POST['reg_user'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $number = mysqli_real_escape_string($conn,$_POST['number']);
    if (empty($username)){
        array_push($errors, "Username is required");
    }
    if (empty($password)){
        array_push($errors, "password is required");
    }
    if (empty($name)){
        array_push($errors, "name is required");
    }
    if (empty($address)){
        array_push($errors, "address is required");
    }
    if (empty($number)){
        array_push($errors, "number is required");
    }
    $user_ckeck_query = "SELECT * FROM tb_user WHERE student_id ='$username' OR name ='$name'";
    $query = mysqli_query($conn, $user_ckeck_query);
    $result = mysqli_fetch_assoc($query);

    if($result) { 
        if($result['username']=== $username) {
            array_push($errors,"username already exists");
        }
        if($result['username']=== $name) {
            array_push($errors,"name already exists");
        }
    }
    if($conn($errors)== 0){
        $password = md5($passwords);
        $sql = "INSERT INTO tb_user (student_id,password,name,address,number) VALUES ('$username','$password','$name','$address','$number)";
        mysqli_query($conn, $sql);
        $_SESSION['username'] =$username;
        $_SESSION['success'] ="you are now logged in ";
        header('location: admin-page.php');
    }
}

?> 