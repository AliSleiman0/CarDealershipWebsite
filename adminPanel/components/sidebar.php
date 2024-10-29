<?php
// Assuming you have started the session and set $_SESSION['usertype'] appropriately
//session_start();
$is_superadmin = isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'superadmin';
?>
<style>
    .nav-link.active {
        background: linear-gradient(to bottom right, #0000ff, #1e90ff);
        color: black !important;
    }

    .sb-nav-link-icon {

        color: black !important;
    }
</style>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-primary" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#CarsCollapse" aria-expanded="false" aria-controls="mainPageDetailsCollapse">
                        <div class="sb-nav-link-icon"><i class="fas fa-car"></i>
                        </div>
                        Cars Details
                        <div class="sb-nav-link-icon ms-auto"><i class="fas fa-chevron-down"></i></div>
                    </a>
                    <div class="collapse" id="CarsCollapse">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'cars.php' ? 'active' : ''; ?>" href="cars.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sliders-h"></i></div>
                            All Cars
                        </a>
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'features.php' ? 'active' : ''; ?>" href="features.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i>
                            </div>
                            Car features
                        </a>
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'waranties.php' ? 'active' : ''; ?>" href="waranties.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shield-alt"></i>
                            </div>
                            Cars Waranties
                        </a>

                    </div>

                    <!-- Main Page Details Dropdown -->
                    <div class="sb-sidenav-menu-heading">Main Page Details</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mainPageDetailsCollapse" aria-expanded="false" aria-controls="mainPageDetailsCollapse">
                        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                        Main Page Details
                        <div class="sb-nav-link-icon ms-auto"><i class="fas fa-chevron-down"></i></div>
                    </a>
                    <div class="collapse" id="mainPageDetailsCollapse">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'sliders.php' ? 'active' : ''; ?>" href="sliders.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-sliders-h"></i></div>
                            Sliders
                        </a>
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'testimonials.php' ? 'active' : ''; ?>" href="testimonials.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                            Testimonials
                        </a>
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'brand_images.php' ? 'active' : ''; ?>" href="brand_images.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Brands
                        </a>
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : ''; ?>" href="services.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools"></i>
                            </div>
                            Services
                        </a>
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'links.php' ? 'active' : ''; ?>" href="links.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-link"></i>

                            </div>
                            Social Links
                        </a>
                    </div>

                    <a id="users-link" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : ''; ?>" href="<?php echo $is_superadmin ? 'users.php' : '#'; ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Users
                    </a>
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : ''; ?>" href="orders.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-box"></i>

                        </div>
                        Orders
                    </a>



        </nav>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('users-link').addEventListener('click', function(event) {
                <?php if (!$is_superadmin) : ?>
                    event.preventDefault(); // Prevent the default action
                    Swal.fire({
                        icon: 'error',
                        title: 'Access Denied',
                        text: 'Only superadmins can enter the users page.',
                        confirmButtonText: 'OK'
                    });
                <?php endif; ?>
            });
        </script>
    </div>