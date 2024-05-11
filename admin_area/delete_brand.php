<?php
if(isset($_GET['delete_brand'])){
    $delete_brand=$_GET['delete_brand'];
    $delete_query="delete from `brand` where brand_id=$delete_brand";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Brand is been deleted succesfully')</script>";
        echo"<script>window.open('./index.php?view_brands','_self')</script>";;
    }
}
?>