<?php
include('../Config/constant.php');
//create quiery to delete
$id =$_GET['id'];

$sql="DELETE FROM admin WHERE id=$id";

$res=mysqli_query($conn,$sql);

if($res==true){
//echo "admin deleted";
$_SESSION['delete']="<div class='success'>admin deleted succesfully</div";
header('location:'.URL.'/admin/manage-admin.php');
}else{
//echo "failed to delete";
$_SESSION['delete']="<div class='error'>failed to delete admin</div>";
header('location:'.URL.'/admin/manage-admin.php');

}
?>