<?php include('partials/menu.php');?>
     <!--content-->
     <div class="main-content"> 
          <div class="wrapper">
               
               <h1>Manage Category</h1>
               <br/><br/><br/>
               <?php

                if(isset($_SESSION['add'])){
                  echo $_SESSION['add'];
                  unset($_SESSION['add']);
                    }
               ?>

               <br/>

               <!-- button to add admin-->
               <a href="<?php echo URL;?>/admin/add-category.php"class="btn-primary">Add Category</a>
               <table class="tbl-full">
                    <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</td>
                    <th>Actions</td>
                    </tr>

                    <?php 
                    $sql="SELECT * FROM category";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);

                    $sn=1;

                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                         $id=$row['id'];
                         $title=$row['title'];
                         $image_name=$row['image'];
                         $featured=$row['featured'];
                         $active=$row['active'];
                         ?>

                         <tr>
                         <td><?php echo $sn++;?></td>
                         <td><?php echo $title ;?></td>
                         <td>
                              <?php 
                              if($image_name!=""){
                                  ?>
                                  <img src="<?php echo URL;?>/images/category/<?php echo $image_name;?>" width="100px" >
                                  <?php
                              }else{
                                   echo "<div class='error'>Image not Added.</div>";
                              }
                              ?>
                         </td>
                         <td><?php echo $featured ;?></td>
                         <td><?php echo $active ;?></td>
                         <td>
                              <a href="#" class="btn-secondary">Update category</a>
                              <a href="#" class="btn-danger">Delete category</a>
                         </td>
                    </tr>

                         <?php
                        }
                    }else{
                         ?>

                         <tr>
                              <td>
                                   <div class="error"> no category added.</div>
                              </td>
                         </tr>
                         <?php 

                    }
                    ?>

                    
                   
               </table>
               
               
              
          </div>
     </div>
     <!--footer-->
    <?php include('partials/footer.php');?>