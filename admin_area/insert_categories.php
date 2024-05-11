<?php
include('../includes/connect.php');

if(isset($_POST['insert_cat'])){
    $category_t=$_POST['cat_title'];
    //select data from database
    $select_query="Select * from `categories` where category_title='$category_t'";
    $result_select=mysqli_query($con,$select_query);

    $numver=mysqli_num_rows($result_select);
    if($numver>0){
        echo "<script>alert('This category is present inside database')</script>";
    }else{
    $insert_query="insert into `categories` (category_title) values('$category_t')";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<script>alert('Category has been inserted successfully')</script>";
    }
}
}
?>
<div class="container mt-3">
    <h3 class="text-center my-5" style="color: #088178">Insert Category</h3>
    <form action="" method="post" class="text-center">
    <div class="form-outline mb-4 w-50 m-auto">
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories">
    </div>
        <input type="submit" class="update_insert_cate  admin_btn" name="insert_cat" value="Insert Category">
        
    </div>
</form>
</div>
