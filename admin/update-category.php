<?php include('partials/menu.php');?>


<div class="main-content">
     <div class="wrapper">
        <h1>UPDATE Categories</h1>
        <br>

        <?php 
        if(isset($_GET['id'])){
           $id=$_GET['id'];

          $sql="SELECT * FROM category WHERE id=$id";
          $res=mysqli_query($conn,$sql);
          $count=mysqli_num_rows($res);

          if($count==1){
             $row=mysqli_fetch_assoc($res);
             $title=$row['title'];
             $image_cur=$row['image'];
             $featured=$row['featured'];
             $active=$row['active'];


            
          }else{
               $_SESSION['no-category-found']="<div class='error' >category not found.</div>";
               header("Location: ".URL.'/admin/manage-category.php');
          }
        }else{
          header("Location: ".URL.'/admin/manage-category.php');
        }
        ?>
        

        <form method="POST" action="" enctype="multipart/form-data">
        <table class="tbl-30">
          <tr>
               <td>Title</td>
               <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
               </td>
          </tr>
          <tr>
               <td>current image:</td>
               <td>
                    <?php 
                    if($image_cur!=""){
                         ?>

                         <img src="<?php echo URL;?>/images/category/<?php echo $image_cur;?>" width="150px">;
                         <?php

                    }else{
                         echo "<div class='error'>Image not found</div>";
                    }
                    ?>
               </td>
          </tr>
          <tr>
               <td>new image:</td>
               <td>
                    <input type="file" name="image">
               </td>
          </tr>

          <tr>
               <td>Featured:</td>
               <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="feature" value="yes">Yes
                    <input <?php if($featured=="No"){echo "checked";}?>type="radio" name="feature" value="yes">No
               </td>
          </tr>

          <tr>
               <td>Active:</td>
               <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="feature" value="yes">Yes
                    <input <?php if($active=="No"){echo "checked";}?> type="radio" name="feature" value="yes">No
               </td>
          </tr>

          <tr>
               <td colspan="2">
                    <input type="hidden" name="image_cur" value="<?php echo $image_cur;?>">
                     <input type="hidden" name="id" value="<?php echo $id;?>">
               <input type="submit" name="submit" value="update category" class="btn-secondary">
               </td>
          </tr>
          </table>

          </form>
     </div>
</div>

<?php
if(isset($_POST['submit'])){
     // echo "clicked";
     $id=$_POST['id'];
     $title=$_POST['title'];
     $current_img=$_POST['image_cur'];
     $featured=$_POST['featured'];
     $active=$_POST['active'];
     
      if(isset($_FILES['image']['name'])){
                $image_name=$_FILES['image']['name'];

                if($image_name!=""){
                     $ext=end(explode('.',$image_name));

                      //rename image

                      $image_name="Food_category_".rand(000,900).'.'.$ext;

                     $source_path=$_FILES['image']['tmp_name'];
                     $dest_path="../images/category/".$image_name;

                     $upload=move_uploaded_file($source_path,$dest_path);

                      if($upload==false){
                           $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
                           header('locations:'.URL.'admin/add-category.php');
                           die();

          
                         }
                         if($image_cur!=""){
                         $remove_path="../images/category/".$image_cur;
                         $remove=unlink($remove_path);

                         if($remove==false){
                              $_SESSION['failed-remoive']="<div class='error'>failed to remove image.</div";
                              header('location:'.URL.'/admin/manage-category.php');
                              die();
                         }
                        }
                    }else{
                           $image_name=$image_cur; 
                           }
             }else{
              $image_name=$image_cur;
             }


     $sql2="UPDATE category SET
     title='$title',
     image='$image_name',
     featured='$featured',
     active='$active'
     WHERE id=$id";

     $res2=mysqli_query($conn,$sql2);

     if($res2==true) {
          $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
          header('location:'.URL.'/admin/manage-category.php');
     } else {
           $_SESSION['update']="<div class='error'>Category Updated failed.</div>";
          header('location:'.URL.'/admin/manage-category.php');
     }
     
}
?>

<?php include('partials/footer.php');?>