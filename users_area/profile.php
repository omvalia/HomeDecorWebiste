<?php
/*connect file*/
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php $_SESSION['username'] ?></title>
    <!--Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS Link-->
    <link rel="stylesheet" href="../style.css">
    <style>
        body{
            overflow-x:hidden;
        }
        .profile_img{
            width:90%;
            margin:auto;
            display:block;
            border-radius:50%;
            objech-fit:contain;
            margin:9px;
        }
        .edit_img{
            width:100px;
            height:100px;
            object-fit:contain;
        }
    </style>
</head>
<body>
    <!--navbar-->
    <section id="header">
        <a href="index.php"><img src="../images/logo3.png" alt="logo" class="logo" ></a>
        <div>   
            <ul id="navbar">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../display_all.php">Shop</a></li>
                <li>
                <?php
                if(!isset($_SESSION['username'])){
                    echo "<a href='user_login.php' id='navbar'>Login</a>";
                }
                else{
                    echo"<a href='./users_area/logout.php' id='navbar'>Logout</a>";
                    echo "<li><a href='profile.php' id='navbar' class='active'>Account</a></li>";
                }
                ?>
                </li>
                <li><a href="../cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item()?></sup></i></a></li>
            </ul>
        </div>
    </section>


    <!-- calling cart-->
    <?php
        cart();
    ?>

    <!--fourth child-->
    <div class="row">
        <div class="col-md-2">
            <div class="col-md-10">
            <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
                <li class="nav-item update_userprofile">
                <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
                </li>

                <?php
                   $username=$_SESSION['username'];
                   $user_image="Select * from `user_table` where username='$username'";
                   $result_image=mysqli_query($con,$user_image);
                   $row_image=mysqli_fetch_array($result_image);
                   $user_image=$row_image['user_image'];
                   echo "
                   <li class='nav-item'>
                    <img src='./user_images/$user_image' alt='image' class='profile_img my-4'>
                    </li>
                   ";
                ?>

                <li class="nav-item user_manu">
                <a class="nav-link text-light" href="profile.php">Pending Orders</a>
                </li>

                <li class="nav-item user_manu">
                <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
                </li>

                <li class="nav-item user_manu">
                <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
                </li>
                
                <li class="nav-item user_manu">
                <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
                </li>
                
                <li class="nav-item user_manu">
                <a class="nav-link text-light" href="logout.php">Log out</a>
                </li>
            </ul>
            </div>
            </div>
            <div class="col-md-10">
                <?php get_user_order_details(); 
                      if(isset($_GET['edit_account'])){
                        include('edit_account.php');
                      }
                      if(isset($_GET['my_orders'])){
                        include('user_orders.php');
                      }

                      if(isset($_GET['delete_account'])){
                        include('delete_account.php');
                      }
                ?>
            </div>
    </div>


    <!--last child-->
    <!--include footer-->
    <?php
       include('../includes/footer.php');
    ?>
    </div>
    


    <!--Bootsrap JS Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>