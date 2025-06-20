<?php 
include 'db.php';
if (! isset ($_SESSION['id'])) {
    header("Location:login.php");
    exit;
}
    $user_id=$_SESSION['id'];
    $result = $conn->query("SELECT blogs .* , users.username from blogs join users on blogs.user_id=users.id");
?>
<a href="addblog.php">AddBlog</a>
<a href="logout.php">Logout</a>
<?php 
while ($row=$result->fetch_assoc()) {?>
<div style="border:2px solid black">
<h3><?= $row['title']?></h3>
<small>By: <?= $row['username']?>| <?= $row['created_at']?></small><br>
<img src="uploads/<?= $row['image']?>"  width="300px" alt=""><br>
<p><?= $row['content']?></p>
<?php 
if ($row['user_id']==$user_id) {?>
    <a href="edit.php?id=<?= $row['id']?>">Edit</a>
    <a href="delete.php?id=<?= $row['id']?>">Delete</a>
<?php }?>
</div>
<?php }?>
