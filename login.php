<?php 

include 'db.php';

if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $username=$_POST["username"];
    $pass=$_POST["pass"];

    $sql=$conn->prepare("select id,password from users where username=?");
    $sql->bind_param("s",$username);
    $sql->execute();
    $sql->store_result();
    $sql->bind_result($id,$password);

    if ($sql->fetch() && password_verify($pass,$password)) {
        $_SESSION['username']=$username;
        $_SESSION['id']=$id;
        header("Location:dashboard.php");
    }
  
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <label for="">Username</label>
    <input type="text" name="username">
    <label for="">Password</label>
    <input type="password" name="pass">
    <button type="submit">Submit</button>
</form>    
</body>
</html>