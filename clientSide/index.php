<!doctype html>

<?php require_once('components/header.php');
require_once "../adminPanel/class/index.class.php";
require_once "../adminPanel/class/services.class.php";
$slider = new sliders();
$service = new service();
$sliderArr = $slider->getAllSliders();
//$newestCars = $slider->getNewestCars();
$featuredCars = $slider->getFeaturedCars();
$testimonials =  $slider->getAllTestimonials();
$brandImages =  $slider->getAllBrandImages();
$allServices = $service->getAllServices();
$newestCars = $slider->getNewestCaros();
?>

<body>
	<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
	<section id="home" class="welcome-hero" style="background:url(../adminPanel/assets/img/welcome-hero/<?php echo $sliderArr[0]['banner'] ?>)no-repeat;">

		<!-- top-area Start -->

		<?php require_once('components/navbar.php'); ?>


		<!-- top-area End -->

		<div class="container">
			<div class="welcome-hero-txt">

				<h2><?php echo $sliderArr[0]['title'] ?></h2>
				<p>
					<?php echo $sliderArr[0]['description'] ?>
				</p>
				<button class="welcome-btn" onclick="window.location.href='allCars.php'">Buy a Car!</button>
			</div>
		</div>



	</section><!--/.welcome-hero-->
	<!--welcome-hero end -->
	<section class="sectionmain">
		<div class="content">
			<div class="info">
				<p style="font-size:larger" class="desc">
					Discover the ultimate car dealership experience with our extensive range of vehicles, tailored to suit every taste and budget. Whether you're looking for cutting-edge technology, fuel efficiency, or luxury features, we have the perfect car for you. With exceptional customer service and unbeatable deals, your journey starts here!
				</p>
				<button class="btn" onclick="window.location.href='allCars.php'">Lets Go!</button>
			</div>
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php
					foreach ($newestCars as $car) {
					?>
						<div class="swiper-slide">
							<img src="../adminPanel/assets/img/allCars/<?php echo htmlspecialchars($car['ImageName']); ?>" alt="<?php echo htmlspecialchars($car['Make'] . ' ' . $car['Model']); ?>" />
							<div class="overlay">
								<span><?php echo htmlspecialchars($car['Year']); ?></span>
								<h2 style="font-size:larger"><?php echo htmlspecialchars($car['Make'] . ' ' . $car['Model']); ?></h2>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>

		<ul class="circles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</section>

	<!--featured-cars start -->
	<div style="background: linear-gradient(to bottom right, #000000, #434343);">
		<section id="featured-cars" class="featured-cars">
			<div class="container">
				<div class="section-header " style="margin-top:25px; padding-top:15px;margin-bottom:0;">
					<h2 style="color:white; font-size:xxx-large">Featured cars</h2>
				</div><!--/.section-header-->
				<div class="featured-cars-content ">
					<div class="row" style="margin-bottom:35px; margin-top:0; ">
						<?php
						foreach ($featuredCars as $car) {
							$image = $slider->getRandomImagesByID($car['CarID']);
							$price = number_format($car['Price'], 2);
						?>
							<div class="col-lg-3 col-md-4 col-sm-6" style="background-color:black; padding-top:20px; padding-bottom:20px;; cursor:pointer; " onclick="window.location.href='car.php?id=<?php echo $car['CarID'] ?>'">
								<div class="card single-featured-cars">

									<div style="height: 200px; overflow: hidden; ">
										<img src="../adminPanel/assets/img/allCars/<?php echo $image[0]['ImageName'] ?>" alt="<?php echo $car['Model'] ?>" style="width: 100%; height: 100%; object-fit: cover;">>
									</div>

								</div>
								<div class="featured-cars-txt">
									<h2 style="color:white"><a style="color:white" href="#"><?php echo $car['Make'] ?> <?php echo $car['Model'] ?></a></h2>
									<h3 style="color:white">$<?php echo $price ?></h3>
									<p style="color:white">
										<?php echo $car['Description'] ?>
									</p>
								</div>

							</div>
						<?php
						}
						?>
					</div>
					
				</div>
			</div><!--/.container-->

		</section><!--/.featured-cars-->
		<!--featured-cars end -->
		<!--service start -->
		<section id="service" class="service">
			<div class="container">
				<div class="service-content">
					<div class="row">
						<?php foreach ($allServices as $service) {
							$icon = $service['icon'] ?>
							<div class="col-md-4 col-sm-6">
								<div class="single-service-item" style="background-image: url('../adminPanel/assets/img/allCars/<?php echo $service['image'] ?>'); background-size: cover; background-position: center;  background-repeat: no-repeat;">
									<div class="contentContainer">
										<div class="single-service-icon">
											<i class="<?= $icon ?>"></i>
										</div>
										<h2><a href=""><?php echo ($service['title']) ?></a></h2>
										<p>
											<?php echo ($service['description']) ?>
										</p>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div><!--/.container-->

		</section><!--/.service-->

		<!-- clients-say strat -->
		<section id="clients-say" class="clients-say">
			<div class="container">
				<div class="section-header">
					<h2 style="color:black">what our clients say</h2>
				</div><!--/.section-header-->
				<div class="row">
					<div class="owl-carousel testimonial-carousel">
						<?php
						foreach ($testimonials as $testimonial) {
						?>
							<div class="col-sm-3 col-xs-12">
								<div class="single-testimonial-box" height="30%">
									<div class="testimonial-description">
										<div class="testimonial-info">
											<div class="testimonial-img">
												<img src="../adminPanel/assets/img/clients/<?php echo $testimonial['client_image']; ?>" alt="image of clients person" />
											</div><!--/.testimonial-img-->
										</div><!--/.testimonial-info-->
										<div class="testimonial-comment">
											<p><?php echo $testimonial['testimonial_text']; ?></p>
										</div><!--/.testimonial-comment-->
										<div class="testimonial-person">
											<h2><a href="#"><?php echo $testimonial['client_name']; ?></a></h2>
											<h4><?php echo $testimonial['location']; ?></h4>
										</div><!--/.testimonial-person-->
									</div><!--/.testimonial-description-->
								</div><!--/.single-testimonial-box-->
							</div><!--/.col-->
						<?php
						}
						?>
					</div><!--/.testimonial-carousel-->
				</div><!--/.row-->
			</div><!--/.container-->

		</section><!--/.clients-say-->
		<!-- clients-say end -->
		<section id="brand" class="brand">
			<div class="container">
				<div class="brand-area">
					<div class="owl-carousel owl-theme brand-item">
						<?php
						foreach ($brandImages as $image) {
						?>
							<div class="item">
								<a href="#">
									<img src='../adminPanel/assets/img/brand/<?php echo $image['image_path']; ?>' alt="brand-image" />
								</a>
							</div><!--/.item-->
						<?php
						}
						?>
					</div><!--/.owl-carousel-->
				</div><!--/.clients-area-->

			</div><!--/.container-->

		</section><!--/brand-->
	</div>
	<!--brand strat -->

	<!--brand end -->

	<?php require_once('components/footer.php'); ?>
	<!--contact end-->


	<?php require_once('components/script.php'); ?>
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	<script>
		var swiper = new Swiper(".swiper", {
			effect: "cards",
			grabCursor: true,
			initialSlide: 2,
			speed: 500,
			loop: true,
			rotate: true,
			mousewheel: {
				invert: false,
			},
		});
	</script>
</body>

</html>