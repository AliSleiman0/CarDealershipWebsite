<style>
	nav {
		background-color: black !important;
		height: fit-content !important;
	}
</style>
<?php
require_once "../adminPanel/class/wishinvent.class.php";

// Initialize variables
$nbofItemsWish = 0;
$totalCars = 0;

// Check if user ID is set in session
if (isset($_SESSION['user_id'])) {
	$wishlist = new Wishinvent();
	$customerID = $_SESSION['user_id'];

	// Get the number of items in the wishlist
	$nbofItemsWish = $wishlist->countRowsInTable($customerID);
}

// Function to calculate total number of cars
function countTotalCars()
{
	$totalCars = 0;

	// Check if 'inventory' session variable is set
	if (isset($_SESSION['inventory']) && is_array($_SESSION['inventory'])) {
		// Iterate through each car in the inventory
		foreach ($_SESSION['inventory'] as $carId => $colors) {
			// Sum the quantity of cars for each color
			foreach ($colors as $color => $quantity) {
				$totalCars += $quantity;
			}
		}
	}

	return $totalCars;
}

// Calculate total number of cars
$totalCars = countTotalCars();
?>

<!--welcome-hero start -->
<div class="top-area mt-6">
	<div class="header-area"></div>
	<!-- Start Navigation -->
	<nav class="navbar navbar-default bootsnav navbar-sticky" data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">
		<div class="container">
			<!-- Start Header Navigation -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
					<i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand" style="margin-left:15px" href="index.php">Speed Motive<span></span></a>
			</div><!--/.navbar-header-->
			<!-- End Header Navigation -->

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
				<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
					<?php
					$button = isset($_SESSION['login']) && $_SESSION['login'] === true
						? '<a href="logout.php" class="button">Logout</a>'
						: '<a href="SignINUP/signinup.php" class="button">Login</a>';
					?>
					
					<li><?php echo $button ?></li>
					<li class="scroll">
						<a href="wishlist.php" onclick="checkLogin('customerOrder.php'); return false;">
							My Orders
						</a>
					</li>
					<li class="scroll"><a href="index.php">Home</a></li>
					<li class="scroll"><a href="#contact">Contact</a></li>
					<li class="scroll">
						<a href="wishlist.php" onclick="checkLogin('wishlist.php'); return false;">
							Wishlist(<?php echo $nbofItemsWish ?>) <i class="fas fa-shopping-basket"></i>
						</a>
					</li>


					<li class="scroll">
						<a href="inventory.php" onclick="checkLogin('inventory.php'); return false;">
							Inventory(<?php echo $totalCars ?>) <i class="fas fa-shopping-cart"></i>
						</a>
					</li>
				</ul><!--/.nav -->
			</div><!-- /.navbar-collapse -->
		</div><!--/.container-->
	</nav><!--/nav-->
</div><!--/.header-area-->
<div class="clearfix"></div>
</div><!-- /.top-area-->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
	function checkLogin(target) {
		$.ajax({
			url: 'actions/check_login.php',
			method: 'GET',
			dataType: 'json',
			success: function(response) {
				if (!response.loggedIn) {
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
						}
					});
				} else {
					window.location.href = target;
				}
			},
			error: function() {
				Swal.fire({
					title: 'Error',
					text: 'There was an error processing your request. Please try again later.',
					icon: 'error'
				});
			}
		});
	}
</script>