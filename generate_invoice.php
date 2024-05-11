<?php
/*connect file*/
include('includes/connect.php');
include('functions/common_function.php');
session_start();

//Fetching data from database 

require("./TCPDF-main/tcpdf.php");
// get the order ID from the URL parameter
$order_id = $_GET['order_id'];

// get the order details from the database
$get_order_details = "SELECT * FROM `user_orders` WHERE order_id=$order_id";
$result_order_details = mysqli_query($con, $get_order_details);
$row_order_details = mysqli_fetch_assoc($result_order_details);

$get_user_details = "SELECT * FROM `user_table` WHERE user_id=" . $row_order_details['user_id'];
$result_user_details = mysqli_query($con, $get_user_details);
$row_user_details = mysqli_fetch_assoc($result_user_details);

$get_payment_mode =  "SELECT * FROM `user_payment` WHERE order_id=$order_id";
$result_payment_mode = mysqli_query($con, $get_payment_mode);
$row_payment_mode = mysqli_fetch_assoc($result_payment_mode);


// get the delivery details from the database
$get_delivery_details = "SELECT * FROM `delivery_table` WHERE order_id=" . $row_order_details['order_id'];
$result_delivery_details = mysqli_query($con, $get_delivery_details);
$row_delivery_details = mysqli_fetch_assoc($result_delivery_details);


// create a new TCPDF object
$pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set document information
$pdf->SetCreator('Home Decor Website');
$pdf->SetAuthor('Om Valia');
$pdf->SetTitle('Purchase Invoice');
$pdf->SetSubject('Purchase Invoice');


// add a page
$pdf->AddPage();


//Displaying Header
$pdf->setFont('helvetica','B',25);
$pdf->Cell(0,22,'Home Decor Website',0,1,'C',0,'',false,'M','M');

//Displaying Address
$pdf->setFont('helvetica','B',12);
$pdf->Cell(0,15,'Usha Pravin Gandhi College,Vile Parle',0,1,'C',0,'',false,'M','M');

//Displaying Contact Details
$pdf->setFont('helvetica','',10);
$pdf->Cell(72,15,'E-mail:om@lancer.co.in',0,0,'',0,'',false,'M','M');
$pdf->Cell(50,15,'Mobile No.:9004475994',0,0,'',0,'',false,'M','M');
$pdf->Cell(50,15,'Om Valia & Harsh Limbad',0,1,'',0,'',false,'M','M');

// Removing the line below the header section
$pdf->Line(10,35,200,35);
$pdf->Line(10,37,200,37);

//Displaying Date 
$pdf->setFont('times','BI',12);
$pdf->ln(10);
$pdf->Cell(180,15,'Date: '.date("j/n/Y"),0,1,'R',0,'',0,false,'M','M');

//Displaying Username
$pdf->setFont('times','BI',12);
$pdf->Cell(180,10,'Invoice Number: ' . $row_order_details['invoice_number'],0,1,'L',0,'',0,false,'M','M');


// set font
$pdf->SetFont('helvetica', '', 12);

// output the order details
$pdf->Write(0, 'Order Date: ' . $row_order_details['order_date']);
$pdf->Ln();
$pdf->Write(0, 'Total Products: ' . $row_order_details['total_products']);
$pdf->Ln();
$pdf->Write(0, 'Amount Paid: ' . $row_order_details['amount_due']);
$pdf->Ln();

// output the payment mode details
$pdf->Write(0, 'Payment Mode: ' . $row_payment_mode['payment_mode']);
$pdf->Ln();


// output the delivery details
$pdf->Write(0, 'Delivery Details: ' . $row_delivery_details['address'] . ', ' . $row_delivery_details['city'] . '-' . $row_delivery_details['zipcode'] . ', ' . $row_delivery_details['state']);
$pdf->Ln();

/*
//Displaying Purchase Table
$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(3);
$tbl = <<<EOD
    <table border="1" cellpadding="2" cellspacing="2">
    <tr>
        <th colspan="4" align="center" style="font-size:14px; font-weight:bold">Purchase Details</th>
    </tr>  
    <tr>
        <td width="10%" style:"text-align:center; verticalfont-size:18px; font-weight:bold;"></td>
    </tr>
    </table>
EOD;

$pdf->writeHTML($tbl,true,false,false,false,'');
*/
// output the invoice
$inv_name = $row_order_details['invoice_number'];
$file_name = 'invoice-' . $inv_name . '.pdf';
$pdf->Output($file_name, 'D');
?>
