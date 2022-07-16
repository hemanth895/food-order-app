<?php include('../config/constant.php');?>
<html>
     <head>
       <title>Login-res</title>
       <link rel="stylesheet" href="../css/admin.css">
     </head>

     <body>

          <div class="login">
            <h1  class="text-center">Login</h1>
            

            <?php
            if(isset($_SESSION['login'])){
               echo $_SESSION['login'];
               unset($_SESSION['login']);
            }
            
            if(isset($_SESSION['no-login-message']))
            {
               echo $_SESSION['no-login-message'];
               unset($_SESSION['no-login-message']);
            }
            ?>

            <form action="" method="POST"class="text-center">
               Username:<br>
               <input type="text" name="username" placeholder="enter username"><br><br>
               Password:<br>
               <input type="password" name="password" placeholder="password"><br><br>
               <input type="submit" name="submit"value="login" class=" btn-primary"><br>
               <button type="button" class="btn-primary" value="add admin">
            </form>

            <p class="text-center">Created By <a>hemanth</a></p>

          </div>

     </body>


</html>

<?php
if(isset($_POST['submit'])){


$username=$_POST['username'];
$password=md5($_POST['password']);

$sql="SELECT * FROM admin WHERE username='$username'AND password='$password'";

$res=mysqli_query($conn,$sql);

$count=mysqli_num_rows($res);


if($count==1){
$_SESSION['login']="<div class='succes' >login succesfull</div";
$_SESSION['user']=$username;
header('Location:'.URL.'/admin');

}else{
$_SESSION['login']="<div class='error' >login unsuccesfull</div";
header('Location:'.URL.'/admin/login.php');
}



}
?>