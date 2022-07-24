<?php include('partials/menu.php');?>
<div class="main-content">
     <div class="wrapper">
          <h1>Manage Orders</h1>
          <br/><br/><br/>
           <?php 
          if(isset($_SESSION['update'])){
               echo $_SESSION['update'];
               unset($_SESSION['update']);
          }
          ?>
          <br>

               <!-- button to add admin-->
               
               <table class="tbl-full">
                    <tr>
                    <th>SN</th>
                    <th>food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>total</th>
                    <th>order Date</th>
                    <th>status</th>
                    <th>customer Name</th>
                    <th>contact</th>
                    <th>Address</th>
                    <th>email</th>
                    <th>Actions</th>
                    
                    </tr>

                    <?php 
                    $sql="SELECT * FROM orders ORDER BY id DESC";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);

                    $sn=1;


                    if($count>0){

                         while($row=mysqli_fetch_assoc($res))
                         {
                              $id=$row['id'];
                              $food=$row['food'];
                              $price=$row['price'];
                              $qty=$row['qty'];
                              $total_price=$row['total'];
                              $order_date=$row['order_date'];
                              $cust_name=$row['custname'];
                              $contact=$row['contact'];
                              $address=$row['address'];
                              $status=$row['status'];
                              $email=$row['email'];

                              ?>
                               <tr>
                         <td><?php echo $sn++;?></td>
                         <td><?php echo $food;?></td>
                         <td><?php echo $price;?></td>
                         <td><?php echo $qty;?></td>
                         <td><?php echo $total_price;?></td>
                         <td><?php echo $order_date;?></td>
                         <td>
                         <?php 
                         if($status=="ordered"){
                              echo "<label>$status</label>";
                         }
                         elseif($status=="on delivery"){
                              echo "<label style='color:orange;'>$status</label>";
                         }
                         elseif($status=="delivered"){
                               echo "<label style='color:green;'>$status</label>";
                         }else{
                               echo "<label style='color:red;'>$status</label>";
                         }
                         ?>
                         </td>

                         
                         <td><?php echo $cust_name;?></td>
                         <td><?php echo $contact;?></td>
                         <td><?php echo $address;?></td>
                         <td><?php echo $email;?></td>
                         <td>
                              <a href="<?php echo URL;?>/admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update order</a>
                              <a href="#" class="btn-danger">Delete order</a>
                         </td>
                    </tr>


                              <?php

                         }
                    }else{
                         echo "<tr><td colspan='12' class='error'>Orders not Avilable</td></tr>";
                    }
                    ?>

                   
                    
               </table>
               
     </div>
</div>

<?php include('partials/footer.php');?>