<?php 
include('partials/menu.php');
?>

<div class="main-content">
  <div class="wrapper">
  <h1>add Category</h1>
  <br/>

  <?php

  if(isset($_SESSION['add'])){
     echo $_SESSION['add'];
     unset($_SESSION['add']);
  }
  if(isset($_SESSION['upload'])){
     echo $_SESSION['upload'];
     unset($_SESSION['upload']);
  }
  ?>
  <br/>

  <form action="" method="POST" enctype="multipart/form-data">
     <table class="tbl-30">
          <tr>
               <td>Title:</td>
               <td>
                    <input type="text" name="title" placeholder="category title">

               </td>
          </tr>
          <tr>
               <td>Select image:</td>
               <td>
                    <input type="file" name="image">
               </td>
          </tr>

          <tr>
               <td> Featured:</td>
               <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
               </td>
          </tr>

          <tr>
               <td>Active:</td>
               <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
               </td>
          </tr>

          <tr>
               <td colspan="2">
                    <input type="submit" name="submit" value="Add category" class="btn-secondary">

               </td>
          </tr>
     </table>
  </form>

  <?php
  if(isset($_POST['submit'])){
     //echo "Clicked";
     $title=$_POST['title'];
     
     if(isset($_POST['featured'])){
          $featured=$_POST['featured'];

     }else{
          $featured="No";
     }

      if(isset($_POST['active'])){
          $active=$_POST['active'];

     }else{
          $active="No";
     }


     // print_r($_FILES['image']);
     // die();

     if(isset($_FILES['image'] ['name'])){
        $image_name=$_FILES['image']['name'];

       //auto rename image
       //explode func

       $ext=end(explode('.',$image_name));

       //rename image

       $image_name="Food_category_".rand(000,900).'.'.$ext;

        $source_path=$_FILES['image']['tmp_name'];
        $dest_path="../images/category/".$image_name;

        $upload=move_uploaded_file($source_path,$dest_path);

        if($upload==false){
          $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
          header('locations:'.URL.'admin/add-category.php');
          
          
        }
     }else{
           $image_name="";
     }



     $sql="INSERT INTO category SET 
     title='$title',
     image='$image_name',
     featured='$featured',
     active='$active'
     ";

     $res=mysqli_query($conn,$sql);

     if($res==true){
        $_SESSION['add']="<div class='success'> category added succesfully.</div>";
        header('location:'.URL.'/admin/manage-category.php');
     }else{
          $_SESSION['add']="<div class='error'> failed to add category.</div>";
        header('location:'.URL.'/admin/add-category.php');

     }

     

}
  ?>

  </div>
</div>

<?php 
include('partials/footer.php');
?>