<?php include('partials/menu.php');?>
<div class="main-content">
   <div class="wrapper">
     <h1>update Admin</h1>

     <?php
     $id=$_GET['id'];
     $sql="SELECT * FROM admin WHERE id=$id";
     $res=mysqli_query($conn,$sql);

     if($res==true){
         $count=mysqli_num_rows($res);
         if($count==1){
           //echo "admin available";
           $row=mysqli_fetch_assoc($res);
           $full_name=$row['fullname'];
           $username=$row['username'];
         }else{
          header("Location: " .URL.'/admin/manage-admin.php');
         }
     }
     ?>
     <br/>
     <form action="" method="POST">
          <table class="tbl-30">
               <tr>
                <td>FullName:</td>
                <td>
                    <input type="text" name="full_name" value="<?php echo $full_name;?>">
                </td>
               </tr>
               <tr>
                    <td>USERNAME:</td>
                    <td>
                         <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
               </tr>
               <tr>
                    <td colspan="2">
                         <input tye="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" name="submit" value="update admin" class="btn-secondary"/>
                    </td>
               </tr>
          </table>
     </div>
</div>
<?php
if(isset($_POST['submit'])){
     
     //echo "buttom clicked";
    $id=$_POST['id'];
    $fullname=$_POST['full_name'];
    $username=$_POST['username'];

    $sql = "UPDATE admin SET fullname='$fullname', username='$username' WHERE id='$id'";
    $res=mysqli_query($conn,$sql);
    if($res==true){
     $_SESSION['update']="<div class='success'>admin updated succesfully</div>";
     header('Location:'.URL.'\admin\manage-admin.php');
    }else{
     $_SESSION['update']="<div class='error'>failed to delete admin</div>";
     header('Location:'.URL.'\admin\manage-admin.php');
    }
}
?>
<?php include('partials/footer.php');?>

