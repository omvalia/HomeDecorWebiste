<?php
include('../includes/connect.php');

if(isset($_GET['edit_account'])){
    $user_session_name=$_SESSION['username'];
    $select_query="select * from `user_table` where username='$user_session_name'";
    $result_query=mysqli_query($con,$select_query);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $user_id=$row_fetch['user_id'];
    $username=$row_fetch['username'];
    $user_email=$row_fetch['user_email'];
    $user_address=$row_fetch['user_address'];
    $user_mobile=$row_fetch['user_mobile'];
    $user_image=$row_fetch['user_image'];
}
else {
    $user_id = '';
    $username = '';
    $user_email = '';
    $user_address = '';
    $user_mobile = '';
    $user_image = '';
}

if(isset($_POST['user_update'])){
    $update_id=$user_id;
    $username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_address=$_POST['user_address'];
    $user_mobile=$_POST['user_mobile'];

    // Check that email and mobile are in the correct format
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        $error_message = "Invalid email format";
    }
    else if(!preg_match('/^\d{10}$/', $user_mobile)){
        $error_message = "Invalid mobile number format";
    }
    else {
        $update_image = '';
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        
        if(!empty($user_image)){
            move_uploaded_file($user_image_tmp,"./user_images/$user_image");
            $update_image="user_image='$user_image',";
        }
        
        //update query
        $update_data="update `user_table` set username='$username', user_email='$user_email',$update_image user_address='$user_address', user_mobile='$user_mobile' where user_id='$update_id'";
        $result_query_update=mysqli_query($con,$update_data);
        
        if($result_query_update){
            echo "<script>alert('Data Updated Successfully')</script>";
        }
        else{
            echo "<script>alert('Data Not Updated')</script>";
        }
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
    <div class="update_edit_account">
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4  w-50 m-auto">
            <img src="./user_images/<?php echo $user_image?>" alt="" class="edit_img upadte-profile_image">
            <input type="file" class="form-control m-auto" name="user_image" placeholder="Change your profile picture">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username ?>" name="user_username" >
        </div>

        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email ?>" name="user_email">
        </div>

        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address ?>" name="user_address">
        </div>
    
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile ?>" name="user_mobile">
        </div>
        <input type="submit" value="Update" class="user_update_btn" name="user_update">
    </form>
    </div>
</body>
</html>