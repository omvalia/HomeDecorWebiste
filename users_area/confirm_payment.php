<?php
include('../includes/connect.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];

    $select_data="select * from `user_orders` where order_id=$order_id";
    $result=mysqli_query($con,$select_data);
    $row_fetch=mysqli_fetch_assoc($result);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];
}

if(isset($_POST['confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];
    $insert_query="insert into `user_payment` (order_id, invoice_number, amount, payment_mode) values ($order_id,$invoice_number,$amount,'$payment_mode')";
    $result=mysqli_query($con,$insert_query);
    if($result){
      echo "<script>alert('Payment has been successfully completed')</script>";
        echo"<script>window.open('profile.php?my_orders','_self')</script>";
    }
    else
    {
      echo"<scipt>alert('Payment not completed')</scipt>";
    }
    $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
    $result_orders=mysqli_query($con,$update_orders);
}
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
  .payment-details {
    display: flex;
    justify-content: center;
    align-items: center;
    align-content:center;
    flex-direction: column;
    width: 100%;
  }

  .payment-details_heading {
    margin-bottom: 20px;
    margin-top: 50px;
    color:#088178;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
  }

  .payment-details_form {
    width: 60%;
    margin: 20px;
  }

  .payment-details_form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  .payment-details_form input[type="text"],
  .payment-details_form select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 20px;
  }

  .payment-details_form input[type="submit"] {
    background-color: #088178;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    display: block;
  }

  .payment-details_form input[type="submit"]:hover {
    background-color: #057a60;
  }
</style>
</head>
<body class="">

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
            </ul>
        </div>
    </section>

    <section id="all_pro_header">
        <h2>Payment <span>Page</span></h2>
    </section>

<div class="payment-details">
  <h3 class="payment-details_heading">Enter Payment Details</h3>
  <form class="payment-details_form" method="post">
    <label for="invoice_number">Invoice Number</label>
    <input type="text" class="user_login_field" name="invoice_number" value="<?php echo $invoice_number ?>" >

    <label for="amount">Amount</label>
    <input type="text" class="user_login_field" name="amount" value="<?php echo $amount_due ?>">

    <label for="payment_mode">Select Payment Type</label>
    <select name="payment_mode" id="payment_mode_select">
      <option>Select Payment Mode</option>
      <option>UPI</option>
      <option>Credit Card</option>
      <option>Debit Card</option>
      <option>Cash on Delivery</option>
    </select>


    <div id="upi_fields" style="display:none;">
      <label for="upi_id">UPI ID</label>
      <input type="text" class="user_login_field" name="upi_id" id="upi_id" placeholder="yourname@bankname">
    </div>

    <div id="credit_card_fields" style="display:none;">
      <label for="card_name">Name on Card</label>
      <input type="text" class="user_login_field" name="card_name" id="card_name" placeholder="Enter the Name on the Card">

      <label for="card_number">Card Number</label>
      <input type="text" class="user_login_field" name="card_number" id="card_number" placeholder="XXXX-XXXX-XXXX-XXXX">

      <label for="expire_date">Expiration Date</label>
      <input type="text" class="user_login_field" name="expire_date" id="expire_date" placeholder="MM/YYYY">

      <label for="cvv">Enter CVV</label>
      <input type="text" class="user_login_field" name="cvv" id="cvv" placeholder="Enter 3 digit CVV Number">
    </div>

    <div>
      <input type="submit" class="user_login_btn" value="Confirm" name="confirm_payment">
    </div>
  </form>


<script>
    const paymentModeSelect = document.getElementById('payment_mode_select');
    const upiFields = document.getElementById('upi_fields');
    const creditCardFields = document.getElementById('credit_card_fields');

    paymentModeSelect.addEventListener('change', (event) => {
      if (event.target.value === 'UPI') {
        upiFields.style.display = 'block';
        creditCardFields.style.display = 'none';
        captchaField.style.display = 'none';
      } else if (event.target.value === 'Credit Card' || event.target.value === 'Debit Card') {
        upiFields.style.display = 'none';
        creditCardFields.style.display = 'block';
      }
      else {
        upiFields.style.display = 'none';
        creditCardFields.style.display = 'none';
      }
    });


function validatePaymentForm() {
  const paymentModeSelect = document.getElementById('payment_mode_select');
  const upiIdField = document.getElementById('upi_id');
  const cardNameField = document.getElementById('card_name');
  const cardNumberField = document.getElementById('card_number');
  const expireDateField = document.getElementById('expire_date');
  const cvvField = document.getElementById('cvv');
  const captchaInput = document.getElementById('captcha_input');

  if (paymentModeSelect.value === 'UPI') {
    // validate UPI ID
    if (!/^[\w.-]+@[\w.-]+$/.test(upiIdField.value)) {
      alert('Invalid UPI ID. It should be in the format yourname@bankname.');
      return false;
    }
  } else if (paymentModeSelect.value === 'Credit Card' || paymentModeSelect.value === 'Debit Card') {
    // validate card name
    if (!/^[a-zA-Z ]+$/.test(cardNameField.value)) {
      alert('Invalid card name. Only alphabets and spaces are allowed.');
      return false;
    }
    // validate card number
    if (!/^([0-9]{4}-){3}[0-9]{4}$/.test(cardNumberField.value)) {
      alert('Invalid card number. It should be in the format xxxx-xxxx-xxxx-xxxx and contain only 16 digits.');
      return false;
    } else {
      const cardNumber = cardNumberField.value.replace(/-/g, ''); // remove dashes
      if (cardNumber.length !== 16) {
        alert('Invalid card number. It should contain only 16 digits.');
        return false;
      }
    }

    // validate expire date// validate expire date
    const today = new Date();
    const inputDate = new Date(expireDateField.value.replace(/^(\d{2})\/(\d{4})$/, '$2-$1-01')); // convert input date to ISO format
    if (inputDate <= today) {
      alert('Invalid expiration date. It should be greater than today\'s date.');
      return false;
    }
    if (!/^(0[1-9]|1[0-2])\/\d{4}$/.test(expireDateField.value)) {
      alert('Invalid expiration date. It should be in the format MM/YYYY.');
      return false;
    }

    // validate CVV
    if (!/^[0-9]{3}$/.test(cvvField.value)) {
      alert('Invalid CVV. It should contain only 3 digits.');
      return false;
    }
  }

  return true;
}


const cardNumberField = document.getElementById('card_number');

cardNumberField.addEventListener('input', (event) => {
  // Remove any hyphens from the card number
  const cardNumber = event.target.value.replace(/-/g, '');

  // Split the card number into chunks of 4 digits each
  const chunks = cardNumber.match(/.{1,4}/g);

  // Join the chunks with hyphens and set the formatted string as the card number field value
  if (chunks) {
    event.target.value = chunks.join('-');
  }
});


// Format expiration date as user types
const expireDateField = document.getElementById('expire_date');
expireDateField.addEventListener('input', (event) => {
  const input = event.target.value.replace(/[\W\s]/gi, ''); // remove non-alphanumeric characters
  const formattedInput = input.replace(/^(\d{2})/, '$1/'); // add '/' after first 2 characters
  event.target.value = formattedInput;
});

const confirmPaymentButton = document.querySelector('.payment-details_form [name="confirm_payment"]');
confirmPaymentButton.addEventListener('click', (event) => {
  if (!validatePaymentForm()) {
    event.preventDefault(); // prevent form submission if validation fails
  }
});

</script>

</div>
    
</body>
</html>