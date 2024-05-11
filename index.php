<?php
/*connect file*/
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Decor E-Commerce Website</title>
    <!--Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!--CSS Link-->
    <link rel="stylesheet" href="style.css?version=1">
    <!--Google Fonts Link-->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,500;1,300;1,700&display=swap" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <?php
       include('./includes/navbar.php');
    ?>

    <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super Value deals</h2>
        <h1>On all Products</h1>
        <p>Save more with coupons $ up to 70% off</p>
        <button> <a href="display_all.php">Shop Now </a></button>
    </section>



    <section id="product1">
        <div class="pro_head">
            <h2>Featured Products</h2>
            <p>Summer Collection New Mordern Design</p>
        </div>
        <div class="product-boxes">
            <?php getproducts();
                  get_unique_categories();
                  get_unique_brands();
            ?>
        </div>
    </section>

        <!-- calling cart-->
        <?php
        cart();
    ?>

    <section id="banner" class="section-m1">
        <h4>More Products</h4>
        <h2>Explore More about our product with<span> 70% off</span> - All New Designs </h2>
        <button><a href="display_all.php" class="normal">Explore More</a></button>
    </section>

    <section id="product1">
        <div class="pro_head">
            <h2>New Arrivals</h2>
            <p>Summer Collection New Mordern Design</p>
        </div>
        <div class="product-boxes">
            <?php getproducts_new();?>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-31">
        <div class="newstext">
            <h4>Sign Up for Newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal text-light">Sign Up</button>
        </div>
    </section>

    <!--last child-->
    <!--include footer-->
    <?php
       include('./includes/footer.php');
    ?>
    </div>
    


    <!--Bootsrap JS Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>