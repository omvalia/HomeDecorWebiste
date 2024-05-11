<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <link rel="stylesheet" href="../style.css">
    <style>
    /*Print Button Hover*/
    .print_btn:hover {
    font-weight: 700;
    }
    </style>
</head>
<body>
    <?php
        $username=$_SESSION['username'];
        $get_user="select * from `user_table` where username='$username'";
        $result=mysqli_query($con,$get_user);
        $row_fetch=mysqli_fetch_assoc($result);
        $user_id=$row_fetch['user_id'];
    ?>
    <h3 class="text-success text-center" style="margin-top:50px;">All my orders</h3> 
    <table class="table table-borered mt-5">
        <thead class="update_my_order">
        <tr>
            <th>Serial No.</th>
            <th>Amount Due</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
            <th>Print</th>
        </tr>
        </thead>
        <tbody class="bg-secondary text-light">
        <?php
            $get_order_details="select * from `user_orders` where user_id=$user_id";
            $result_orders=mysqli_query($con,$get_order_details);
            $number=1;
            while($row_orders=mysqli_fetch_assoc($result_orders)){
                $order_id=$row_orders['order_id'];
                $amount_due=$row_orders['amount_due'];
                $total_products=$row_orders['total_products'];
                $invoice_number=$row_orders['invoice_number'];
                $order_status=$row_orders['order_status'];
                if($order_status=='pending'){
                    $order_status='incomplete';
                    $print_icon = 'No print';
                }
                else{
                    $order_status='complete';
                    $print_icon = '<a href="../generate_invoice.php?order_id=' . $order_id . '" target="_blank" style="color:#fff" class="print_btn"><i class="fa fa-print"></i></a>';

                }
                $order_date=$row_orders['order_date'];
                //$invoice=$row_orders['invoice'];
                echo "
                <tr>
                    <td>$number</td>
                    <td>$amount_due</td>
                    <td>$total_products</td>
                    <td>$invoice_number</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td>";
                if($order_status=='complete'){
                    echo "Paid";
                }
                else{
                    echo "<a href='confirm_payment.php?order_id=$order_id' class='text-light'>Confirm</a>";
                }
                echo "</td><td>$print_icon</td></tr>";
                $number++;
            }
        ?>
        </tbody>
    </table>   
</body>
</html>