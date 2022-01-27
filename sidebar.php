<?php
include("connection.php");
$uid=$_SESSION['uid'];
$obj2=mysqli_query($conn,"select image from users where email='$uid'");
$arr2=mysqli_fetch_assoc($obj2);
?>
<ul class="list-group">
  <li class="list-group-item">
  <div class="card">
    <img src="<?php echo $arr2['image']?>" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 style="font-family: 'Times New Roman', Times, serif;"><?php echo $arr['name']?></h5>
    </div> 
  </div>
  </li>
  <li class="list-group-item"><a href="?con=changeimg">Edit Profile</a></li>
  <li class="list-group-item">Category</li>
  <li class="list-group-item">Products</li>
  <li class="list-group-item">Orders</li>
</ul>