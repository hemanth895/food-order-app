<?php
include('../config/constant.php');
if(isset($_GET['id'] )&& isset($_GET['image_name'])){

     $id=$_GET['id'];
     $image_name=$_GET['image_name'];

     

     if($image_name!=""){
           
          $path="../images/food/".$image_name;

          $remove=unlink($path);

          if($remove==false){
               $_SESSION['upload']="<div class='error'>FAiled to remove Image.</div>";
               header('location:'.URL.'/admin/manage-food.php');
               die();
          }
     }
     $sql="DELETE FROM food WHERE id=$id";
     $res=mysqli_query($conn,$sql);
     if($res==true){
      
          $_SESSION['delete']="<div class='success'> Food deleted succesfully.</div>";
          header('location:'.URL.'/admin/manage-food.php');
     }else{

           $_SESSION['delete']="<div class='error'>Failed to delete food.</div>";
          header('location:'.URL.'/admin/manage-food.php');
     }
}else{
  $_SESSION['Unauth']="<div class='error'>Unauthorised access.</div>";
  header('location:'.URL.'/admin/manage-food.php');
}

?>