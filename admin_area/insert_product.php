<?php
include('../includes/connect.php');
if (isset($_POST['insert_product'])) {

    $product_title = $_POST['product_title'];
    $description = $_POST['description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';


    // accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // accessing image tmp name
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // checking empty condition
    if ($product_title == '' || $description == '' || $product_keywords == '' || $product_category == '' || $product_brands == '' || $product_price == '' || $product_image1 == '' || $product_image2 == '' || $product_image3 == '') {
        echo "<script>alert('Please fill all the valid fields')</script>";
        exit();
    } else {
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // insert query
        $insert_products = "insert into `products` (product_title,product_description,product_keywords,category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status) values ('$product_title','$description','$product_keywords','$product_category','$product_brands','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status')";
        $result_query = mysqli_query($con, $insert_products);
        if ($result_query) {
            echo "<script>alert('Successfully insert product')</script>";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product-Admin Dashboard</title>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="../bootstrap.css">
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .wrapper {
            display: flex;
            justify-content: center;
            border-radius: 8px;
            /* box-shadow: 5px 5px 6px black; */
            width: 70%;
            margin: auto;
            background-color: white;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;

        }



        .form2,
        .form1 {
            width: 50%;
            /* padding: 60px; */
            margin: 50px;

        }



        /* CSS */
        .button-85 {
            padding: 0.6em 2em;
            border: none;
            outline: none;
            color: rgb(255, 255, 255);
            background: #111;
            cursor: pointer;
            position: relative;
            z-index: 0;
            border-radius: 10px;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-85:before {
            content: "";
            background: linear-gradient(45deg,
                    #ff0000,
                    #ff7300,
                    #fffb00,
                    #48ff00,
                    #00ffd5,
                    #002bff,
                    #7a00ff,
                    #ff00c8,
                    #ff0000);
            position: absolute;
            top: -2px;
            left: -2px;
            background-size: 400%;
            z-index: -1;
            filter: blur(5px);
            -webkit-filter: blur(5px);
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            animation: glowing-button-85 20s linear infinite;
            transition: opacity 0.3s ease-in-out;
            border-radius: 10px;
        }

        @keyframes glowing-button-85 {
            0% {
                background-position: 0 0;
            }

            50% {
                background-position: 400% 0;
            }

            100% {
                background-position: 0 0;
            }
        }

        .button-85:after {
            z-index: -1;
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: #222;
            left: 0;
            top: 0;
            border-radius: 10px;
        }
    </style>
</head>

<body class="" style="background-color:#e9e0d9;">
    <!-- navbar -->
    <div class="container-fluid p-0 ">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <img src="../images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active mx-4" aria-current="page" href="index.php">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Total Price:100/-</a>
                        </li> -->

                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data">

                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>

                </div>
            </div>
        </nav>
        <div class="container mt-3 mb-5">
            <h1 class="text-center">Insert Products</h1>
            <!-- form -->
            <form action="" method="post" enctype="multipart/form-data">
                <!-- title -->
                <div class="wrapper">
                    <div class="form1">
                        <div class="form-outline mb-4  m-auto  ">
                            <label for="product_title" class="form-label">Product title</label>
                            <input type="text" name="product_title" id="product_title" class="form-control"
                                placeholder="Enter Product title" autocomplete="off" required="required">

                        </div>

                        <!-- description -->
                        <div class="form-outline mb-4  m-auto">
                            <label for="description" class="form-label">Product description</label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="Enter Product description" autocomplete="off" required="required">
                        </div>

                        <!-- keywords -->
                        <div class="form-outline mb-4  m-auto">
                            <label for="product_keywords" class="form-label">Product Keywords</label>
                            <input type="text" name="product_keywords" id="product_keywords" class="form-control"
                                placeholder="Enter Product keywords" autocomplete="off" required="required">
                        </div>

                        <!-- categories -->
                        <div class="form-outline mb-4  m-auto">
                            <select name="product_category" id="" class="form-select">
                                <option value="">Select a category</option>
                                <?php
                                $select_query = "select * from `categories`";
                                $result_query = mysqli_query($con, $select_query);
                                while ($row = mysqli_fetch_assoc($result_query)) {
                                    $category_title = $row['category_title'];
                                    $category_id = $row['category_id'];
                                    echo "<option value='$category_id'>$category_title</option>";
                                }

                                ?>


                            </select>
                        </div>



                        <!-- Brands -->
                        <div class="form-outline mb-4  m-auto ">
                            <select name="product_brands" id="" class="form-select">
                                <option value="">Select a Brands</option>
                                <?php
                                $select_query = "select * from `brands`";
                                $result_query = mysqli_query($con, $select_query);
                                while ($row = mysqli_fetch_assoc($result_query)) {
                                    $brand_title = $row['brand_title'];
                                    $brand_id = $row['brand_id'];
                                    echo "<option value='$brand_id'>$brand_title</option>";
                                }

                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form2">

                        <!-- Image 1 -->
                        <div class="form-outline mb-4 m-auto">
                            <label for="product_image1" class="form-label">Product Image 1</label>
                            <input type="file" name="product_image1" id="product_image1" class="form-control"
                                required="required">
                        </div>
                        <!-- Image 2 -->
                        <div class="form-outline mb-4  m-auto">
                            <label for="product_image2" class="form-label">Product Image 2</label>
                            <input type="file" name="product_image2" id="product_image2" class="form-control"
                                required="required">
                        </div>
                        <!-- Image 3 -->
                        <div class="form-outline mb-4 m-auto">
                            <label for="product_image3" class="form-label">Product Image 3</label>
                            <input type="file" name="product_image3" id="product_image3" class="form-control"
                                required="required">
                        </div>

                        <div class="form-outline mb-4 m-auto">
                            <label for="product_price" class="form-label">Product description</label>
                            <input type="text" name="product_price" id="product_price" class="form-control"
                                placeholder="Enter Product price" autocomplete="off" required="required">
                        </div>




                        <!-- submit -->
                        <div class="form-outline mt-0  ">
                            <button type="submit" name="insert_product" class="button-85 px-3"
                                value="Insert Products">insert
                                product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php include("../includes/footer.php") ?>


        <!-- bootstrap js -->
        <script src="../bootstrap.js"></script>
</body>

</html>