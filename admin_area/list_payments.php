<h3 class="text-center text-success">All Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        $get_payment="select * from `user_payment`";
        $result=mysqli_query($con,$get_payment);
        $row_count=mysqli_num_rows($result);
        if($row_count==0){
            echo"<h2 class='text-danger-danger text-center mt-5'>No payments received yet</h2>";
        }
        else{
        echo "
        <tr class='text-center' style='background-color: #088178'>
        <th>Serial Number</th>
        <th>Invoice Number</th>
        <th>Amount</th>
        <th>Payment Mode</th>
        <th>Order Date</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody class='bg-secondary text-light'>
    ";
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $payment_id=$row_data['payment_id'];
        $invoice_number=$row_data['invoice_number'];
        $amount=$row_data['amount'];
        $date=$row_data['date'];
        $payment_mode=$row_data['payment_mode'];
        $number++;
        echo"
        <tr class='text-center'>
        <td>$number</td>
        <td>$invoice_number</td>
        <td>$amount</td>
        <td>$payment_mode</td>
        <td>$date</td>
        <td><a href='index.php?delete_list_orders' type='button' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
        </tr>
        ";
    }
}
?>

    </tbody>
</table>