<?php
if(isset($_GET['edit_brand'])){
    $edit_brand=$_GET['edit_brand'];
    $get_brand="select * from `brand` where brand_id=$edit_brand";
    $result=mysqli_query($con,$get_brand);
    $row=mysqli_fetch_assoc($result);
    $brand_name=$row['brand_name']; 
}
if(isset($_POST['edit_br'])){
    $edit_br=$_POST['brand_name'];
    $update_query="update `brand` set brand_name='$edit_br' where brand_id=$edit_brand";
    $result_br=mysqli_query($con,$update_query);
    if($result_br){
        echo"<script>alert('Brand is updated succesfully')</script>";
        echo"<script>window.open('./index.php?view_brands','_self')</script>";
    }
}
?>
<div class="container mt-3">
    <h1 class="text-center text-success my-5">Edit Brand</h1>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_name" class="form-label">Category Title</label>
            <input type="text" name="brand_name" id="brand_name" class="form-control" required="required" value='<?php echo $brand_name;?>'>
        </div>
        <input type="submit" value="Update Brand" class="admin_btn" name="edit_br">
    </form>
</div>