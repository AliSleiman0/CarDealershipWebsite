<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart and Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: black;
            color: #fff;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7);
            /* Black background with 70% opacity */
            padding: 20px;
            border-radius: 8px;
            width: 100%;
        }

        .nav-tabs .nav-link {
            background-color: black;
            color: white;
            border: none;
        }

        .nav-tabs .nav-link.active {
            background-color: white;
            color: black;
        }

        .form-label {
            color: #ccc;
        }

        .table {
            color: #fff;
        }

        .table th,
        .table td {
            border-color: #555;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .cart-container {
            width: 100%;
            margin: 0 auto;
            margin-bottom: 30px;
        }

        .checkout-column {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 8px;
        }

        .checkout-column .form-row {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 8px;
        }

        @media (min-width: 992px) {
            .checkout-column .form-row {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }

            .checkout-column .form-row .col-md-6 {
                flex: 1;
            }
        }

        @media (max-width: 576px) {

            .container {
                width: fit-content;
            }

            .peep {
                margin-bottom: 390px;
            }

        }
    </style>
</head>

<?php
require_once "../adminPanel/class/CustomerCars.class.php";

$car = new CustomerCar();
$appliedCoupon = isset($_SESSION['applied_coupon']) ? $_SESSION['applied_coupon'] : null;

// Retrieve coupon details if applied
$couponCode = $appliedCoupon ? $appliedCoupon['code'] : 'No coupon applied';
$discount = $appliedCoupon ? ($appliedCoupon['discount']) / 100 : 'N/A';

?>

<body style="background-image: url('wp3.avif'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <div class="container mt-5 mb-5">
        <!-- Cart Section -->
        <div class="row cart-container">
            <div class="col-md-12">
                <h2>Your Cart</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Car</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        if (!isset($_SESSION['inventory'])) {
                           
                        } else {
                            foreach ($_SESSION['inventory'] as $carId => $colors) {
                                // Fetch car details from database using $carId
                                $carDetails = $car->getCarById($carId);
                                foreach ($colors as $color => $quantity) {
                                    $itemTotal = $carDetails[0]['Price'] * $quantity;
                                    $total += $itemTotal;
                        ?>
                                    <tr data-car-id="<?php echo $carId; ?>" data-color="<?php echo $color; ?>">
                                        <td><?php echo $carDetails[0]['Make'] . ' ' . $carDetails[0]['Model']; ?></td>
                                        <td><?php echo htmlspecialchars($color); ?></td>
                                        <td>$<?php echo number_format($carDetails[0]['Price'], 2); ?></td>
                                        <td>
                                            <div class="quantity-controls" style="display:flex; gap:3px">
                                                <button class="btn btn-sm btn-secondary quantity-decrease">-</button>
                                                <span class="quantity"><?php echo $quantity; ?></span>
                                                <button class="btn btn-sm btn-secondary quantity-increase">+</button>
                                            </div>
                                        </td>
                                        <td class="item-total">
                                            <span style="<?php echo $appliedCoupon ? 'color:red; text-decoration: line-through;' : ''; ?>">
                                                $<?php echo number_format($itemTotal, 2); ?></span>

                                            <?php if ($appliedCoupon) : ?>
                                                <br>
                                                <span class="item-discounted-price" style="color:green">
                                                    <strong> $<?php echo number_format($itemTotal * (1 - ($appliedCoupon['discount'] / 100)), 2); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger remove-item" style="width:30px"> <i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        }

                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td id="cart-total">
                                <span style="<?php echo $appliedCoupon ? 'color:red; text-decoration: line-through;' : ''; ?>">
                                    $<?php echo number_format($total, 2); ?></span>

                                <?php if ($appliedCoupon) : ?>
                                    <br>
                                    <span class="item-discounted-price" style="color:green">
                                        <strong> $<?php echo number_format($total * (1 - ($appliedCoupon['discount'] / 100)), 2); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Checkout and Coupon Tabs -->
        <div class="row">
            <div class="col-md-12 checkout-column">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" style="margin-right:5px" role="presentation">
                        <a class="nav-link active" id="checkout-tab" data-bs-toggle="tab" href="#checkout" role="tab" aria-controls="checkout" aria-selected="true">Checkout</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="coupon-tab" data-bs-toggle="tab" href="#coupon" role="tab" aria-controls="coupon" aria-selected="false">Coupon</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Checkout Tab -->
                    <div class="tab-pane fade show active" id="checkout" role="tabpanel" aria-labelledby="checkout-tab">
                        <h2 class="mt-3">Checkout</h2>
                        <form id="checkoutForm">
                            <div class="form-row row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="zipCode" class="form-label">ZIP Code</label>
                                    <input type="text" class="form-control" id="zipCode" name="zipCode" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4" style="color:white; background-color:black; border-color:2px solid white;">Place Order</button>
                        </form>

                    </div>
                    <!-- Coupon Tab -->
                    <div class="tab-pane fade" id="coupon" role="tabpanel" aria-labelledby="coupon-tab">
                        <h2 class="mt-3">Coupon</h2>
                        <form id="couponForm">
                            <div class="mb-3">
                                <label for="couponCode" class="form-label">Coupon Code</label>
                                <input type="text" class="form-control" id="couponCode" required>
                            </div>
                            <button type="submit" class="btn btn-primary peep">Apply Coupon</button>
                        </form>
                        <div id="couponResult" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle quantity increase
            $('.quantity-increase').click(function() {
                var row = $(this).closest('tr');
                var carId = row.data('car-id');
                var color = row.data('color');
                var quantity = row.find('.quantity');
                var newQuantity = parseInt(quantity.text()) + 1;
                updateQuantity(carId, color, newQuantity);
            });

            // Handle quantity decrease
            $('.quantity-decrease').click(function() {
                var row = $(this).closest('tr');
                var carId = row.data('car-id');
                var color = row.data('color');
                var quantity = row.find('.quantity');
                var newQuantity = parseInt(quantity.text()) - 1;
                if (newQuantity > 0) {
                    updateQuantity(carId, color, newQuantity);
                }
            });

            // Handle item removal with Swal.fire confirmation
            $('.remove-item').click(function() {
                var row = $(this).closest('tr');
                var carId = row.data('car-id');
                var color = row.data('color');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        removeItem(carId, color);
                    }
                });
            });

            // Handle coupon form submission
            $('#couponForm').submit(function(e) {
                e.preventDefault();
                var couponCode = $('#couponCode').val();
                applyCoupon(couponCode);
            });

            // Function to update quantity
            function updateQuantity(carId, color, newQuantity) {
                $.ajax({
                    url: 'actions/update_quantity.php',
                    type: 'POST',
                    data: {
                        carId: carId,
                        color: color,
                        quantity: newQuantity
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }

            // Function to remove item
            function removeItem(carId, color) {
                $.ajax({
                    url: 'actions/remove_item.php',
                    type: 'POST',
                    data: {
                        carId: carId,
                        color: color
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            }

            // Function to apply coupon
            function applyCoupon(couponCode) {
                $.ajax({
                    url: 'actions/apply_coupon.php',
                    type: 'POST',
                    dataType: 'json', // Ensure the data type is JSON
                    data: {
                        couponCode: couponCode
                    },
                    success: function(response) {
                        console.log("Response received:", response); // Debug output

                        if (!response.success && response.message === 'User not logged in') {
                            // If the user is not logged in, show a Swal confirmation prompt for redirection
                            Swal.fire({
                                title: 'Not Logged In',
                                text: "You need to log in to apply a coupon. Do you want to go to the login/signup page?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, take me there',
                                cancelButtonText: 'No, stay here'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = 'SignINUP/signinup.php';
                                }
                            });
                        } else {
                            // Show the result with Swal.fire and then reload the page
                            Swal.fire({
                                title: response.success ? 'Coupon Applied!' : 'Error',
                                text: response.success ? `Coupon applied: ${response.coupon.discount}% off` : response.message,
                                icon: response.success ? 'success' : 'error',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Redirect to checkout page after showing the message
                                window.location.href = 'checkout.php';
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error); // Debug output
                    }
                });
            }


            $(document).ready(function() {
                // Handle checkout form submission
                $('#checkoutForm').submit(function(e) {
                    e.preventDefault(); // Prevent default form submission

                    // Gather form data
                    var formData = {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        address: $('#address').val(),
                        city: $('#city').val(),
                        country: $('#country').val(),
                        zipCode: $('#zipCode').val()
                    };

                    // Send AJAX request to submit order
                    $.ajax({
                        url: 'actions/submit_order.php', // Update this path as needed
                        type: 'POST',
                        dataType: 'json', // Expect JSON response
                        data: {
                            formData: formData
                        },
                        success: function(response) {
                            if (response.success) {
                                // Order submission successful
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                }).then(() => {
                                    // Redirect to order confirmation or other desired action
                                    window.location.href = 'index.php';
                                });
                            } else if (response.message === 'User not logged in') {
                                // User is not logged in, prompt to redirect to login/signup page
                                Swal.fire({
                                    title: 'Not Logged In',
                                    text: "You need to log in to complete your order. Do you want to go to the login/signup page?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, take me there',
                                    cancelButtonText: 'No, stay here'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'Singinup/signinup.php'; // Adjust the URL as needed
                                    }
                                });
                            } else {
                                // Order submission failed for other reasons
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message,
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while submitting your order. Please try again.',
                            });
                        }
                    });
                });
            });


        });
    </script>
</body>

</html>