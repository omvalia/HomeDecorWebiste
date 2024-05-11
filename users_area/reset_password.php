<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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

    <?php
    if(isset($_GET['user_email']) && isset($_GET['reset_token'])) {
        date_default_timezone_set('Asia/kolkata');
        $date = date("Y-m-d");
        $query = "SELECT * FROM `user_table` WHERE user_email='{$_GET['user_email']}' AND resettoken='{$_GET['reset_token']}' AND resettokenexpire='$date'";
        $result = mysqli_query($con, $query);
        if($result) {
            if(mysqli_num_rows($result) == 1) {
                echo "
                <div class='user_login_page' style='display: flex;
                justify-content: center; align-items: center; align-content:center;
                flex-direction: column; width: 100%;'>
                    <h2 class='text-center user-head' style='margin-bottom: 5px;margin-top: 100px;color:#088178'>Change Password</h2>
                    <p class='text-center' style='margin-bottom:40px'>Enter New Password</p>
                    <div style='width: 40%'>
                        <form action='' method='post'>
                            <!--Password-->
                            <div style='padding-bottom:5px'>
                                <label for='new_user_password'>New Password</label>
                                <input type='password' class='user_login_field' id='new_user_password'  name='new_user_password' placeholder='Enter your new password' autocomplete='off' required='required'>
                            </div>
                            <!--Confirm Password-->
                            <div style='padding-bottom:5px'>
                                <label for='new_confirm_user_password'>Confirm Password</label>
                                <input type='password' class='user_login_field' id='new_confirm_user_password'  name='new_confirm_user_password'  placeholder='Enter your password again' autocomplete='off' required='required'>
                            </div>
                            <div>
                                <input type='submit' value='Reset Password' name='reset_password'  class='user_login_btn'>
                            </div>
                            <p class='text-center'>To Login? <a href='user_login.php' class='text-decoration-none' style='color:#088178; font-weight: 500'>Click Here </a></p>
                            <p class='text-center'>Don't have an account? <a href='user_registeration.php' class='text-decoration-none' style='color:#088178; font-weight: 500'> Register</a></p>
                        </form>
                    </div>
                </div>
                ";
            } else {
                echo "<script>alert('Invalid or expired link')</script>";
                echo "<script>window.open('../index.php','_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid or expired link')</script>";
            echo "<script>window.open('../index.php','_self')</script>";
        }   
    } else {
        echo "<script>alert('Server Down!! Please try later')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
    ?>
    ?>
    <div style="margin-top:50px">
    <?php
       include('../includes/footer.php');
    ?>
    </div>
</body>
</html>

<?php
if(isset($_POST['reset_password']))
{
    $new_user_password=$_POST['new_user_password'];
    $new_hash_password=password_hash($new_user_password,PASSWORD_DEFAULT);
    $new_confirm_user_password=$_POST['new_confirm_user_password'];

    $isvalid = true;
    if($new_user_password == '' || $new_confirm_user_password == ''){
        $isvalid = false;
        $error_message = "Please fill all fields.";
    }

    //Password Validation
    if($isvalid && !(strlen($new_user_password) < 8 || !preg_match('/[^A-Za-z0-9]/', $new_user_password) || !preg_match('/[0-9]/', $new_user_password) < 3)){
        $isvalid = false;
        $error_message = "Password must be at least 8 characters, contain 1 special character and 3 numbers.";
    }

    //check if the confirm password is matching or not
    if($isvalid && ($new_user_password != $new_confirm_user_password)) {
        $isvalid = false;
        $error_message = "Password does not match.";
    }

    if($isvalid){
        $update_query="update `user_table` set user_password='$new_hash_password', resettoken='NULL', resettokenexpire='NULL', user_email='$_POST[user_email]'";
        $result_br=mysqli_query($con,$update_query);
        if($result_br){
            echo"<script>alert('Password is updated succesfully')</script>";
            echo"<script>window.open('user_login.php','_self')</script>";
        }
        else{
            echo"<script>alert('Password is not updated, please try again')</script>";
        }
    }
}
?>