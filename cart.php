<?php
// connect file
include("includes/connect.php");
include("functions/common_function.php");
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/logo.jpg">
    <title>Food ordering website-Cart details</title>
    <!-- css file -->
    <link rel="stylesheet" href="style.css">
    <style>
        .cardstyle {
            width: 18rem;
        }

        .cardstyle:hover {
            border-radius: 15px;
        }

        .card {
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
            transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
            /* padding: 14px 80px 18px 36px; */
            cursor: pointer;
            min-height: 200px;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
        }

        .img-border {
            /* object-fit: contain; */
            border-radius: ;
        }

        .cart_image {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
    </style>
    <!-- bootstrap CSS link -->
    <link rel="stylesheet" href="bootstrap.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <img src="./images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <?php

                        $status = isset($_SESSION['username']) ? true : false;

                        if ($status == false) {
                            echo "<li class='nav-item'>
                            <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
                        </li>";
                        }


                        // if (isset($_SESSION['username'])) {
                        
                        // } else {
                        
                        // }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">

                            <?php
                            if (isset($_SESSION['username'])) {
                                echo "<a class='nav-link' href='cart.php'><i class='fa-solid fa-cart-shopping'></i><sup>";
                                cart_item();
                            } else {
                                echo "<a class='nav-link' href='cart.php'><i class='fa-solid fa-cart-shopping'></i><sup>";
                            }
                            ?>
                            </sup></a>
                        </li>


                    </ul>


                </div>
            </div>
        </nav>

        <!-- calling cart function -->
        <?php
        cart();
        ?>
        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">

                <?php

                if (!isset($_SESSION['username'])) {
                    echo " <li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                </li>";
                }

                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./user_area/user_login.php'>Login</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='./user_area/logout.php'>Logout</a>
                </li>";
                }



                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light mt-2">
            <h3 class="text-center">Food Store</h3>
            <p class="text-center">Food is very important for all living beings</p>
        </div>

        <!-- Fourth child -table -->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">

                        <!-- php code to display dynamic data -->

                        <?php

                        global $con;
                        $get_ip_add = getIPAddress();
                        $total_price = 0;
                        $cart_query = "Select * from `cart_details` where ip_address='$get_ip_add'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {

                            echo "<thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operations</th>
                            </tr>
                        </thead>
                        <tbody>";


                            while ($row = mysqli_fetch_array($result)) {
                                $product_id = $row['product_id'];
                                $select_products = "Select * from `products` where product_id='$product_id'";
                                $result_products = mysqli_query($con, $select_products);
                                while ($row_product_price = mysqli_fetch_array($result_products)) {
                                    $product_price = array($row_product_price['product_price']); //[200,300]
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image1 = $row_product_price['product_image1'];
                                    $product_value = array_sum($product_price); //[500]
                                    $total_price += $product_value; //[500]
                        

                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $product_title; ?>
                                        </td>
                                        <td><img src="./images/<?php echo $product_image1 ?>" alt="" class="cart_image"></td>
                                        <td><input type="text" name="qty" class="form-input w-50"></td>
                                        <?php $get_ip_add = getIPAddress();
                                        if (isset($_POST['update_cart'])) {
                                            $quantities = intval($_POST['qty']);
                                            $update_cart = "Update `cart_details` set quantity = $quantities where ip_address='$get_ip_add'";
                                            $result_products_quantity = mysqli_query($con, $update_cart);
                                            // $total_price = $total_price * $quantities;
                                            $total_price = intval($total_price) * $quantities;



                                        }


                                        ?>


                                        <td>
                                            <?php echo $price_table; ?>/-
                                        </td>
                                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>" id="">
                                        </td>
                                        <td>
                                            <!-- <button class='btn bg-secondary  mx-3 border-0 text-light'>Update</button> -->
                                            <input type="submit" value="Update" class="btn bg-primary  mx-3 border-0 text-light"
                                                name="update_cart">

                                            <input type="submit" value="Remove" class="btn bg-danger  mx-3 border-0 text-light"
                                                name="remove_cart">



                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>cart is empty</h2>";
                        }

                        ?>
                        </tbody>
                    </table>
                    <!-- SubTotal -->
                    <div class="d-flex">
                        <?php

                        $get_ip_add = getIPAddress();

                        $cart_query = "Select * from `cart_details` where ip_address='$get_ip_add'";
                        $result = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result);
                        if ($result_count > 0) {
                            echo "<h4 class='px-3'>Subtotal: <strong>
                                $total_price/-
                            </strong></h4>
                        
                        <input type='submit' value='Continue Shopping'
                                                class='btn bg-secondary mb-3 mx-3 border-0 text-light' name='continue_shopping'>
                        

                        <button class='btn btn-outline-info  mb-3 mx-3'><a href='./user_area/checkout.php' class='btn '>CheckOut</a></button>";
                        } else {
                            echo " <input type='submit' value='Continue Shopping'
                                                class='btn bg-secondary  mx-3 border-0 text-light' name='continue_shopping'>";
                        }
                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }


                        ?>

                    </div>
            </div>
        </div>
        </form>

        <!-- function to remove item -->
        <?php

        // function remove_cart_item()
        // {
        //     global $con;
        //     if (isset($_POST['remove_cart'])) {
        //         foreach ($_POST['removeitem'] as $remove_id) {
        //             echo $remove_id;
        //             $delete_query = "Delete from `cart_details` where product_id=$remove_id";
        //             $run_delete = mysqli_query($con, $delete_query);
        //             if ($run_delete) {
        //                 echo "<script>window:open('cart.php','_self')</script>";
        //             }
        //         }
        //     }
        // }
        // remove_cart_item();
        

        function remove_cart_item()
        {
            global $con;
            if (isset($_POST['remove_cart']) || isset($_POST['removeitem'])) {
                foreach ($_POST['removeitem'] as $remove_id) {
                    echo $remove_id;
                    $delete_query = "DELETE FROM `cart_details` WHERE product_id = $remove_id";
                    $run_delete = mysqli_query($con, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php', '_self');</script>";
                    }
                }
            }
        }
        remove_cart_item();




        // function remove_cart_item()
        // {
        //     global $con;
        //     if (isset($_POST['remove_cart'])) {
        //         foreach ($_POST['removeitem'] as $remove_id) {
        //             $delete_query = "DELETE FROM `cart_details` WHERE product_id = $remove_id";
        //             $run_delete = mysqli_query($con, $delete_query);
        //             if ($run_delete) {
        //                 // Assuming you want to redirect after successful deletion
        //                 header("Location: cart.php");
        //                 exit(); // Make sure to exit after a redirect
        //             }
        //         }
        //     }
        // }
        
        // Call the function, but don't echo it, as it doesn't return anything
        // remove_cart_item();
        




        ?>





        <!-- last child -->
        <!-- including footer -->
        <?php include("./includes/footer.php") ?>



    </div>



    <!-- bootstrap javascript -->
    <script src="bootstrap.js"></script>
</body>

</html>