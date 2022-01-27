<?php
include("connection.php");
if(isset($_POST['login'])){
  $email=input_field($_POST['email']);
  $pass=input_field($_POST['pass']);
  $err="";
  if(!empty($email) && !empty($pass)){
    if(!preg_match("/^(([\-\w]+)\.?)+@(([\-\w]+)\.?)+\.[a-zA-Z]{2,4}$/",$email)){
      $err="Please enter a valid email id";
    }else{
      if(!preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z0-9!@#$%&*]{6,20}$/",$pass)){
        $err="Enter a valid password";
      }else{
        $obj=mysqli_query($conn,"select *from users where email='$email'");
        $arr=mysqli_fetch_assoc($obj);
        $dbemail=$arr['email'];
        if(!empty($dbemail)){
          if($pass==$arr['pass']){
            session_start();
            $_SESSION['uid']=$email;
            header("location:dashboard.php");
          }else{
            $err="Invalid password";
          }
        }else{
          $err="Email id you entered is not registered";
        }
      }
    }
  }else{
    $err="Please enter your details";
  }
}

function input_field($data){
  $data=trim($data);
  $data=stripslashes($data);
  $data=htmlspecialchars($data);
  return $data;
}
?>
<script>
  function cook(){
    if("<?php echo $_COOKIE['email'];?>"!=undefined){
      if(document.getElementById("email").value=="<?php echo $_COOKIE['email']?>"){
        document.getElementById("pass").value="<?php echo $_COOKIE['password']?>";
      }else{
        document.getElementById("pass").value="";
      }
    }
  }
</script>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <h1 class="jumbotron ">Login</h1>

    <form method="post" class="container">
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
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="pass" class="form-control" id="pass">
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="rem" id="rem">
        <label class="form-check-label" for="exampleCheck1">Remember me</label>
      </div>
      <button type="submit" name="login" class="btn btn-primary">Login</button><br>
      <b>New User?</b><br>
      <a href="register.php">Click here</a><b> to register</b>
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