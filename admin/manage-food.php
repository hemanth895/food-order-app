<?php include('partials/menu.php');?>
<div class="main-content">
     <div class="wrapper">
          <h1>Manage food</h1>
          <br/><br/><br/>

          

               <!-- button to add admin-->
               <a href="<?php echo URL;?>/admin/add-food.php"class="btn-primary">Add Food</a>

               <br><br>

               <?php
                 if(isset($_SESSION['add'])){
                     echo $_SESSION['add'];
                     unset($_SESSION['add']);
                   }
                   if(isset($_SESSION['delete'])){
                     echo $_SESSION['delete'];
                     unset($_SESSION['delete']);
                   }
                   if(isset($_SESSION['upload'])){
                     echo $_SESSION['upload'];
                     unset($_SESSION['upload']);
                   }
                    if(isset($_SESSION['Unauth'])){
                     echo $_SESSION['Unauth'];
                     unset($_SESSION['Unauth']);
                   }
                   if(isset($_SESSION['update'])){
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
                   }

               ?>
               <table class="tbl-full">
                    <tr>
                    <th>id</th>
                    <th>Title:</th>
                    <th>Price:</th>
                    <th>Image:</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                    </tr>

                    <?php
                    $sql="SELECT * FROM food";

                    $res=mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);
                    $sn=1;

                    if($count>0){
                         while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['imagename'];
                            $featured=$row['featured'];
                            $active=$row['active'];


                            ?>
                                <tr>
                         <td><?php echo $sn++;?></td>
                         <td><?php echo $title;?></td>
                         <td><?php echo $price;?></td>

                         <td>
                              <?php 
                            if($image_name==""){
                              echo "<div class='error'>Image not added.</div>";
                            }else{
                              ?>

                              <img src="<?php echo URL;?>/images/food/<?php echo $image_name;?>" width="100px">
                              <?php
                            }
                         
                            ?>
                         </td>
                         <td><?php echo $featured;?></td>
                         <td><?php echo $active;?></td>

                         <td>
                              <a href="<?php echo URL;?>/admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update food</a>
                              <a href="<?php echo URL;?>/admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete food</a>
                         </td>
                    </tr>
                   
                            
                            <?php

                         }

                    }else{
                         echo "<tr><td colspan='7' class='error'>Food not added yet</td><tr>";
                    }
                    ?>

                   
               </table>
               
     </div>
</div>

<?php include('partials/footer.php');?>