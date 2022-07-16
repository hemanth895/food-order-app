<?php include('partials/menu.php');?>
     <!--content-->
     <div class="main-content"> 
          <div class=wrapper>
               
               <h1>Manage Admin</h1>
               <br/><br/><br/>

               <!-- button to add admin-->

              <?php 
                 if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                     unset($_SESSION['add']);
                      }
               if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
               }
               if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
               }
               if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
               }
               if(isset($_SESSION['pwd-dont-match'])){
                    echo $_SESSION['pwd-dont-match'];
                    unset($_SESSION['pwd-dont-match']);
               }
               if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
               }
               if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
               }
               
            
          ?>
          <br/>
          <br/>
               <a href="add-admin.php" class="btn-primary">Add Admin</a>
               <table class="tbl-full">
                    <tr>
                    <th>sl no:</th>
                    <th>full Name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                    </tr>

                    <?php
                    $sql="SELECT * FROM admin";
                    $res=mysqli_query($conn,$sql);

                    if($res==TRUE){

                         $Count = mysqli_num_rows($res);
                         $sn=1;

                         if($Count>0){
                              while($rows=mysqli_fetch_assoc($res)){
                                   $id=$rows['id'];
                                   $full_name=$rows['fullname'];
                                   $username=$rows['username'];

                                   ?>
                                   <tr>
                    <td><?php echo $sn++ ;?></th>
                    <td><?php echo $full_name;?></td>
                    <td><?php echo $username; ?></td>
                    <td> 
                         <a href="<?php echo URL;?>/admin/change-password.php?=id<?php echo $id;?>" class="btn-primary">change password</a>
                         <a href="<?php echo URL;?>/admin/update-admin.php?id=<?php echo $id ;?>" class="btn-secondary">Update Admin </a>
                         
                         <a href="<?php echo URL;?>/admin/delete-admin.php?id=<?php echo $id ;?>" class="btn-danger">Delete Admin </a>
                    </td>
                    </tr>
                                    

                                   <?php


                              }
                         }else{

                         }

                    }
                    ?>

                    
               </table>
               
               
              
          </div>
     </div>
     <!--footer-->
    <?php include('partials/footer.php');?>
     
   