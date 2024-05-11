<?php
//include connect file
//  include('./includes/connect.php');

// getting products
function getproducts(){
    global $con;

    //condition to check isset or not
    if(!isset($_GET['categories']))
    {
        if(!isset($_GET['brand'])){

            $select_query="select * from `products` order by rand() limit 0,4";
            $result_query=mysqli_query($con,$select_query);
            //$row=mysqli_fetch_assoc($result_query);
            //echo $row['product_title'];
            while($row=mysqli_fetch_assoc($result_query)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_description=$row['product_description'];
                $product_keywords=$row['product_keywords'];
                $product_image1=$row['product_image1'];
                $product_price=$row['product_price'];
                $category_id=$row['category_id'];
                $brand_id=$row['brand_id'];
                echo "  
                <div class='pro-container'>
                    <div class='pro'>
                        <div class='pro-img'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        </div>
                        <div class='des'>
                            <h5>$product_title</h5>
                            <h4>₹$product_price/-</h4>
                            <a class='view_more' href='product_details.php?product_id=$product_id'>View More</a>
                            <a href='index.php?add_to_cart=$product_id'><i class='fa-solid fa-cart-shopping pro_cart'></i></a>
                        </div>
                    </div>  
                </div>
        ";
    }
}
}
}

//Displaying Latest Products - New Arrivals
function getproducts_new(){
    global $con;

    //condition to check isset or not
    if(!isset($_GET['categories']) && !isset($_GET['search_data_product']))
    {
        if(!isset($_GET['brand'])){

            $select_query="select * from `products` order by product_id desc limit 0,4";
            $result_query=mysqli_query($con,$select_query);
            //$row=mysqli_fetch_assoc($result_query);
            //echo $row['product_title'];
            while($row=mysqli_fetch_assoc($result_query)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_description=$row['product_description'];
                $product_keywords=$row['product_keywords'];
                $product_image1=$row['product_image1'];
                $product_price=$row['product_price'];
                $category_id=$row['category_id'];
                $brand_id=$row['brand_id'];
                echo "  
                <div class='pro-container'>
                    <div class='pro'>
                        <div class='pro-img'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        </div>
                        <div class='des'>
                            <h5>$product_title</h5>
                            <h4>₹$product_price/-</h4>
                            <a class='view_more' href='product_details.php?product_id=$product_id'>View More</a>
                            <a href='index.php?add_to_cart=$product_id'><i class='fa-solid fa-cart-shopping pro_cart'></i></a>
                        </div>
                    </div>  
                    </div>
        ";
    }
}
}
}


//getting all products
function get_all_products(){
    global $con;

    //condition to check isset or not
    if(!isset($_GET['category']))
    {
        if(!isset($_GET['brand'])){

            $select_query="select * from `products` order by rand()";
            $result_query=mysqli_query($con,$select_query);
            //$row=mysqli_fetch_assoc($result_query);
            //echo $row['product_title'];
            while($row=mysqli_fetch_assoc($result_query)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_description=$row['product_description'];
                $product_keywords=$row['product_keywords'];
                $product_image1=$row['product_image1'];
                $product_price=$row['product_price'];
                $category_id=$row['category_id'];
                $brand_id=$row['brand_id'];
                echo "  
                <div class='pro-container-for-row'>
                    <div class='pro'>
                        <div class='pro-img'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                        </div>
                        <div class='des'>
                            <h5>$product_title</h5>
                            <h4>₹$product_price/-</h4>
                            <a class='view_more' href='product_details.php?product_id=$product_id'>View More</a>
                            <a href='index.php?add_to_cart=$product_id'><i class='fa-solid fa-cart-shopping pro_cart'></i></a>
                        </div>
                    </div>  
                </div>
        ";
    }
}
}
}


function get_unique_categories(){
    global $con;

    //condition to check isset or not
    if(isset($_GET['categories']))
    {
        $category_id=$_GET['categories'];
        $select_query= "select * from `products` where category_id=$category_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
        echo "<h3 class='text-center' style='color:#088178; margin-top:50px'>No stock for this category</h3>";
        }
    while($row=mysqli_fetch_assoc($result_query)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_keywords=$row['product_keywords'];
        $product_image1=$row['product_image1'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo "  
        <div class='pro-container-for-row'>
        <div class='pro'>
            <div class='pro-img'>
                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            </div>
            <div class='des'>
                <h5>$product_title</h5>
                <h4>₹$product_price/-</h4>
                <a class='view_more' href='product_details.php?product_id=$product_id'>View More</a>
                <a href='index.php?add_to_cart=$product_id'><i class='fa-solid fa-cart-shopping pro_cart'></i></a>
            </div>
        </div>  
    </div>
";
    }
    
}
}

// getting unique brands
function get_unique_brands(){
    global $con;

    //condition to check isset or not
    if(isset($_GET['brand']))
    {
        $brand_id=$_GET['brand'];
        $select_query= "select * from `products` where brand_id=$brand_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h3 class='text-center' style='color:#088178'>This brand is not available for service</h3>";
        }
        while($row=mysqli_fetch_assoc($result_query)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_image1=$row['product_image1'];
            $product_price=$row['product_price'];

            echo "  
            <div class='pro-container-for-row'>
            <div class='pro'>
                <div class='pro-img'>
                    <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                </div>
                <div class='des'>
                    <h5>$product_title</h5>
                    <h4>₹$product_price/-</h4>
                    <a class='view_more' href='product_details.php?product_id=$product_id'>View More</a>
                    <a href='index.php?add_to_cart=$product_id'><i class='fa-solid fa-cart-shopping pro_cart'></i></a>
                </div>
            </div>  
        </div>
            ";
        }
    }
}

//Displaying brands in side nav
function getbrands(){
    global $con;
    $select_brands='select * from `brand`';
    $result_brands=mysqli_query($con,$select_brands);
    while($row_data=mysqli_fetch_assoc($result_brands)){
        $brand_name=$row_data['brand_name'];
        $brand_id=$row_data['brand_id'];
        echo "<li class='side_nav'>
        <a href='index.php?brand=$brand_id' class='nav-link'>$brand_name</a>
    </li>";
    }
}



//Displaying categories from side nav
function getcategories(){
    global $con;
    $select_categories="Select * from `categories`";
                $result_categories=mysqli_query($con,$select_categories);
                
                //echo $row_data['categories_title'];
                //echo $row_data['categories_title'];
                while($row_data=mysqli_fetch_assoc($result_categories)){
                    $categories_title=$row_data['category_title'];
                    $category_id=$row_data['category_id'];
                    echo "<li class='side_nav'>
                    <a href='index.php?categories=$category_id' class='nav-link'>$categories_title</a>
                </li>";
                }
}


//view details function
function view_details()
{
    global $con;

    //condition to check isset or not
    if(isset($_GET['product_id']))
    {
        if(!isset($_GET['category']))
        {
            if(!isset($_GET['brand'])){

                $product_id=$_GET['product_id'];
                $select_query="select * from `products` where product_id=$product_id";
                $result_query=mysqli_query($con,$select_query);

                while($row=mysqli_fetch_assoc($result_query)){
                    $product_id=$row['product_id'];
                    $product_title=$row['product_title'];
                    $product_description=$row['product_description'];
                    $product_keywords=$row['product_keywords'];
                    $product_image1=$row['product_image1'];
                    $product_image2=$row['product_image2'];
                    $product_image3=$row['product_image3'];
                    $product_price=$row['product_price'];
                    $category_id=$row['category_id'];
                    $brand_id=$row['brand_id'];
                    echo "  
                    <section id='prodetails' class='section-p1'>
                        <div class='single-pro-img'>
                            <img src='./admin_area/product_images/$product_image1' id='main-img' alt='product'>    
                            <div class='small-img-grp'>
                                <div class='small-img-col'>
                                    <img src='./admin_area/product_images/$product_image2' class='small-img'>
                                </div>
                                <div class='small-img-col'>
                                    <img src='./admin_area/product_images/$product_image3' class='small-img'>
                                </div>  
                            </div>
                        </div>
                        <div class='single-pro-details'>
                            <h4 class='pro-title'>$product_title</h4>
                            <h4 class='pro-price'>Price:<span>Rs $product_price</span></h4>
                            <h4 class='pro-info'>$product_description</h4>
                            <a href='product_details.php?add_to_cart=$product_id'><button class='btn-pro-details' onclick='showDialog()'>Add to Cart</button></a>
                            <button class='btn-pro-details' onclick='openCamera()'>Preview</button>
                        </div>
                    </section>

                    <script>
  // get all small images
  const smallImgs = document.querySelectorAll('.small-img');
  const mainImg = document.getElementById('main-img');

  // add click event listener to each small image
  smallImgs.forEach(smallImg => {
      smallImg.addEventListener('click', function() {
          // get the image source of the clicked small image
          const smallSrc = this.getAttribute('src');
          const mainSrc = mainImg.getAttribute('src');

          // swap the src of the clicked small image and the main image
          mainImg.setAttribute('src', smallSrc);
          this.setAttribute('src', mainSrc);
      });
  });
</script>


                    <script>
                    function openCamera() {
                        const constraints = {
                            video: true
                        };
                        const video = document.createElement('video');
                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');
                    
                        // Add start and stop buttons to the dialog
                        const startButton = document.createElement('button');
                        startButton.textContent = 'Start';
                        startButton.style.backgroundColor = '#088178';
                        startButton.style.color = '#fff';
                        startButton.style.margin = '5px';
                        startButton.style.padding = '10px';
                        startButton.style.borderRadius = '5px';
                        startButton.style.borderRadius = '5px';
                        startButton.style.border = 'none';
                        startButton.style.cursor = 'pointer';
                        startButton.addEventListener('mouseover', () => {
                            startButton.style.backgroundColor = '#cce7d0';
                        });
                        startButton.addEventListener('mouseout', () => {
                            startButton.style.backgroundColor = '#088178';
                        });
                        startButton.addEventListener('click', () => {
                            navigator.mediaDevices.getUserMedia(constraints)
                                .then((stream) => {
                                    video.srcObject = stream;
                                    video.play();
                                })
                                .catch((error) => {
                                    console.error(error);
                                });
                        });
                    
                        const stopButton = document.createElement('button');
                        stopButton.textContent = 'Stop';
                        stopButton.style.backgroundColor = '#088178';
                        stopButton.style.color = '#fff';
                        stopButton.style.margin = '5px';
                        stopButton.style.padding = '10px';
                        stopButton.style.borderRadius = '5px';
                        stopButton.style.borderRadius = '5px';
                        stopButton.style.border = 'none';
                        stopButton.style.cursor = 'pointer';
                        stopButton.addEventListener('mouseover', () => {
                         stopButton.style.backgroundColor = '#cce7d0';
                        });
                        stopButton.addEventListener('mouseout', () => {
                        stopButton.style.backgroundColor = '#088178';
                        });
                        stopButton.addEventListener('click', () => {
                            // Stop the video stream and replace it with the product image
                            video.srcObject.getTracks().forEach(track => track.stop());
                            const img = document.getElementById('main-img');
                            context.drawImage(img, 0, 0, canvas.width, canvas.height);
                        });
                    
                        // Add close button to the dialog
                        const closeButton = document.createElement('button');
                        closeButton.textContent = 'X';
                        closeButton.style.backgroundColor = '#088178';
                        closeButton.style.color = '#fff';
                        closeButton.style.margin = '5px';
                        closeButton.style.padding = '10px';
                        closeButton.style.borderRadius = '5px';
                        closeButton.style.borderRadius = '5px';
                        closeButton.style.border = 'none';
                        closeButton.style.cursor = 'pointer';
                        closeButton.addEventListener('mouseover', () => {
                            closeButton.style.backgroundColor = '#cce7d0';
                        });
                        closeButton.addEventListener('mouseout', () => {
                            closeButton.style.backgroundColor = '#088178';
                        });
                        closeButton.addEventListener('click', () => {
                            dialog.close();
                        });
                    
                        const buttonContainer = document.createElement('div');
                        buttonContainer.appendChild(startButton);
                        buttonContainer.appendChild(stopButton);
                        buttonContainer.appendChild(closeButton);
                    
                        // Add the dialog to the DOM
                        const dialog = document.createElement('dialog');
                        dialog.appendChild(buttonContainer);
                        dialog.appendChild(canvas);
                        document.body.appendChild(dialog);
                        dialog.showModal();
                    
                        video.addEventListener('loadedmetadata', () => {
                            canvas.width = video.videoWidth;
                            canvas.height = video.videoHeight;
                        });
                    
                        video.addEventListener('play', () => {
                            setInterval(() => {
                                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                            }, 16);
                        });
                    }
                    </script>         
                    ";
                }
            }
        }
    }
}


//get ip address function
    function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip; 

//cart function 
function cart(){
    if(isset($_GET['add_to_cart']))
    {
        global $con;
        $get_ip_address = getIPAddress();  //::1
        $get_product_id=$_GET['add_to_cart'];
        $select_query="Select * from `cart_details` where ip_address='$get_ip_address' and product_id=$get_product_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows>0)
        {
            echo "<script>alert('This item is already present in the cart')</script>";
            echo "<script>window.open('index.php','_self')<script>";
        }else{
            $insert_query="insert into `cart_details` (product_id,ip_address,quantity) values ($get_product_id,'$get_ip_address',1)";
            $result_query=mysqli_query($con,$insert_query);
            echo "<script>alert('Item is added to cart')</script>";
            echo "<script>window.open('index.php')<script>";
        }
    }
}

//function to get cart item numbers
function cart_item(){
    if(isset($_GET['add_to_cart']))
    {
        global $con;
        $get_ip_address = getIPAddress();  //::1
        $select_query="Select * from `cart_details` where ip_address='$get_ip_address'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
    }else{
        global $con;
        $get_ip_address = getIPAddress();  //::1
        $select_query="Select * from `cart_details` where ip_address='$get_ip_address'";
        $result_query=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_query);
        }
        echo $count_cart_items;
}

// Total price function
function total_cart_price()
{
    global $con;
    $get_ip_address = getIPAddress();  //::1
    $total_price=0;
    $cart_query="Select * from `cart_details` where ip_address='$get_ip_address'";
    $result=mysqli_query($con,$cart_query);
    while($row=mysqli_fetch_array($result)){
        $product_id=$row['product_id'];
        $select_products="Select * from `products` where product_id='$product_id'";
        $result_products=mysqli_query($con,$select_products);
        while($row_product_price=mysqli_fetch_array($result_products)){
            $product_price=array($row_product_price['product_price']);
            $product_value=array_sum($product_price);
            $total_price+=$product_value;
        }
    }
    echo $total_price;
}

//get user order details
function get_user_order_details(){
    global $con;
    $username=$_SESSION['username'];
    $get_details="select * from `user_table` where username='$username'";
    $result_query=mysqli_query($con,$get_details);
    while($row_query=mysqli_fetch_array($result_query)){
        $user_id=$row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders="select * from `user_orders` where user_id=$user_id and order_status='pending'";
                    $result_orders_query=mysqli_query($con,$get_orders);
                    $row_count=mysqli_num_rows($result_orders_query);
                    if($row_count>0){
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a><p>";
                    }
                    else{
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                        <p class='text-center'><a href='../index.php' class='text-dark'>Explore Products</a><p>";
                    }
                }
            }
        }
    }
}
?>