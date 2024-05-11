<?php
include('../includes/connect.php');
include('../functions/common_function.php');

global $con;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Send Mail Function
function sendMail($user_email,$reset_token)
{
    require('./PHPMAILER/Exception.php');
    require('./PHPMAILER/SMTP.php');
    require('./PHPMAILER/PHPMAILER.php');
    $mail = new PHPMailer(true);

    try 
    {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'om@lancer.co.in';                     //SMTP username
        $mail->Password   = 'Kalhoonahoo@GO1874599';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;           //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('om@lancer.co.in', 'Om');
        $mail->addAddress("$user_email");     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Home Decor Website - Change Password';
        $mail->Body = 'Greetings from Home Decor Website <br>To change password click on the following link <b><a href="http://localhost/HomeDecorWebsite/users_area/reset_password.php?user_email=' . $user_email . '&reset_token=' . $reset_token . '">Click Here</a></b>';

    
        $mail->send();
        return true;
    } catch (Exception $e) 
    {
        echo "<scipt>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}


if(isset($_POST['send_mail_pass'])){
    $user_email=$_POST['user_email'];

    $select_query="select * from `user_table` where user_email='$user_email'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    if($row_count>0)
    {
        $reset_token=bin2hex(random_bytes(16)); 
        date_default_timezone_set('Asia/kolkata');
        $date=date("y-m-d");
        $update_query="update `user_table` set resettoken='$reset_token', resettokenexpire='$date' where user_email='$user_email'";
        if(mysqli_query($con,$update_query) && sendMail($user_email,$reset_token))
        {
            echo"<script>alert('Email is registered, please check your email')</script>";
            //echo"<script>window.open('../index.php','_self')</script>";
        }
        else{
            echo"<script>alert(Server down!! try again later ')</script>";
            //echo"<script>window.open('user_registeration.php','_self')</script>";
        }
    }
    else{
        echo"<script>alert('Email is not registered, please register yourself')</script>";
        //echo"<script>window.open('user_registeration.php','_self')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
        <h2 class="text-center user-head" style="margin-bottom: 5px;margin-top: 100px;color:#088178">Recover Account</h2>
        <p class="text-center" style="margin-bottom:40px">Please fill the data correctly</p>
        <div style="width: 40%">
                <form action="" method="post" >
                    <!--Email-->
                    <div>
                        <label for="user_email">Email</label>
                        <input type="email" class="user_login_field" id="user_email"  name="user_email" placeholder="Enter your email-id" autocomplete="off" required="required">
                    </div>
                
                    <div>
                        <input type="submit" value="Send Link" name="send_mail_pass"  class="user_login_btn">
                    </div>
                    <p class="text-center">To Login? <a href="user_login.php" class="text-decoration-none" style="color:#088178; font-weight: 500">Click Here </a></p>
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

