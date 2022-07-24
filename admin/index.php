<?php include('./partials/menu.php');?>
     <!--content-->
     <div class="main-content"> <div class=wrapper>
               <h1><strong>DASHBOARD</strong></h1>
               <div class="col-4 text-center">

               <?php 
               
               $sql="SELECT * FROM category";
               $res=mysqli_query($conn,$sql);
               $count=mysqli_num_rows($res);

               
               
               ?>
                    <h1><?php echo $count;?></h1><br/>
                    categories
               </div>
               <div class="col-4 text-center">
                    <?php 
               
               $sql2="SELECT * FROM food";
               $res2=mysqli_query($conn,$sql2);
               $count2=mysqli_num_rows($res2);

               
               
               ?>
                    <h1><?php echo $count2;?></h1><br/>
                   Foods
               </div>
               <div class="col-4 text-center">
                     <?php 
               
               $sql3="SELECT * FROM orders";
               $res3=mysqli_query($conn,$sql3);
               $count3=mysqli_num_rows($res3);

               
               
               ?>
                    <h1><?php echo $count3;?></h1><br/>
                    Orders
               </div>
               <div class="col-4 text-center">

               <?php
               
               $sql4="SELECT SUM(total) AS Total FROM orders WHERE status='delivered'";
               $res4=mysqli_query($conn,$sql4);
               $row4=mysqli_fetch_assoc($res4);

               $totalRevenue=$row4['Total'];

               ?>
                    <h1><?php echo $totalRevenue;?></h1><br/>
                    Revenue
               </div>
               <div class="clearfix"></div>
              
          </div>
     </div>
     <!--footer-->
    <?php include('partials/footer.php')?>