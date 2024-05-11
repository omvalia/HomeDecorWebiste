<?php
include('../includes/connect.php');

if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    $get_data="select * from `products` where product_id=$edit_id";
    $result=mysqli_query($con,$get_data);
    $row=mysqli_fetch_assoc($result);
    $product_title=$row['product_title'];
    $product_description=$row['product_description'];
    $product_keywords=$row['product_keywords'];
    $category_id=$row['category_id'];
    $brand_id=$row['brand_id'];
    $product_image1=$row['product_image1'];
    $product_image2=$row['product_image2'];
    $product_image3=$row['product_image3'];
    $product_price=$row['product_price'];

    //fetching category name
    $select_category="select * from `categories` where category_id=$category_id";
    $result_category=mysqli_query($con,$select_category);
    $row_category=mysqli_fetch_assoc($result_category);
    $category_title=$row_category['category_title'];
    //echo $category_title;

    //fetching brand name
    $select_brand="select * from `brand` where brand_id=$brand_id";
    $result_brand=mysqli_query($con,$select_brand);
    $row_brand=mysqli_fetch_assoc($result_brand);
    $brand_name=$row_brand['brand_name'];
    //echo $brand_name;
}
else {
    $product_title='';
    $product_description='';
    $product_keywords='';
    $category_id='';
    $brand_id='';
    $product_image1='';
    $product_image2='';
    $product_image3='';
    $product_price='';
}
//Updating Products
if(isset($_POST['edit_product'])){
    $product_title=$_POST['product_title'];   
    $product_description=$_POST['product_description'];   
    $product_keywords=$_POST['product_keywords'];   
    $product_category=$_POST['product_category'];   
    $product_brands=$_POST['product_brands'];    
    $product_price=$_POST['product_price'];   

    $product_image1=$_FILES['product_image1']['name'];   
    $product_image2=$_FILES['product_image2']['name'];   
    $product_image3=$_FILES['product_image3']['name']; 

    /*
    $temp_image1=$_FILES['product_image1']['tmp_name'];   
    $temp_image2=$_FILES['product_image2']['tmp_name'];   
    $temp_image3=$_FILES['product_image3']['tmp_name']; 

    move_uploaded_file($temp_image1,"./product_images/$product_image1");
    move_uploaded_file($temp_image2,"./product_images/$product_image2");
    move_uploaded_file($temp_image3,"./product_images/$product_image3");
    */

    $update_image1 = '';
    $update_image2 = '';
    $update_image3 = '';

    $product_image1=$_FILES['product_image1']['name'];
    $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];

    $user_image_tmp_1=$_FILES['product_image1']['tmp_name'];
    $user_image_tmp_2=$_FILES['product_image2']['tmp_name'];
    $user_image_tmp_3=$_FILES['product_image3']['tmp_name'];
        
    if(!empty($product_image1)){
        move_uploaded_file($user_image_tmp_1,"./product_images/$product_image1");
        $update_image1="product_image1='$product_image1',";
    }
    if(!empty($product_image2)){
        move_uploaded_file($user_image_tmp_2,"./product_images/$product_image2");
        $update_image2="product_image2='$product_image2',";
    }
    if(!empty($product_image3)){
        move_uploaded_file($user_image_tmp_3,"./product_images/$product_image3");
        $update_image3="product_image3='$product_image3',";
    }
    
    //query to update products
    $update_products="update `products` set product_title='$product_title', product_description='$product_description', product_keywords='$product_keywords', category_id=$product_category, brand_id=$product_brands, product_image1='$update_image1', product_image2='$$update_image2', product_image3='$$update_image3', product_price='$product_price', date=NOW() where product_id=$edit_id";
    $result_update=mysqli_query($con,$update_products);
    if($result_update){
        echo"<script>alert('Product updated successfully')</script>";
        echo"<script>window.open('view_products.php','self')</script>";
    }
    else{
        echo"<script>alert('Product not updated')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5">
    <h3 class="text-center" style="color:#088178">Edit Products</h3>
    <form action="" method="post" enctype=multipart/form-data>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_title" class="form-label">Product Title</label>
            <input type="text" class="form-control" value="<?php echo $product_title?>" required="required" name="product_title" id="product_title">
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
           <input type="text" class="form-control" value="<?php echo $product_description ?>" required="required" name="product_description" id="product_description">
        </div>
    
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_keywords" class="form-label">Product Keywords</label>
            <input type="text" class="form-control" value="<?php echo $product_keywords ?>" required="required" name="product_keywords" id="product_keywords">
        </div>

        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_category" class="form-label">Product Categories</label>
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_title?>"><?php echo $category_title ?></option>
                <?php
                     $select_category_all="select * from `categories`";
                     $result_category_all=mysqli_query($con,$select_category_all);
                     while($row_category_all=mysqli_fetch_assoc($result_category_all)){
                        $category_title=$row_category_all['category_title'];
                        $category_id=$row_category_all['category_id'];
                        echo" <option value='$category_id'>$category_title</option>";
                     };
                ?>
            </select>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_brands" class="form-label">Product Brands</label>
            <select name="product_brands" class="form-select">
            <option value="<?php echo $brand_name?>"> <?php echo $brand_name?> </option>
            <?php
                     $select_brand_all="select * from `brand`";
                     $result_brand_all=mysqli_query($con,$select_brand_all);
                     while($row_brand_all=mysqli_fetch_assoc($result_brand_all)){
                        $brand_name=$row_brand_all['brand_name'];
                        $brand_id=$row_brand_all['brand_id'];
                        echo" <option value='$brand_id'>$brand_name</option>";
                     };
                ?>
            </select>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image1" class="form-label">Product Image 1</label>
            <div class="d-flex">
            <input type="file" class="form-control w-90 m-auto" required="required" name="product_image1" id="product_title">
            <img src="./product_images/<?php echo $product_image1 ?>" alt="" class="product_img">    
            </div>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image2" class="form-label">Product Image 2</label>
            <div class="d-flex">
            <input type="file" class="form-control w-90 m-auto" required="required" name="product_image2" id="product_title">
            <img src="./product_images/<?php echo $product_image2 ?>" alt="" class="product_img">    
            </div>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image3" class="form-label">Product Image 3</label>
            <div class="d-flex">
            <input type="file" class="form-control w-90 m-auto" required="required" name="product_image3" id="product_title">
            <img src="./product_images/<?php echo $product_image3 ?>" alt="" class="product_img">    
            </div>
        </div>

        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" class="form-control" value="<?php echo $product_price ?>" required="required" name="product_price" id="product_title">
        </div>

        <div class="w-50 m-auto">
            <input type="submit" name="edit_product" value="Update Product" class="admin_btn">
        </div>
</div>
</body>
</html>