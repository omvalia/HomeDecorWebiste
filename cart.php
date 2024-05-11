<?php
/*connect file*/
include('includes/connect.php');
include('functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <!--Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS Link-->
    <link rel="stylesheet" href="style.css">
    <style>
        .cart_image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <section id="header">
        <a href="index.php"><img src="./images/logo3.png" alt="logo" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="display_all.php" class="active">Shop</a></li>
                <li>
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<a href='./users_area/user_login.php' id='navbar'>Login</a>";
                    } else {
                        echo "<a href='./users_area/logout.php' id='navbar'>Logout</a>";
                        echo "<li><a href='./users_area/profile.php' id='navbar'>Account</a></li>";
                    }
                    ?>
                </li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item() ?></sup></i></a></li>
            </ul>
        </div>
    </section>

    <section id="all_pro_header">
        <h2>View <span>Your Cart</span></h2>
    </section>
    <!-- fourth child-->
    <div class="container">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered text-center" id="custom_table">

                    <!--php code to display dynamic data-->
                    <?php
                    global $con;
                    $get_ip_address = getIPAddress();  //::1
                    $total_price = 0;
                    $cart_query = "Select * from `cart_details` where ip_address='$get_ip_address'";
                    $total_quantity = 1;
                    $result = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    if ($result_count > 0) {
                        echo "
                        <thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Remove</th>
                            <th colspan='2'>Operations</th>
                        </tr>
                        </thead>
                        ";
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $total_quantity = $row['quantity'];
                            $select_products = "Select * from `products` where product_id='$product_id'";
                            $result_products = mysqli_query($con, $select_products);
                            while ($row_product_price = mysqli_fetch_array($result_products)) {
                                $product_price = array($row_product_price['product_price']);
                                $price_table = $row_product_price['product_price'];
                                $product_title = $row_product_price['product_title'];
                                $product_image1 = $row_product_price['product_image1'];
                                $product_value = array_sum($product_price);
                                $total_price += $product_value;

                    ?>
                                <tr>
                                    <td><?php echo $product_title ?></td>
                                    <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" alt="<?php echo $product_image1 ?>" class="cart_image"></td>
                                    <td><input type="number" class="form-input w-50" name="qty" value="<?php echo $total_quantity ?>"></td>
                                    <?php
                                    $get_ip_address = getIPAddress();  //::1
                                    if (isset($_POST['update_cart'])) {
                                        $quantity = $_POST['qty'];
                                        $update_cart = "update `cart_details` set quantity=$quantity where ip_address='$get_ip_address'";
                                        $result_products_quantity = mysqli_query($con, $update_cart);
                                        $total_price = $total_price * $quantity;
                                        $cart_query = "Select * from `cart_details` where ip_address='$get_ip_address'";
                                        $result = mysqli_query($con, $cart_query);

                                        while ($row = mysqli_fetch_array($result)) {
                                            $total_quantity = $row['quantity'];
                                        }
                                    }
                                    ?>
                                    <td><?php echo $price_table ?>/-</td>
                                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></td>
                                    <td>
                                        <!--<button class="bg-info p-2 px-3 border-0 mx-3">
                            Update
                        </button>-->
                                        <input type="submit" value="Update Cart" class="update_cart_btn" name="update_cart">
                                        <!--<button class="bg-info p-2 px-3 border-0 mx-3">Remove</button></td>-->
                                        <input type="submit" value="Remove Cart" class="update_cart_btn" name="remove_cart">
                                </tr>
                    <?php
                            }
                        }
                    } else {
                        echo "<h2 class='text-center cart_empy' >Cart is empty</h2>";
                    }
                    ?>
                    </tbody>
                </table>
                <!--subttoal-->
                <div class="d-flex mb-5">
                    <?php
                    $user_ip = getIPAddress();
                    $get_user = "select * from `user_table` where user_ip='$user_ip'";
                    $result = mysqli_query($con, $get_user);
                    $run_query = mysqli_fetch_array($result);
                    $user_id = $run_query['user_id'];

                    $get_ip_address = getIPAddress();  //::1 
                    $cart_query = "Select * from `cart_details` where ip_address='$get_ip_address'";
                    $result = mysqli_query($con, $cart_query);
                    $result_count = mysqli_num_rows($result);
                    if ($result_count > 0) {
                        echo "
                        <li class='cart_li'><h4>Subtotal: <strong style='color:#088178'>$total_price/-</strong></h4></li>
                        <li class='cart_li'><input type='submit' value='Conitnue Shopping' class='update_cart_btn' name='continue_shopping'></li>
                        <li class='cart_li'><button class='update_cart_btn'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Checkout</a></button></li>";;
                    } else {
                        echo "<input type='submit' value='Conitnue Shopping' class='update_cart_btn' name='continue_shopping'>";
                    }
                    if (isset($_POST['continue_shopping'])) {
                        echo "<script>window.open('display_all.php','_self')</script>";
                    }
                    ?>
                </div>
        </div>
    </div>
    </form>
    <!--fuction to remove items-->
    <?php
    function remove_cart_item()
    {
        global $con;
        if (isset($_POST['remove_cart'])) {
            foreach ($_POST['removeitem'] as $remove_id) {
                echo $remove_id;
                $delete_query = "delete from `cart_details` where product_id=$remove_id";
                $run_delete = mysqli_query($con, $delete_query);
                if ($run_delete) {
                    echo "<script>window.open('cart.php','_self')</script>";
                }
            }
        }
    }
    echo $remove_item = remove_cart_item();
    ?>
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

<?php
$user_ip = getIPAddress();
$get_user = "Select * from `user_table` where user_ip='$user_ip'";
$result = mysqli_query($con, $get_user);
$run_query = mysqli_fetch_array($result);
$user_id = $run_query['user_id'];
?>