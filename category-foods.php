<?php include('partials-front/menu.php');?>

<?php 

if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];

    $sql="SELECT title FROM category WHERE id=$category_id";

    $result = mysqli_query($conn,$sql);

    $row = mysqli_fetch_assoc($result);

    $category_title=$row['title'];

}else{
    header("Location: ".URL );
}
?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

            $sql2="SELECT * FROM food WHERE categoryid=$category_id";

            $res=mysqli_query($conn,$sql2);

            $count2=mysqli_num_rows($res);

            if($count2>0){
      
                while($rows2=mysqli_fetch_assoc($res)){
                    $id=$rows2['id'];
                    $title=$rows2['title'];
                    $price=$rows2['price'];
                    $description=$rows2['description'];
                    $image_name=$rows2['imagename'];

                    ?>
                    <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if($image_name=""){
                         echo "<div class='error'>IMage Not available.</div>";
                    }else{
                        ?>
                        <img src="<?php echo URL;?>/images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        <?php
                    }
                   ?>
                    
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php echo $price;?></p>
                    <p class="food-detail">
                       <?php echo $description;?>
                    </p>
                    <br>

                    <a href="<?php echo URL;?>\order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    <?php
                }
            }else{
                echo "<div class='error'>Food not available.</div>";
            }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
   <?php include('partials-front/footer.php');?>