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
    <title>Payment Page</title>
    <!--Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!--Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--CSS Link-->
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            width: 100%;
        }

        .cart_image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
</head>

<body>

    <section id="all_pro_header">
        <h2>Checkout <span>Page</span></h2>
    </section>

    <div class="your_order_container">
    <div class="row">
        <h3 class='text-center' style='color:#088178; margin-top:50px;'>Your Order</h3>
        <table class="table text-center" id="custom_table" style="width:60%; justify-content: center; margin-left:350px">
            <?php
            $user_ip = getIPAddress();
            $get_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip'";
            $result = mysqli_query($con, $get_user);
            $run_query = mysqli_fetch_array($result);
            $user_id = $run_query['user_id'];

            $get_ip_address = getIPAddress();  //::1
            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
            $result = mysqli_query($con, $cart_query);
            $result_count = mysqli_num_rows($result);
            if ($result_count > 0) {
                echo "
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Product Image<th>
                        </tr>
                    </thead>
                ";
                while ($row = mysqli_fetch_array($result)) {
                    $product_id = $row['product_id'];
                    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                    $result_products = mysqli_query($con, $select_products);
                    while ($row_product_order = mysqli_fetch_array($result_products)) {
                        $product_title = $row_product_order['product_title'];
                        $product_image1 = $row_product_order['product_image1'];
                    }
                    $select_products_qty = "SELECT * FROM `cart_details` WHERE product_id='$product_id'";
                    $result_products_qty = mysqli_query($con, $select_products_qty);
                    while ($row_product_qty = mysqli_fetch_array($result_products_qty)) {
                        $total_qty = $row_product_qty['quantity'];
                    }
                    echo "
                        <tr>
                            <td>$product_title</td>
                            <td>$total_qty</td>
                            <td><img src='../admin_area/product_images/$product_image1' alt='$product_image1' class='cart_image'></td>
                        </tr>
                    ";
                }
            } else {
                echo "
                    <tr>
                        <td colspan='3'>No items in your cart.</td>
                    </tr>
                ";
            }
            ?>
        </table>
    </div>
</div>


    <div class="user_login_page" style="display: flex;
    justify-content: center; align-items: center; align-content:center;
    flex-direction: column; width: 100%;">
        <h3 class="text-center user-head" style="margin-bottom: 20px;margin-top: 50px;color:#088178">Enter Delivery Details</h3>
        <form class="delivery-form" style="width:60%" method="post" action="order.php?user_id=<?php echo $user_id ?>">
            <label for="name">Name:</label>
            <input type="text" class="user_login_field" id="name" name="name" required autocomplete="off" placeholder="e.g. Rajesh Khanna">

            <label for="email">Email:</label>
            <input type="text" class="user_login_field" id="email" name="email" required autocomplete="off" placeholder="Enter your email address">

            <label for="address">Address:</label>
            <input type="text" class="user_login_field" id="address" name="address" required autocomplete="off" placeholder="Flat No.,Bulding Name, Area Name">

            <label for="city">City:</label>
            <input type="text" class="user_login_field" id="city" name="city" required autocomplete="off" placeholder="e.g. Mumbai">

            <label for="state">State:</label>
            <input type="text" class="user_login_field" id="state" name="state" required autocomplete="off" placeholder="e.g. Maharastra">

            <label for="zip">Pin Code:</label>
            <input type="number" class="user_login_field" id="zip" name="zip" required autocomplete="off" placeholder="Enter 6 digit Pin Code">

            <div style="margin:20px">
                <input type="submit" value="Place Order" class="user_login_btn" name="deliver_btn"></input>
            </div>
    </div>
    </form>

</body>

</html>