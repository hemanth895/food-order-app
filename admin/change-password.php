<?php include('partials/menu.php');?>


<div class="main-content">
     <div class="wrapper">
          <h1>Change password</h1>;
          <br/>
<?php 
if(isset($_GET['id'])){
     $id=$_GET['id'];
}
?>
     <form action="" method="POST">
          <table class='tbl-30'>
               <tr>
                    <td>old password:</td>
                    <td>
                         <input type="password" name="old_password" placeholder="old password">

                    </td>
               </tr>
               <tr>
                    <td>new password:</td>
                    <td>
                         <input type="password" name="new_password" placeholder="new password">
                         
                    </td>
               </tr>
               <tr>
                    <td>confirm password:</td>
                    <td>
                         <input type="password" name="confirm_password" placeholder="confirm password">
                         
                    </td>
               </tr>
               <tr>
                   <td colspan="2">
                    <input type='hidden' name='id' value='<?php echo $id;?>'/>
                     <input type="submit" name="submit" value="change password" class='btn-secondary'>
                   </td>
               </tr>
</table>
</form>
</div>
</div>

<?php
if(isset($_POST['submit'])){
     echo "clicked";

     $id=$_POST['id'];
     $curpass=md5($_POST['old_password']);
     $newpass=md5($_POST['new_password']);
     $confirmPass=md5($_POST['confirm_password']);


     $sql="SELECT * FROM admin WHERE id=$id AND password='$curpass'";
     
     $res=mysqli_query($conn,$sql);

     if(res==true){
          $count=mysqli_num_rows(res);

          if(count==1){
               if($newpass==$confirmPass){
                    $sql1="UPDATE admin SET
                    password='$newpass' WHERE id=$id";
                    $res1=mysqli_query($conn,$sql1);
                    if($res1==true){
                      $_SESSION['change-pwd']='<div class="success">password vchanged successfully.</div>';
                      header('location:'.URL.'/admin/manage-admin.php');
                    }else{
                    $_SESSION['change-pwd']='<div class="error">Failed to change the password.</div>';
                    header('location:'.URL.'/admin/manage-admin.php');
                    }

               }else{
                    $_SESSION['pwd-dont-match']='<div class="error">password did not found.</div>';
               header('location:'.URL.'/admin/manage-admin.php');
               }

          }else{
               $_SESSION['user-not-found']='<div class="error">user Not found.</div>';
               header('location:'.URL.'/admin/manage-admin.php');

          }
     }
}
?>
<?php include('partials/footer.php');?>