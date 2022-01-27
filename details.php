<h1 class="jumbotron">User Details</h1>
    <?php 
        if($_GET['msg']=="uploaded"){
            $success="Profile photo uploaded successfully";
            ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success?>
        </div>
        <?php
        }elseif($_GET['msg']=="Password"){
            $success="Your password has been changed successfully";
            ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success?>
        </div>
        <?php
        }else{
            $success="Your details have been updated";
            ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success?>
            </div>
        <?php
        }
      ?>
<table class="col-12">
    <tr>
        <th>Name</th>
        <td><?php echo "<b>:</b> ".$arr['name']?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?php echo "<b>:</b> ".$arr['uname']?></td>
    </tr>
    <tr>
        <th>Email id</th>
        <td><?php echo "<b>:</b> ".$arr['email']?></td>
    </tr>
    <tr>
        <th>Age</th>
        <td><?php echo "<b>:</b> ".$arr['age']?></td>
    </tr>
    <tr>
        <th>Gender</th>
        <td><?php echo "<b>:</b> ".$arr['gender']?></td>
    </tr>
    <tr>
        <th>City</th>
        <td><?php echo "<b>:</b> ".$arr['city']?></td>
    </tr>
</table>
<a href="dashboard.php?con=edit"><button type="button" class="btn btn-danger mt-4">Edit</button></a>