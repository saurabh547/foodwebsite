<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<?php
// including database file
// include("./includes/connect.php");

// getting products
function getproducts()
{
    global $con;

    // condition to check isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {


            $select_query = "select * from `products` order by rand() LIMIT 0,9";
            $result_query = mysqli_query($con, $select_query);
            // $row = mysqli_fetch_assoc($result_query);
            // echo $row['product_title'];
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];

                echo "<div class='col-md-4 mb-4 '>
                        <div class='card m-auto cardstyle h-100' >
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top img-border' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price:- $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div> ";


            }

        }
    }
}

// getting all products
function get_all_products()
{
    global $con;

    // condition to check isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {


            $select_query = "select * from `products` order by rand()";
            $result_query = mysqli_query($con, $select_query);
            // $row = mysqli_fetch_assoc($result_query);
            // echo $row['product_title'];
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];

                echo "<div class='col-md-4 mb-4 '>
                        <div class='card m-auto cardstyle h-100' >
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top img-border' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price:- $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id'  class='btn btn-primary'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div> ";

            }

        }
    }
}

// getting unique categories
function get_unique_categories()
{
    global $con;

    // condition to check isset or not
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];


        $select_query = "select * from `products` where category_id= $category_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this category </h2>";
        }


        // $row = mysqli_fetch_assoc($result_query);
        // echo $row['product_title'];
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];

            echo "<div class='col-md-4 mb-4 '>
                        <div class='card m-auto cardstyle h-100' >
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top img-border' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price:- $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                              <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div> ";

        }


    }
}


// getting unique brands
function get_unique_brands()
{
    global $con;

    // condition to check isset or not
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];


        $select_query = "select * from `products` where brand_id= $brand_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>This brand is not available for service </h2>";
        }


        // $row = mysqli_fetch_assoc($result_query);
        // echo $row['product_title'];
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];

            echo "<div class='col-md-4 mb-4 '>
                        <div class='card m-auto cardstyle h-100' >
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top img-border' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price:- $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div> ";

        }


    }
}



// displaying brands  
function getbrands()
{
    global $con;
    $select_brands = "select * from `brands`";
    $result_brands = mysqli_query($con, $select_brands);
    // $row_data = mysqli_fetch_assoc($result_brands);
    // echo $row_data['brand_title'];
    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['brand_title'];
        $brand_id = $row_data['brand_id'];
        echo " <li class='nav-item text-start px-2'>
                        <a href='index.php?brand=$brand_id' class='nav-link text-light'>
                            $brand_title
                        </a>
                    </li>";
    }
}


// displaying categories function

function getcategories()
{
    global $con;
    $select_categories = "select * from `categories`";
    $result_categories = mysqli_query($con, $select_categories);
    // $row_data = mysqli_fetch_assoc($result_brands);
    // echo $row_data['brand_title'];
    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo " <li class='nav-item text-start px-2'>
                        <a href='index.php?category=$category_id' class='nav-link text-light'>
                            $category_title
                        </a>
                    </li>";
    }
}


// searching products function

function search_product()
{
    global $con;
    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $select_query = "select * from `products` where product_keywords like '%$search_data_value%'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2 class='text-center text-danger'>No result match. no products found on this category!</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];

            echo "<div class='col-md-4 mb-4 '>
                        <div class='card m-auto cardstyle h-100' >
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top img-border' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price:- $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary' >Add to cart</a>
                               <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div> ";

        }

    }
}



// view details function
function view_details()
{
    global $con;

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        $select_query = "SELECT * FROM `products` WHERE product_id = $product_id";
        $result_query = mysqli_query($con, $select_query);

        if ($row = mysqli_fetch_assoc($result_query)) {
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_image2 = $row['product_image2'];
            $product_image3 = $row['product_image3'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];

            echo "<div class='col-md-4 mb-4'>
                    <div class='card m-auto cardstyle h-100'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top img-border' alt='$product_title'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price:- $product_price/-</p>
                              
                                <a href='index.php?add_to_cart=$product_id'  class='btn btn-primary'>Add to Cart</a>
 
                        
                            <a href='./user_area/payment.php' class='btn btn-secondary mx-2'>Buy</a>
                        </div>
                    </div>
                </div>";

            echo "<div class='col-md-8'>
                    <!-- related images -->
                    <div class='row'>
                        <div class='col-md-12'>
                            <h4 class='text-center mb-4'>Related products</h4>
                        </div>
                        <div class='col-md-6'>
                            <img src='./admin_area/product_images/$product_image2' class='card-img-top img-border' alt='$product_title'>
                        </div>
                        <div class='col-md-6'>
                            <img src='./admin_area/product_images/$product_image3' class='card-img-top img-border' alt='$product_title'>
                        </div>
                    </div>
                </div>";
        } else {
            echo "Product not found.";
        }
    }
}


// get ip address function

function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}






// function cart()
// {
//     global $con;

//     if (isset($_GET['add_to_cart'])) {
//         $get_ip_add = mysqli_real_escape_string($con, getIPAddress());
//         $get_product_id = (int) $_GET['add_to_cart'];

//         // Check if the product is already in the cart
//         $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add' AND product_id=$get_product_id";
//         $result_query = mysqli_query($con, $select_query);

//         if (!$result_query) {
//             die("Database query failed: " . mysqli_error($con));
//         }

//         $num_of_rows = mysqli_num_rows($result_query);

//         if ($num_of_rows > 0) {
//             echo "<script>alert('This item is already present inside the cart')</script>";
//         } else {
//             // Insert the product into the cart
//             $insert_query = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ($get_product_id, '$get_ip_add', 1)";
//             $result_query = mysqli_query($con, $insert_query);

//             if (!$result_query) {
//                 die("Database query failed: " . mysqli_error($con));
//             } else {
//                 echo "<script>alert('Product was added to your cart','_self')</script>";

//             }
//         }

//         // Redirect to the index.php page after displaying the alert
//         echo "<script>window.open('index.php','_self')</script>";
//     }
// }


function cart()
{
    global $con;

    if (isset($_GET['add_to_cart'])) {
        $get_ip_add = mysqli_real_escape_string($con, getIPAddress());
        $get_product_id = (int) $_GET['add_to_cart'];

        // Check if the product is already in the cart
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add' AND product_id=$get_product_id";
        $result_query = mysqli_query($con, $select_query);

        if (!$result_query) {
            die("Database query failed: " . mysqli_error($con));
        }

        $num_of_rows = mysqli_num_rows($result_query);

        if ($num_of_rows > 0) {
            // Custom alert with styling
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:84%";>
          <strong>Error!</strong> This item already in cart
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        } else {
            // Insert the product into the cart
            $insert_query = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ($get_product_id, '$get_ip_add', 1)";
            $result_query = mysqli_query($con, $insert_query);

            if (!$result_query) {
                die("Database query failed: " . mysqli_error($con));
            } else {
                // Custom alert with styling
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="width:84%";>
          <strong>Success!</strong> Your Product added to the cart successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
            }
        }

        // Redirect to the index.php page after displaying the alert
        // echo "<script>window.open('index.php','_self')</script>";
    }
}











// function to get cart item numbers
function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_add = getIPAddress();
        $select_query = "Select * from cart_details where ip_address='$get_ip_add'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);

    } else {
        global $con;
        $get_ip_add = getIPAddress();
        $select_query = "Select * from cart_details where ip_address='$get_ip_add'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}


// total cart price function

function total_cart_price()
{
    global $con;
    $get_ip_add = getIPAddress();
    $total_price = 0;
    $cart_query = "Select * from `cart_details` where ip_address='$get_ip_add'";
    $result = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_products = "Select * from `products` where product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = array($row_product_price['product_price']); //[200,300]
            $product_value = array_sum($product_price); //[500]
            $total_price += $product_value; //[500]
        }
    }
    echo $total_price;
}



?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>