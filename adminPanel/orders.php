<?php
// check_login.php

session_start();

// Define the page that requires login
$login_page = '../clientSide/SignINUP/signinup.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: $login_page");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('components/header.php'); ?>

<body class="sb-nav-fixed">
    <?php
    require_once "class/index.class.php";
    require_once "class/Orders.class.php";
    $orderObj = new Order();
    $orders = $orderObj->getAllOrdersTable();
    ?>
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Orders
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <!-- <th>Customer Name</th> -->
                                    <th>Order Date</th>
                                    <th>Total Amount</th>
                                    <!-- <th>Car</th>
                                    <th>Quantity</th> -->
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $order) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($order['OrderID']); ?></td>
                                        <!-- <td><?php echo htmlspecialchars($order['Name']); ?></td> -->
                                        <td><?php echo htmlspecialchars($order['OrderDate']); ?></td>
                                        <td>$<?php echo number_format($order['TotalAmount'], 2); ?></td>
                                        <!-- <td><?php echo htmlspecialchars($order['Make'] . ' ' . $order['Model']); ?></td>
                                        <td><?php echo htmlspecialchars($order['Quantity']); ?></td> -->
                                        <td id="status-<?php echo $order['OrderID']; ?>"><?php echo htmlspecialchars(ucfirst($order['order_status'])); ?></td>
                                        <td>
                                            <div style="display:flex; gap:5px">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="viewOrder(<?php echo $order['OrderID']; ?>)">View</button>
                                                <button type="button" class="btn btn-secondary btn-sm" onclick="editStatus(<?php echo $order['OrderID']; ?>, '<?php echo $order['order_status']; ?>')">Edit Status</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php require_once('components/footer.php'); ?>
    </div>
    </div>

    <?php require_once('components/script.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function viewOrder(orderId) {
            fetch(`actions/get_order_details.php?id=${orderId}`)
                .then(response => response.json())
                .then(data => {
                    if (Array.isArray(data) && data.length > 0) {
                        let orderDetailsHtml = `
                    <p style="color:white"><strong>Order ID:</strong> ${data[0].OrderID}</p>
                    <p style="color:white"><strong>Customer Name:</strong> ${data[0].Name}</p>
                    <p style="color:white"><strong>Order Date:</strong> ${data[0].OrderDate}</p>
                    <p style="color:white"><strong>Total Amount:</strong> $${parseFloat(data[0].TotalAmount).toFixed(2)}</p>
                    <p style="color:white"><strong>Address:</strong> ${data[0].address}</p>
                    <p style="color:white"><strong>City:</strong> ${data[0].city}</p>
                    <p style="color:white"><strong>Country:</strong> ${data[0].country}</p>
                    <p style="color:white"><strong>ZIP Code:</strong> ${data[0].zip_code}</p>
                    <p style="color:white"><strong>Expected Delivery Date:</strong> ${data[0].expected_delivery_date}</p>
                    <p style="color:white"><strong>Status:</strong> ${data[0].order_status.charAt(0).toUpperCase() + data[0].order_status.slice(1)}</p>
                    <hr>
                    <h3 style="color:white">Items:</h3>
                `;

                        data.forEach((item, index) => {
                            orderDetailsHtml += `
                        <p style="color:white"><strong>Item ${index + 1}:</strong></p>
                        <p style="color:white"><strong>Car:</strong> ${item.Make} ${item.Model}</p>
                        <p style="color:white"><strong>Quantity:</strong> ${item.Quantity}</p>
                        <p style="color:white"><strong>Price:</strong> $${parseFloat(item.Price).toFixed(2)}</p>
                        <p style="color:white"><strong>Color:</strong> ${item.color}</p>
                        <hr>
                    `;
                        });

                        Swal.fire({
                            title: 'Order Details',
                            html: orderDetailsHtml,
                            confirmButtonText: 'Close'
                        });
                    } else {
                        Swal.fire('Error', 'No order details found', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Failed to fetch order details', 'error');
                });
        }


        function editStatus(orderId, currentStatus) {
            Swal.fire({
                title: 'Edit Order Status',
                input: 'select',
                inputOptions: {
                    'pending': 'Pending',
                    'approved': 'Approved',
                    'shipped': 'Shipped'
                },
                inputValue: currentStatus,
                showCancelButton: true,
                confirmButtonText: 'Update',
                showLoaderOnConfirm: true,
                preConfirm: (status) => {
                    return fetch('actions/edit_order_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `order_id=${encodeURIComponent(orderId)}&status=${encodeURIComponent(status)}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                return data.message; // Return success message for Swal.fire
                            } else {
                                throw new Error(data.message || 'Failed to update status');
                            }
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Success', result.value, 'success').then(() => {
                        // Reload the page after showing success message
                        location.reload();
                    });
                }
            });
        }
    </script>
</body>

</html>