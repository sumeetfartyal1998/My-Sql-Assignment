<?php
if(isset($_POST['sub'])){
    $name=input_field($_POST['name']);
    $uname=input_field($_POST['uname']);
    $age=$_POST['age'];
    $gender=@$_POST['gender'];
    $city=$_POST['city'];
    if(mysqli_query($conn,"update users set name='$name',uname='$uname',age='$age',gender='$gender',city='$city' where email='$uid'")){
        header("location:dashboard.php");
    }else{
        echo "can't update";
    }
}
function input_field($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }
?>
<h1 class="jumbotron">Edit Details</h1>
<form method="post" class="col-12">
    <table class="col-12">
        <tr>
            <th><label for="Name">Name :</label></th>
            <td><input type="text" class="form-control" id="name" name="name" value="<?php echo $arr['name']?>"></td>
        </tr>
        <tr>
            <th><label for="Username">Username :</label></th>
            <td><input type="text" class="form-control" id="uname" name="uname" value="<?php echo $arr['uname']?>"></td>
        </tr>
        <tr>
            <th><label for="Age">Age :</label></th>
            <td><input type="number" class="form-control" id="age" name="age" value="<?php echo $arr['age']?>"></td>
        </tr>
        <tr>
            <th><label>Gender :</label><br></th>
            <td><input type="radio"  name="gender" value="Male" <?php if($arr['gender']=="Male"){echo "checked";}?>> Male<br></td>
        </tr>
        <tr>
            <th></th>
            <td><input type="radio"  name="gender" value="Female" <?php if($arr['gender']=="Female"){echo "checked";}?>> Female</td>
        </tr>
        <tr>
            <th><label for="City">City :</label></th>
            <td><input type="text" class="form-control" id="city" name="city" value="<?php echo $arr['city']?>"></td>
        </tr>
    </table>
    <button type="submit" class="mt-4 btn btn-success" name="sub">Submit</button>
</form>