<?php
session_start();
require_once('components/header.php');
require_once "../adminPanel/class/index.class.php";
require_once('components/navSubPages.php');

if (!isset($_SESSION['user_id'])) {
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Not Logged In',
                text: 'You need to sign in or sign up to continue.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sign In/Up',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'SignINUP/signinup.php';
                } else {
                    // Optional: Handle the cancel action
                }
            });
        });
    </script>
    ";
    exit();
}

$user_id = $_SESSION['user_id'];

$index = new sliders();
$orders = $index->getCustomerOrders($user_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- title of site -->
    <title>My Orders</title>

    <!-- The following links are included in the subfiles -->
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <style>
        body {
            color: black !important;
            background-image: url('wp3.avif');
            /* Update this with the path to your image */
            background-size: cover;
            /* Ensures the image covers the entire body */
            background-position: center;
            /* Centers the image */
            background-repeat: no-repeat;
            /* Ensures the image does not repeat */
            background-attachment: fixed;
            /* Keeps the background image fixed while scrolling */
            min-height: 100vh;
            /* Ensures the body covers at least the viewport height */
        }

        .order-table {
            color: black !important;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.8);
            /* White background with opacity for blur effect */
            backdrop-filter: blur(3px);
            /* Blur effect */
            -webkit-backdrop-filter: blur(3px);
            /* For Safari support */
        }


        .order-table th,
        .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .order-table th {
            background-color: #f4f4f4;
            text-align: left;
        }

        .hedo {
            margin-bottom: 20px !important;
            margin-top: 20px !important;
            color: #333;
            /* Dark gray text color for contrast */
            font-weight: bold;
            text-align: center;
            /* Center the text */
            font-size: xx-large;
            background: rgba(255, 255, 255, 0.8);
            /* White background with slight transparency */
            padding: 10px 20px;
            /* Add some padding around the text */
            border-radius: 8px;
            /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Light shadow effect for subtle depth */
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);
            /* Light text shadow for improved readability */
            backdrop-filter: blur(8px);
            /* Blur effect for a frosted glass look */
        }


        .headerso {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="headerso">
            <h1 class="mb-4 hedo">My Orders</h1>
        </div>
        <?php if (empty($orders)) : ?>
            <div class="alert alert-info">No orders found.</div>
        <?php else : ?>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Cars</th>
                        <th>Delivery Address</th>
                        <th>Expected Delivery Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <td style="  color: black !important;"><?php echo $order['OrderID']; ?></td>
                            <td style="  color: black !important;"><?php echo $order['OrderDate']; ?></td>
                            <td style="  color: black !important;">$<?php echo number_format($order['TotalAmount'], 2); ?></td>
                            <td style="  color: black !important;"><?php echo ucfirst($order['order_status']); ?></td>
                            <td style="  color: black !important;">
                                <?php
                                $details = explode(';;', $order['order_details']);
                                foreach ($details as $detail) {
                                    $detailData = explode('|', $detail);
                                    echo $detailData[10] . ' ' . $detailData[11] . ' (Qty: ' . $detailData[1] . ', Color: ' . $detailData[3] . ')<br>';
                                }
                                ?>
                            </td style="  color: black !important;">
                            <td style="  color: black !important;"><?php echo $detailData[4] . ', ' . $detailData[5] . ', ' . $detailData[6] . ' ' . $detailData[7]; ?></td>
                            <td style="  color: black !important;"><?php echo $detailData[8]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Include all js compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootsnav.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/custom.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dDx9bFwFjM0/11PH9vT/oU8UeNm+O9sdRRODyYhR5ClZ2cU8tyMHuFjqkzA5QoOLRUrgl3i7X9U5P9ZFSwFf3A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php require_once('components/footersub.php');
    require_once('components/script.php'); ?>
</body>

</html>