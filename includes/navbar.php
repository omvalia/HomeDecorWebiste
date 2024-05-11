<!DOCTYPE html>
<html lang="en">
<head>
    <!--CSS Link-->
    <link rel="stylesheet" href="style.css?version=1">
    <style>
    </style>
</head>
<body>
     <!--navbar-->
     <section id="header">
        <a href="index.php"><img src="./images/logo3.png" alt="logo" class="logo" ></a>
        <div>   
            <ul id="navbar">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="display_all.php">Shop</a></li>
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
</body>
</html>