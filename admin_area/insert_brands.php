<?php
include('../includes/connect.php');
if(isset($_POST['insert_brand'])){
    $brand_t=$_POST['brand_title'];
    //select data from database
    $select_query="Select * from `brand` where brand_name='$brand_t'";
    $result_select=mysqli_query($con,$select_query);

    $numver=mysqli_num_rows($result_select);
    if($numver>0){
        echo "<script>alert('This Brand is present inside database')</script>";
    }else{
    $insert_query="insert into `brand` (brand_name) values('$brand_t')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<script>alert('Brand has been inserted successfully')</script>";
    }
}
}
?>
<div class="container mt-3">
    <h3 class="text-center my-5" style="color: #088178">Insert Brand</h3>
    <form action="" method="post" class="text-center">
    <div class="form-outline mb-4 w-50 m-auto">
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands">
    </div>
    <div>
        <input type="submit" class="update_brand_btn admin_btn" name="insert_brand" value="Insert Brands">   
    </div>
</form>
</div>