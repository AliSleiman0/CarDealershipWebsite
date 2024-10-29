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
<?php
// check_login.php


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
<?php require_once('components/header.php');
require_once "../adminPanel/class/charts.class.php";
$chart = new Chart();
$popularMake = $chart->mostPopularCarMake();
$highestDiscount = $chart->highestAverageDiscount();
$totalRevenue = $chart->totalRevenue();
$totalCustomers = $chart->totalCustomers();

?>

<body class="sb-nav-fixed">
    <?php require_once('components/nav.php'); ?>
    <?php require_once('components/sidebar.php'); ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header" style=" background: linear-gradient(to bottom right, #0000ff, #1e90ff);color:white">
                        <i class="fas fa-table me-1"></i>
                        Insights
                    </div>
                    <div class="card-body">
                        <div class="dashboard-container">
                            <div class="dashboard">
                                <div class="card">
                                    <i class="fas fa-car" style="margin-bottom:6px;"></i>
                                    <h3>Most Popular Car Make</h3>
                                    <p><?php echo $popularMake[0]['Make'] . " (Ordered " . $popularMake[0]['OrderCount'] . " times)"; ?></p>
                                </div>
                                <div class="card">
                                    <i class="fas fa-tags" style="margin-bottom:6px;"></i>
                                    <h3>Highest Average Discount</h3>
                                    <p><?php echo $highestDiscount[0]['type'] . " (" . number_format($highestDiscount[0]['AvgDiscountPercentage'], 2) . "%)"; ?></p>
                                </div>
                                <div class="card">
                                    <i class="fas fa-dollar-sign" style="margin-bottom:6px;"></i>
                                    <h3>Total Revenue</h3>
                                    <p><?php echo "$" . number_format($totalRevenue[0]['TotalRevenue'], 2); ?></p>
                                </div>
                                <div class="card">
                                    <i class="fas fa-users" style="margin-bottom:6px;"></i>
                                    <h3>Total Number of Customers</h3>
                                    <p><?php echo $totalCustomers[0]['TotalCustomers']; ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .dashboard-container .dashboard {
                    display: flex;
                    justify-content: space-around;
                    border-radius: 8px;
                    box-shadow: 0 2px 2px rgba(255, 255, 255, 1);
                    margin-top: 10px;
                    flex-wrap: wrap;

                    padding: 3px;
                }

                .dashboard-container .card {
                    width: 230px;
                    /* Increased width */
                    height: 200px;
                    /* Reduced height */
                    padding: 20px;

                    box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
                    /* Dark gray background */
                    color: white;
                    text-align: center;
                    border-radius: 6px;
                    background: linear-gradient(to bottom right, #0000ff, #1e90ff);


                    /* Optional: Add box shadow */
                    transition: transform 0.3s ease;
                    overflow: hidden;
                    /* Prevents overflow on hover */
                    margin: 10px;
                    /* Margin all a
            /* Reduced width */
                }

                .dashboard-container .card:hover {
                    transform: translateY(-10px);
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                }

                .dashboard-container .card h3 {
                    margin: 0;
                    font-size: 1.5em;
                }

                .dashboard-container .card p {
                    margin: 10px 0 0;
                    font-size: 1.2em;
                }

                .chart-container {
                    margin: 0 auto;
                }

                #priceChart,
                #makeChart {
                    width: 100% !important;
                    height: 100% !important;
                }

                .mainone {
                    align-items: center;
                    padding-left: 60px;
                    padding-right: 60px;
                    margin-left: 60px;
                    margin-right: 60px;
                }
            </style>
            <div class="mainone">
                <h1>Top Cars by Price</h1>
                <div class="chart-container">
                    <canvas id="priceChart"></canvas>
                </div>
                <br><br>
                <h1>Car Make Distribution</h1>
                <div class="chart-container">
                    <canvas id="makeChart"></canvas>
                </div>
            </div>
            <script>
                async function fetchData(chartType) {
                    const response = await fetch(`actions/backendCharts.php?chart=${chartType}`);
                    const data = await response.json();
                    return data;
                }

                async function createPriceChart() {
                    const data = await fetchData('price');
                    const labels = data.map(car => `${car.Make} ${car.Model}`);
                    const prices = data.map(car => car.Price);

                    const ctx = document.getElementById('priceChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Price',
                                data: prices,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                async function createMakeChart() {
                    const data = await fetchData('make');
                    const labels = data.map(car => car.Make);
                    const counts = data.map(car => car.count);

                    const ctx = document.getElementById('makeChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Count',
                                data: counts,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(201, 203, 207, 0.2)',
                                    'rgba(255, 99, 71, 0.2)',
                                    'rgba(139, 195, 74, 0.2)',
                                    'rgba(233, 30, 99, 0.2)',
                                    'rgba(0, 188, 212, 0.2)',
                                    'rgba(156, 39, 176, 0.2)',
                                    'rgba(255, 235, 59, 0.2)',
                                    'rgba(63, 81, 181, 0.2)',
                                    'rgba(255, 87, 34, 0.2)',
                                    'rgba(3, 169, 244, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(201, 203, 207, 1)',
                                    'rgba(255, 99, 71, 1)',
                                    'rgba(139, 195, 74, 1)',
                                    'rgba(233, 30, 99, 1)',
                                    'rgba(0, 188, 212, 1)',
                                    'rgba(156, 39, 176, 1)',
                                    'rgba(255, 235, 59, 1)',
                                    'rgba(63, 81, 181, 1)',
                                    'rgba(255, 87, 34, 1)',
                                    'rgba(3, 169, 244, 1)'
                                ],

                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            return `${label}: ${value}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                createPriceChart();
                createMakeChart();
            </script>
        </main>
        <?php require_once('components/footer.php'); ?>
    </div>
    </div>
    <?php require_once('components/script.php'); ?>
</body>

</html>