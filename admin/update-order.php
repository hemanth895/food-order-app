<?php include('partials/menu.php');?>


<div class="main-content">
     <div class="wrapper">
          <h1>Update order</h1>
          <br>

          <?php 
          if(isset($_SESSION['update'])){
               echo $_SESSION['update'];
               unset($_SESSION['update']);
          }
          ?>
          <br>

          <?php 

          if(isset($_GET['id'])){

               $id = $_GET['id'];

               $sql="SELECT * FROM orders WHERE id=$id";

               $res=mysqli_query($conn,$sql);

               $count = mysqli_num_rows($res);

               if($count==1){

                    $row=mysqli_fetch_assoc($res);

                    $food=$row['food'];
                    $price=$row['price'];
                    $qty=$row['qty'];
                    $status=$row['status'];
                    $customername=$row['custname'];
                    $contact=$row['contact'];
                    $email=$row['email'];
                    $address=$row['address'];


               }else{
                     header('Location: ' .URL."/admin/manage-order.php");
               }
          }else{
               header('Location: ' .URL."/admin/manage-order.php");
          }
          ?>


          <form action="" method="POST">

          <table>
               <tr>
                    <td>Food Name:</td>
                    <td><b><?php echo $food;?></b></td>
               </tr>
               <tr>
                    <td>Price:</td>
                    <td>$<?php echo $price;?></td>
               </tr>
               <tr>
                    <td>qty:</td>
                    <td>
                         <input type="number" name="qty" value="<?php echo $qty;?>">
                    </td>
               </tr>
               <tr>
                    <td>Status:</td>
                    <td>
                         <select name="status">
                              <option value="<?php if($status=="ordered"){echo "selecteed";}?>">ordered</option>
                              <option value="<?php if($status=="on delivery"){echo "selecteed";}?>">on delivery</option>
                              <option value="<?php if($status=="delivered"){echo "selecteed";}?>">delivered</option>
                              <option value="<?php if($status=="cancelled"){echo "selecteed";}?>">cancelled</option>

                         </select>
                    </td>
               </tr>

               

               <tr>
                    <td>customer Name:</td>
                    <td>
                         <input type="text" name="custname" value="<?php echo $customername;?>">
                    </td>
               </tr>

               
               <tr>
                    <td>customer Contact:</td>
                    <td>
                         <input type="text" name="custcontact" value="<?php echo $contact;?>">
                    </td>
               </tr>

               
               <tr>
                    <td>customer email:</td>
                    <td>
                         <input type="text" name="custemail" value="<?php echo $email;?>">
                    </td>
               </tr>
               
               <tr>
                    <td>customer address:</td>
                    <td>
                         <textarea name="customer-address" id="" cols="30" rows="5"><?php echo $address;?></textarea>
                    </td>
               </tr>


               <tr>
                    
                    <td colspan="2">
                         <input type='hidden' name='id' value="<?php echo $id;?>">
                         <input type='hidden' name='price' value="<?php echo $price;?>">
                         <input type="submit" name="submit" value="update-order" class="btn-secondary">
                    </td>
               </tr>
          </table>
          </form>

          <?php 
          if(isset($_POST['submit'])){
               $id=$_POST['id'];
               $price=$_POST['price'];
               $qty=$_POST['qty'];
               $total=$price*$qty;
               $status=$_POST['status'];
               $customername=$_POST['custname'];
               $email=$_POST['custemail'];
               $contact=$_POST['custemail'];
               $address=$_POST['customer-address'];

               $sql2="UPDATE orders SET
               qty=$qty,
               total=$total,
               status='$status',
               custname='$customername',
               contact='$contact',
               email='$email',
               address='$address'
               WHERE id=$id";

               $res2=mysqli_query($conn,$sql2);

               if($res2==true){
                    $_SESSION['update']="<div class='success'>order updated successfully.</div>";
                    header('location:'.URL."/admin/manage-order.php");
               }else{

                    $_SESSION['update']="<div class='error'>failed to update order.</div>";
                    header('location:'.URL."/admin/manage-order.php");
               }
          }
          ?>
     </div>
</div>


<?php include('partials/footer.php');?>