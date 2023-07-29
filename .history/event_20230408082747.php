<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'already added to wishlist';
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       $message[] = 'product added to wishlist';
   }

}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/EventPlanner.css">

</head>
<body>
   
<?php @include 'header.php'; ?>



<h1 class="title">Events We Plan</h1>
   <section class="Events-container">
        
        <div id="Events">
            <div class="box">
                <img src="Img//WedDecor.jpeg" alt="">
                <h2 class="h-secondory center" ><a class="linkcolor" href="Weddings.html">Weddings</a></h2>
                <p class="center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos sit ipsa quas laborum nam harum suscipit quod inventore ducimus, quasi, facilis fugit et dolore eaque rem delectus quo est voluptatibus accusamus mollitia veniam fugiat?</p>
            </div>
        </div>
        <div id="Events">
            <div class="box">
                <img src="Img//BP1.jpg" alt="">
                <h2 class="h-secondory center" ><a class="linkcolor" href="BirthdayParty.html">Birthday Party</a></h2>
                <p class="center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos sit ipsa quas laborum nam harum suscipit quod inventore ducimus, quasi, facilis fugit et dolore eaque rem delectus quo est voluptatibus accusamus mollitia veniam fugiat?</p>
            </div>
        </div>
        <div id="Events">
            <div class="box">
                <img src="Img//GP.jpg" alt="">
                <h2 class="h-secondory center" ><a class="linkcolor" href="GanpatiFestival.html">Ganpati Festival</a></h2>
                <p class="center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos sit ipsa quas laborum nam harum suscipit quod inventore ducimus, quasi, facilis fugit et dolore eaque rem delectus quo est voluptatibus accusamus mollitia veniam fugiat?</p>
            </div>
        </div>
        <div id="Events">
            <div class="box">
                <img src="Img//CF.jpg" alt="">
                <h2 class="h-secondory center" ><a class="linkcolor" href="CollegeEvents.html">College Events</a></h2>
                <p class="center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos sit ipsa quas laborum nam harum suscipit quod inventore ducimus, quasi, facilis fugit et dolore eaque rem delectus quo est voluptatibus accusamus mollitia veniam fugiat?</p>
            </div>
        </div>
        <div id="Events">
            <div class="box">
                <img src="Img//FP.jpeg" alt="">
                <h2 class="h-secondory center" ><a class="linkcolor" href="FormalParty.html">Formal Party</a></h2>
                <p class="center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos sit ipsa quas laborum nam harum suscipit quod inventore ducimus, quasi, facilis fugit et dolore eaque rem delectus quo est voluptatibus accusamus mollitia veniam fugiat?</p>
            </div>
        </div>
    </section>
</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>