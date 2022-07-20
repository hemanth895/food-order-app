<?php
include('../config/constant.php');
if(isset($_GET['id']) AND isset($_GET['image_name'])){
   $id=$_GET['id'];
   $image_name=$_GET['image_name'];
   

   if($image_name!==""){
     $path="../images/category/".$image_name;
     $remove=unlink($path);
     if($remove==false){
       $_SESSION['remove']="<div class='error'>Failed to Remove Category Image.</div>";
       header('Location:'.URL.'/admin/manage-category.php');
       die();
     }
   }

   $sql="DELETE FROM category WHERE id=$id";
   $res=mysqli_query($conn,$sql);

   if($res==true){
     $_SESSION['delete']="<div class='succes'>category deleted successfully</div>";
     header('location:'.URL.'/admin/manage-category.php');
   }else{
      $_SESSION['delete']="<div class='error'>failed to delete category</div>";
     header('location:'.URL.'/admin/manage-category.php');
   }
}else{
     header('Location:'.URL.'/admin/manage-category.php');
}

?>