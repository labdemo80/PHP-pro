<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <label for="">Fname</label>
    <input type="text" name="fname">
    <label for="">Age</label>
    <input type="text" name="age">
    <label for="">Username</label>
    <input type="text" name="username">
    <label for="">Password</label>
    <input type="password" name="pass">
    <button type="submit">Submit</button>
</form>    
</body>
</html>


<?php 

include 'db.php';

if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $fname=$_POST["fname"];
    $age=$_POST["age"];
    $username=$_POST["username"];
    $pass=password_hash($_POST['pass'],PASSWORD_DEFAULT);

    $sql=$conn->prepare("insert into users(fname,age,username,password) values(?,?,?,?) ");
    $sql->bind_param("siss",$fname,$age,$username,$pass);
    $sql->execute();
    header("Location:login.php");
  
}
?>