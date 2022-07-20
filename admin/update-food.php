<?php include('partials/menu.php');?>


<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    
    $sql2="SELECT * FROM food WHERE id=$id";

    $res2=mysqli_query($conn,$sql2);

    $row=mysqli_fetch_assoc($res2);

    $title=$row['title'];
    $description=$row['description'];
    $price=$row['price'];
    $current_image=$row['imagename'];
    $current_category=$row['categoryid'];
    $featured=$row['featured'];
    $active=$row['active'];

}else{
     header("Location: ".URL.'/admin/manage-food.php');
}
?>


<div class="main-content">
     <div class="wrapper">
           <table class="tbl-30">
          <h1>Update Food</h1>

          <form action="" method="POST" enctype="multipart/form-data">
              <tr>
               <td>Title:</td>
               <td>
                    <input type="text" name="title" value="<?Php echo $title;?>">
               </td>
              </tr>
              
              
              <tr>
               <td>Decsription:</td>
               <td>
                    <textarea name="description" rows="3" cols="30"><?php echo $description;?></textarea>
               </td>
              </tr>

              <tr>
               <td>Price:</td>
               <td>
                   <input type="number" name="price" value="<?php echo $price;?>">
               </td>
              </tr>
              <tr>
               <td>Current Image:</td>
               <td>
                   <?php
                   if($current_image==""){
                    echo "<div class='error'>Image not Available</div>";
                   }else{
                    ?>
                    <img src="<?php echo URL;?>/images/food/<?php echo $current_image;?>" alt="" width="100px">
                    <?php
                   }
                   ?>
               </td>
              </tr>
              <tr>
               <td>
                    Select new image:
               </td>
               <td>
                    <input type="file" name="image">
               </td>
              </tr>
              <tr>
               <td>Category:</td>
               <td>
                    <select name="category">
                         <?php
                            $sql="SELECT * FROM category WHERE active='Yes'";

                            $res=mysqli_query($conn,$sql);

                            $count=mysqli_num_rows($res);

                            if($count>0){
                               while($row=mysqli_fetch_assoc($res)){
                                   $category_title=$row['title'];
                                   $category_id=$row['id'];

                                   // echo "<option value='$category_id'>$category_title</option>";

                                   ?>

                                   <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id?>"><?php echo $category_title;?></option>
                                   <?php
                               }
                            }{

                              echo "<option value='0'>Category Not avialble</option>";
                            }
                         ?>
                         <option value="0">Test category</option>
                    </select>
               </td>
              </tr>
              <tr>
               <td>Featured:</td>
               <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                     <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
               </td>
              </tr>
              <tr>
               <td>Active:</td>
               <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                     <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
               </td>
              </tr>
              <tr>
               <td>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="submit" name="submit" value="update food" class="btn-secondary">
               </td>
              </tr>
          </form>

          <?php

          if(isset($_POST['submit'])){
               
               $id=$_POST['id'];
               $title=$_POST['title'];
               $description=$_POST['description'];
               $price=$_POST['price'];
               $cuurent_image=$_POST['current_image'];
               $category=$_POST['category'];

               $featured=$_POST['featured'];
               $active=$_POST['active'];

               if(isset($_FILES['image']['name'])){
                    $image_name=$_FILES['image']['name'];

                    if($image_name!=""){
                         $ext=end(explode(".",$image_name));
                         $image_name="Food-name-".rand(0000,9000).'.'.$ext;

                         $srcpath=$_FILES['image']['tmp_name'];
                         $destpath="../images/food/".$image_name;

                         $upload=move_uploaded_file($srcpath,$destpath);

                         if($upload==false){
                              $_SESSION['upload']="<div class='error'>Failed to Upload new Image</div>";
                              header("Location: " .URL.'/admin/manage-food.php');
                              die();
                         }
                         if($image!=""){
                              $remove_path="../images/food/".$Current_image;
                              $remove=unlink($remove_path);

                              if($remove==false){
                                   $_SESSION['remove-failed']="<div class='error'>Failed to Remove Image</div>";
                                   header("Location: ".URL.'/admin/manage-food.php' );
                                   die();
                              }else{
                                    $image_name=$current_image;
                              }
                         }
                    }
               }else{
                    $image_name=$current_image;
               }

               $sql3="UPDATE food SET 
               title='$title',
               description='$description',
               price=$price,
               imagename='$image_name',
               categoryid='$category',
               featured='$featured',
               active='$active'
               WHERE id=$id
               ";

               $res3=mysqli_query($conn,$sql3);
               if($res3==true){
                    $_SESSION['update']="<div class='success'> Food Updated successfully.</div>";
                    header('location:'.URL.'/admin/manage-food.php');
               }
          }
          ?>
</table>
     </div>
</div>
<?php include('partials/footer.php');?>