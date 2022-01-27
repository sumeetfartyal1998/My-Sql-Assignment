<?php
include("connection.php");
error_reporting(0);
include("captcha.php");
if(isset($_POST['sub'])){
    $email=input_field($_POST['email']);
    $pass=input_field($_POST['pass']);
    $cpass=input_field($_POST['cpass']);
    $name=input_field($_POST['name']);
    $uname=input_field($_POST['uname']);
    $age=$_POST['age'];
    $gender=@$_POST['gender'];
    $city=$_POST['city'];
    $tmp=$_FILES['img']['tmp_name'];
    $captcha=$_POST['captcha'];
    $captchasum=$_POST['captchasum'];
    $err="";
    if(!empty($email) && !empty($pass) && !empty($cpass) && !empty($name) && !empty($gender) && !empty($age) && !empty($tmp) && !empty($city))
    {
        if(!preg_match("/^(([\-\w]+)\.?)+@(([\-\w]+)\.?)+\.[a-zA-Z]{2,4}$/",$email)){
            $err="Invalid email id";
        }else{
            if(!preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%&*]{6,20}$/",$pass)){
                $err="Enter a valid password";
            }else{
                if($pass!=$cpass){
                    $err="Your passwords doesn't match";
                }else{
                    if(!preg_match("/^[a-zA-Z][a-zA-Z\\s]+$/",$name)){
                        $err="Enter a valid name";
                    }else{
                        $fn=$_FILES['img']['name'];
                        $ext=pathinfo($fn,PATHINFO_EXTENSION);
                        if($ext="jpg" || $ext=="png" || $ext=="jpeg"){
                            $imgname=$uname.".jpg";
                            $imgpath="uploads/".$imgname;
                            if(move_uploaded_file($tmp,"uploads/$imgname")){
                                if(mysqli_query($conn,"insert into users(email,uname,pass,name,age,gender,city,image) values('$email','$uname','$pass','$name','$age','$gender','$city','$imgpath')")){
                                header("location:welcome.php?uid=$email");
                                }else{
                                    $err="Uploading Error 1";
                                }
                            }else{
                                $err="Image Uploading Error";
                            }
                        }else{
                            $err="Upload an image file";
                        }
                    }
                }
            }
        }  
    }else{
        $err="Please enter all your details";
    }
}
function input_field($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Registration</title>
  </head>
  <body>
    <h1 class="jumbotron">Registration</h1>
    <form class="container" method="post" enctype="multipart/form-data">
        <?php 
        if(!empty($err)){
            ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $err?>
        </div>
        <?php
        }
        ?>
        <div class="form-group"> 
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group"> 
            <label for="username">Username</label>
            <input type="text" class="form-control" id="uname" name="uname">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="pass" id="pass">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" name="cpass" id="cpass">
        </div>
        <div class="form-group"> 
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
        </div>
        <div class="form-group"> 
            <label for="Age">Age</label>
            <input type="number" class="form-control" name="age" id="age" placeholder="Enter your age">
        </div>
        <div class="form-group">
            <label>Gender</label><br>
            <input type="radio"  name="gender" value="Male" > Male<br>
            <input type="radio"  name="gender" value="Female" > Female
        </div>
        <div class="form-group"> 
            <label for="City">City</label>
            <input type="text" class="form-control" name="city" id="city"  placeholder="Enter your age">
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" name="img" id="img">
        </div>

        
        <br>
        <button type="submit" class="btn btn-primary" name="sub">Submit</button><br>

        <b>Already a user?</b><br>
      <a href="login.php">Click here</a><b> to login</b>
    </form>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>