<?php 

include 'db.php';

if (! isset($_SESSION['id'])) {
    header("Location:login.php");
}
$id=$_GET['id'];
$user_id=$_SESSION['id'];

$stmt=$conn->prepare("DELETE from blogs where id=? and user_id=?");
$stmt->bind_param("ii",$id,$user_id);
$stmt->execute();
header("Location:dashboard.php");
?>