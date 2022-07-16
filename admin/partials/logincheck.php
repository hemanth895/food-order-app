<?php
if(!isset($_SESSION['user'])){
     $_SESSION['no-login-message']="<div class='error'>please login to access admin</div>";
     header("Location: ".URL.'/admin/login.php' );
}
?>