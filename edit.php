<?php 
include 'db.php';
if (! isset($_SESSION['id'])) {
    header("Location:login.php");
    exit;
}
$id=$_GET['id'];
$user_id=$_SESSION['id'];
$stmt=$conn->prepare("select * from blogs where id=? and user_id=?");
$stmt->bind_param("ii",$id,$user_id);
$stmt->execute();
$result=$stmt->get_result();
$blog=$result->fetch_assoc();
if (!$blog) {
    die("Unauthorized Person");
}
if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $title=$_POST['title'];
    $content=$_POST['content'];
    if (!empty($_FILES['image']['name'])) {
        $image_name=$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],"uploads/$image_name");
    }
    else{
        $image_name=$blog['image'];
    }
    $stmt=$conn->prepare("UPDATE blogs set title=? , content=? , image=? where id=? and user_id=?");
    $stmt->bind_param("sssii",$title,$content,$image_name,$id,$user_id);
    $stmt->execute();
    header("Location:dashboard.php");
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
<form action="" method="post" enctype="multipart/form-data">
    <label for="">Title</label>
    <input type="text" name="title" id="" value="<?= $blog['title']?>">
    <label for="">Content</label>
    <input type="text" name="content" value="<?= $blog['content']?>">
    <img src="uploads/<?= $blog['image'] ?>" alt="">
    <input type="file" name="image">
    <button type="submit">Submit</button>

</form>    

</body>
</html>