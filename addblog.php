
<?php 

include 'db.php';

if (! isset($_SESSION['id'])) {
    header("Location:login.php");
}

if ($_SERVER["REQUEST_METHOD"]==="POST") {
        $title=$_POST["title"];
        $content=$_POST["content"];
        $image_name=$_FILES['image']['name'];
        $user_id=$_SESSION['id'];
        move_uploaded_file( $_FILES['image']['tmp_name'] ,"uploads/$image_name");

        $sql=$conn->prepare("insert into blogs (title, content,image,user_id) values (?,?,?,?)");
        $sql->bind_param("sssi",$title,$content,$image_name,$user_id);
        $sql->execute();
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
        <input type="text" name="title">
        <label for="">Content</label>
        <textarea name="content" id=""></textarea>
        <input type="file" name="image">
        <button type="submit"> Submit</button>
    </form>
</body>
</html>