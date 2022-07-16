<?php include('partials/menu.php');?>



<div class="main-content">
     <div class="wrapper">
          <h1>Add Admin</h1>
          <?php 
          if(isset($_SESSION['add'])){
               echo $_SESSION['add'];
               unset($_SESSION['add']);
          }
          ?>
          <br/><br/>
          <form action="" method="post" >
               <table class="tbl-30">
                    <tr>
                         <td>Full name:</td>
                         <td><input type="text" name="fullname" placeholder="enter your name"></input></td>
                    </tr>
                    <tr>
                         <td>User name:</td>
                         <td><input type="text" name="username" placeholder="enter Username"></input></td>
                    </tr>
                    <tr>
                         <td>Password:</td>
                         <td><input type="password" name="password" placeholder="enter Password"></input></td>
                    </tr>
                     <tr>
                         <td colspan="2">
                              <input type="submit" name="submit" value="add Admin" class="btn-secondary">
                         </td>
                         
                    </tr>

               </table>
          </form>
     </div>
</div>

<?php include('partials/footer.php');?>

<?php 
//isset
if(isset($_POST['submit'])){
$full_name=$_POST['fullname'];
$username=$_POST['username'];
$password=md5($_POST['password']);//encrypt


$sql="INSERT INTO admin 
SET
fullname='$full_name',
username='$username',
password='$password' 
";

//
$conn=mysqli_connect('localhost','root','')or die(mysqli_error());
//echo $conn
$db=mysqli_select_db($conn,'foodappdb')or die(mysqli_error());

$res=mysqli_query($conn,$sql)or die(mysqli_error());

if($res==TRUE){
     $_SESSION['add']="admin added successfully";
     header("location:".URL.'/admin/manage-admin.php');
}else{
      $_SESSION['add']="admin doesnot added successfully";
     header("location:".URL.'/admin/add-admin.php');
}

}

?>