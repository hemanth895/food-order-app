<?php include('partials/menu.php');?>

<div class="main-content">
     <div class="wrapper">
        <h1>Add food</h1>
        <br>

        <?php
        if(isset($_SESSION['upload'])){
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
          <table class="tbl-30">
               <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="title of the food"></td>

               </tr>
               <tr>
                    <td>Description:</td>
                    <td><textarea name="description" cols="30" rows="10" placeholder="Description"></textarea></td>
               </tr>
               <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
               </tr>
               <tr>
                    <td>Select Image:</td>
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
                              $result = mysqli_query($conn,$sql);
                              $count = mysqli_num_rows($result);

                              if($count>0){
                                   while($row=mysqli_fetch_assoc($result)){
                                       $id=$row['id'];
                                       $title=$row['title'];
                                       ?>
                                       <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                       <?php 
                                   }
                              }else{
                                   ?>
                                  <option value="0">No Category found</option>
                                  <?php
                              }
                              ?>
                              
                              
                         </select>
                    </td>
               </tr>
               <tr>
                    <td>featured:</td>
                    <td>
                         <input type="radio" name="featured" value="Yes">Yes
                         <input type="radio" name="featured" value="No">No
                    </td>
               </td>
               <tr>
                    <td>Active:</td>
                    <td>
                         <input type="radio" name="Active" value="Yes">Yes
                         <input type="radio" name="Active" value="No">No
                    </td>
               </td>
               <tr>
                    <td colspan='2'>
                         <input type="submit" name="submit" value="Add food" class="btn-secondary">
                    </td>
               </tr>
         
          </table>
        </form>


        <?php
           if(isset($_POST['submit'])){
          
           //echo "clicked";
           $title=$_POST['title'];
           $description=$_POST['description'];
           $price=$_POST['price'];
           $category=$_POST['category'];

        if(isset($_POST['featured'])){
          $featured=$_POST['featured'];
        }else{
          $featured='No';
        }

        if(isset($_POST['active'])){
          $active=$_POST['active'];
        }else{
          $active='No';
        }

       

        if(isset($_FILES['image']['name']))
        {
           $image_name=$_FILES['image']['name'];
           if($image_name!=""){
               $ext=end(explode('.',$image_name));
               
               $image_name="Food-name-".rand(0000,9999).".".$ext;

               $srcpath=$_FILES['image']['tmp_name'];
               // echo $srcpath;

               $destpath="../images/food/".$image_name;

               $upload=move_uploaded_file($srcpath,$destpath);
               // echo $upload;

               if($upload==false){
                    
                    $_SESSION['upload']="<div class='error'>Failed to upload Image.</div>";
                    header('location:'.URL.'/admin/add-food.php');
                    die();
               }

           }
        }else
        {
            $image_name="";
        }

        $sql2="INSERT INTO food SET
        title='$title',
        description='$description',
        price=$price,
        imagename='$image_name',
        categoryid=$category,
        featured='$featured',
        active='$active'
        ";

        $res2=mysqli_query($conn,$sql2);

        if($res2==true){
                $_SESSION['add']="<div class='success'> Food added succesfully.</div>";
                header('location:'.URL.'/admin/manage-food.php');
        }else{
               $_SESSION['add']="<div class='error'> Failed to Add food.</div>";
                header('location:'.URL.'/admin/manage-food.php');
        }

           }
        ?>
     </div>
</div>

<?php include('partials/footer.php');?>