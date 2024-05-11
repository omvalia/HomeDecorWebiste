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
        <title>User Registeration</title>
        <!--Bootstrap CSS link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!--Font Awesome link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--CSS Link-->
        <link rel="stylesheet" href="../style.css">
        <?php
        $error_message = "";$success_message = "";
        if(isset($_POST['user_register'])){
            $username=$_POST['user_username'];
            $user_email=$_POST['user_email'];
            $user_password=$_POST['user_password'];
            $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
            $confirm_user_password=$_POST['confirm_user_password'];
            $user_address=$_POST['user_address'];
            $user_contact=$_POST['user_contact'];
            //Accessing image
            $user_image=$_FILES['user_image']['name'];
            $user_image_tmp=$_FILES['user_image']['tmp_name'];
            //Accessing User IP Address
            $user_ip=getIPAddress();

            $isvalid = true;

            //check the fields are empty or not 
            if($username == '' || $user_email == '' || $user_password == '' || $confirm_user_password == '' || $user_address == '' || 
            $user_contact == '' ){
                $isvalid = false;
                $error_message = "Please fill all fields.";
            }

            //User validation 
            if($isvalid && (preg_match('/[^A-Za-z0-9]/', $username))){
                $isvalid = false;
                $error_message = "Username should not contain special characters.";
            }

            // Email Validation
            if($isvalid && !(filter_var($user_email, FILTER_VALIDATE_EMAIL))) {
                $isvalid = false;
                $error_message = "Invalid email format."; 
            }


            //Check if emailid already exist
            if($isvalid){
                $stmt = $con->prepare("SELECT * FROM user_table WHERE user_email = ?");
                $stmt->bind_param('s', $user_email);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close(); if($result->num_rows > 0){
                    $isvalid = false;
                    $error_message = "Email-ID is already exists.";
                }
            }
            
            //Password Validation
            if($isvalid && !(strlen($user_password) < 8 || !preg_match('/[^A-Za-z0-9]/', $user_password) || !preg_match('/[0-9]/', $user_password) < 3)){
                $isvalid = false;
                $error_message = "Password must be at least 8 characters, contain 1 special character and 3 numbers.";
            }

            //check if the confirm password is matching or not
            if($isvalid && ($user_password != $confirm_user_password)) {
                $isvalid = false;
                $error_message = "Password does not match.";
            }

            //Contact VAlidation
            if($isvalid && !(preg_match('/^[0-9]{10}+$/', $user_contact))){
                $isvalid = false;
                $error_message = "Invalid Phone Number";
            }

            // Insert record
            if($isvalid){
                move_uploaded_file($user_image_tmp,"./user_images/$user_image");
                $insertSQL = "INSERT INTO user_table (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) VALUES (?,?,?,?,?,?,?)";
                $stmt = $con->prepare($insertSQL);
                $stmt->bind_param('sssssss', $username,$user_email,$hash_password,$user_image,$user_ip,$user_address,$user_contact);
                $stmt->execute();
                $stmt->close();
                $success_message = "Account created successfully.";
            }
        }
        ?>
    <style>
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

            <!-- Display Error message -->
            <?php
            if(!empty($error_message)) {
                ?>
                <div class="alert alert-danger">
                    <strong> Error! </strong> <?= $error_message ?>
                </div> 
                <?php
            }
            ?>
            <!-- Display Success message -->
            <?php
            if(!empty($success_message)) {
                ?>
                <div class="alert alert-success">
                    <strong> Success! </strong> <?= $success_message ?>
                </div> 
                <?php
            }
            ?>
            <div class="user_regis_page">
                <h2 class="user_regis_head">New User Registeration</h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <!--Username-->
                        <div>
                            <label for="user_username">Username</label>
                            <input type="text" class="user_regis_field" id="user_username" placeholder="Enter your username" autocomplete="off" required="required" name="user_username">
                        </div>

                        <!--Email-->
                        <div>
                            <label for="user_email">Email</label>
                            <input type="email" class="user_regis_field" id="user_email"  placeholder="Enter your email" autocomplete="off" required="required" name="user_email">
                        </div>

                        <!--UserImage-->
                        <div>
                            <label for="user_image">Image</label>
                            <input type="file" class="user_regis_field" id="user_image"  required="required" name="user_image">
                        </div>
                    
                        <!--Password-->
                        <div>
                            <label for="user_password">Password</label>
                            <input type="password" class="user_regis_field" id="user_password"  placeholder="Enter your password" autocomplete="off" required="required" name="user_password">
                        </div>
                    
                        <!--Confirm Password-->
                        <div>
                            <label for="confirm_user_password">Confirm Password</label>
                            <input type="password" class="user_regis_field" id="confirm_user_password"  placeholder="Enter your password again" autocomplete="off" required="required" name="confirm_user_password">
                        </div>

                        <!--Address-->
                        <div>
                            <label for="user_address">Address</label>
                            <input type="text" class="user_regis_field" id="user_address"  placeholder="Enter your address" autocomplete="off" required="required" name="user_address">
                        </div>
                    
                        <!--Contact-->
                        <div>
                            <label for="user_contact">Contact</label>
                            <input type="text" class="user_regis_field" id="user_contact"  placeholder="Enter your mobile number" autocomplete="off" required="required" name="user_contact">
                        </div>

                        <div>
                            <input type="submit" value="Register" class="user_regis_btn" name="user_register">
                            <p class="text-center">Already have an account? <a href="user_login.php" class="text-decoration-none" style="color:#088178; font-weight: 500"> Login</a></p>
                        </div>
                    </form>
            </div>
            <div style="margin-top:50px">
            <?php
                include('../includes/footer.php');
            ?>
            </div>
    </body>
    </html>


