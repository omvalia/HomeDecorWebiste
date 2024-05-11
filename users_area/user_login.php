<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!--Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS Link-->
    <link rel="stylesheet" href="../style.css">
    <style>
        body{
            over-flow-x:hidden;
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
                    echo "<a href='user_login.php' id='navbar' class='active'>Login</a>";
                }
                else{
                    echo"<a href='./users_area/logout.php' id='navbar'>Logout</a>";
                    echo "<li><a href='profile.php' id='navbar'>Account</a></li>";
                }
                ?>
                </li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item()?></sup></i></a></li>
            </ul>
        </div>
    </section>


    <div class="user_login_page" style="display: flex;
    justify-content: center; align-items: center; align-content:center;
    flex-direction: column; width: 100%;">
        <h2 class="text-center user-head" style="margin-bottom: 50px;margin-top: 100px;color:#088178">User Login</h2>
        <div style="width: 40%">
                <form action="" method="post" >
                    <!--Username-->
                    <div>
                        <label for="user_username">Username</label>
                        <input type="text" class="user_login_field" id="user_username"  placeholder="Enter your username" autocomplete="off" required="required" name=user_username>
                    </div>
                
                     <!--Password-->
                     <div>
                        <label for="user_password">Password</label>
                        <input type="password" class="user_login_field" id="user_password"  placeholder="Enter your password" autocomplete="off" required="required" name=user_password>
                    </div>

                    <div>
                        <input type="submit" value="Login" name="user_login"  class="user_login_btn">
                    </div>
                    <p class="text-center">Forget your password, No worry? <a href="forget_password.php" class="text-decoration-none" style="color:#088178; font-weight: 500">Click Here </a></p>
                    <p class="text-center">Don't have an account? <a href="user_registeration.php" class="text-decoration-none" style="color:#088178; font-weight: 500"> Register</a></p>
                </form>
        </div>
    </div>
    <div style="margin-top:50px">
    <?php
       include('../includes/footer.php');
    ?>
    </div>
</body>
</html>


<!--php code-->
<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];

    $select_query="select * from `user_table` where username='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();

    //cart item
    $select_query_cart="Select * from `cart_details` where ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);
    if($row_count>0){
        $_SESSION['username']=$user_username;
        if(password_verify($user_password,$row_data['user_password'])){
            //echo"<script>alert('Login Successful')</script>";
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['username']=$user_username;
                echo"<script>alert('Login Successful')</script>";
                echo"<script>window.open('profile.php','_self')</script>";
            }else{
                $_SESSION['username']=$user_username;
                echo"<script>alert('Login Successful')</script>";
                echo"<script>window.open('../index.php','_self')</script>";
            }
        }else{
            echo"<script>alert('Invalid credientials')</script>";    
        }
    }
    else{
        echo"<script>alert('Invalid credientials')</script>";
    }
}
?>