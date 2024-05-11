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
    <title>Ecommerce Website using PHP and MySQL</title>
    <!--Bootstrap CSS link -->  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!--CSS Link-->
    <link rel="stylesheet" href="style.css">
    <style>

    </style>
</head>
<body>
    <!--navbar-->
    <section id="header">
        <a href="index.php"><img src="./images/logo3.png" alt="logo" class="logo" ></a>
        <div>   
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="display_all.php" class="active">Shop</a></li>
                <li>
                <?php
                if(!isset($_SESSION['username'])){
                    echo "<a href='./users_area/user_login.php' id='navbar'>Login</a>";
                }
                else{
                    echo"<a href='./users_area/logout.php' id='navbar'>Logout</a>";
                    echo "<li><a href='./users_area/profile.php' id='navbar'>Account</a></li>";
                }
                ?>
                </li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item()?></sup></i></a></li>
            </ul>
        </div>
    </section>

    <section id="all_pro_header">
        <h2>View <span>All Products</span></h2>
        <p>Save more with coupons $ up to 70% off</p>
    </section>

        <section id="display_products">
        <div class="product_boxes shop_product" id="product1">
            <?php
                get_all_products();
                get_unique_brands();
                get_unique_categories();
                $ip=getIPAddress();
            ?>
        </div>
    
        <div class="filter_products">
            <ul class="navbar-nav ne-auto text-center">
                <li class="nav-item fil_pro">
                    <a href="#" class="nav-link"><h4>Brands</h4></a>
                    <?php 
                        getbrands();
                    ?>
                </li>
                <li class="nav-item fil_pro">
                    <a href="#" class="nav-link"><h4>Categories</h4></a>
                    <?php 
                        getcategories();
                    ?>
                </li>
            </ul>
        </div>
        </section>


    <section id="newsletter" class="section-p1 section-31">
        <div class="newstext">
            <h4>Sign Up for Newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
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