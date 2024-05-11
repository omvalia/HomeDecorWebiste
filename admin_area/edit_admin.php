<?php
/*connect file*/
include('../includes/connect.php');
session_start(); // start the session for admin
if(isset($_GET['edit_admin'])){
    if(isset($_SESSION['admin_name'])) {
        $admin_session_name=$_SESSION['admin_name'];
        $select_query="SELECT * FROM `admin_table` WHERE admin_name=?";
        $stmt = mysqli_prepare($con, $select_query);
        mysqli_stmt_bind_param($stmt, "s", $admin_session_name);
        mysqli_stmt_execute($stmt);
        $result_query=mysqli_stmt_get_result($stmt);
        $row_fetch=mysqli_fetch_assoc($result_query);
        if ($row_fetch) {
            $admin_id=$row_fetch['admin_id'];
            $admin_name=$row_fetch['admin_name'];
            $admin_email=$row_fetch['admin_email'];
        } else {
            $admin_id = '';
            $admin_name = '';
            $admin_email = '';
        }
    } else {
        $admin_id = '';
        $admin_name = '';
        $admin_email = '';
    }
}
else {
    $admin_id = '';
    $admin_name = '';
    $admin_email = '';
}

if(isset($_POST['admin_update'])){
    $update_id=$admin_id;
    $admin_id=$row_fetch['admin_id'];
    $admin_name=$_POST['admin_name'];
    $admin_email=$_POST['admin_email'];

    // Check that email and mobile are in the correct format
    if(!filter_var($admin_email, FILTER_VALIDATE_EMAIL)){
        $error_message = "Invalid email format";
    }
    else {
        //update query
        $update_data="UPDATE `admin_table` SET admin_name=?, admin_email=? WHERE admin_id=?";
        $stmt = mysqli_prepare($con, $update_data);
        mysqli_stmt_bind_param($stmt, "ssi", $admin_name, $admin_email, $update_id);
        $result_query_update=mysqli_stmt_execute($stmt);
        
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
    <div class="update_edit_account" style="background-color: white;">
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $admin_name ?>" name="admin_name" >
        </div>

        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $admin_email ?>" name="admin_email">
        </div>

        <input type="submit" value="Update" class="user_update_btn" name="admin_update">
    </form>
    </div>
</body>
</html>
