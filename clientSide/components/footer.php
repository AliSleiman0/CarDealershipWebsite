<!--contact start-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></script>
<?php
$slider = new sliders();
$socialLinks = $slider->getAllLinks();

// Since we're expecting only one row, we can directly access the first element
$socialLinks = $socialLinks[0];
?>
<footer id="contact" class="contact">
	<div class="container">
	<div class="footer-top">
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="single-footer-widget">
						<div class="footer-logo">
							<a href="index.html">Speed Motive</a>
						</div>
						<p>
							© 2024 Speed Motive. Powered by Passion, Driven by Excellence. All Rights Reserved.
						</p>
						<div class="footer-contact">
							<p>EngineerAli@gmail.com</p>
							<p>+961 78991778</p>
						</div>
					</div>
				</div>
				<div class="col-md-2 col-sm-6">
					<div class="single-footer-widget">
						<h2>About Speed Motive</h2>
						<ul>
							<li><a href="subpages/aboutus.php">About Us</a></li>
							<li><a href="subpages/term.php">Terms <span> of Service</span></a></li>
							<li><a href="subpages/privacy.php">Privacy Policy</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-xs-12">
					<div class="single-footer-widget">
						<h2>Our Top Brands</h2>
						<div class="row">
							<div class="col-md-7 col-xs-6">
								<ul>
									<li><a href="#featured-cars">BMW</a></li>
									<li><a href="#featured-cars">lamborghini</a></li>
									<li><a href="#featured-cars">camaro</a></li>
									<li><a href="#featured-cars">audi</a></li>
									<li><a href="#featured-cars">infiniti</a></li>
									<li><a href="#featured-cars">nissan</a></li>
								</ul>
							</div>
							<div class="col-md-5 col-xs-6">
								<ul>
									<li><a href="#featured-cars">ferrari</a></li>
									<li><a href="#featured-cars">porsche</a></li>
									<li><a href="#featured-cars">land rover</a></li>
									<li><a href="#featured-cars">aston martin</a></li>
									<li><a href="#featured-cars">mersedes</a></li>
									<li><a href="#featured-cars">opel</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-offset-1 col-md-3 col-sm-6">
					<div class="single-footer-widget">
						<h2>news letter</h2>
						<div class="footer-newsletter">
							<p>
								Subscribe to get latest news update and informations
							</p>
						</div>
						<div class="hm-foot-email">
							<form action="https://formspree.io/f/xnnadlzw" method="POST">
								<div class="foot-email-box">
									<input type="email" class="form-control" name="email" placeholder="Add Email">
									<input name="message" type="hidden" value="A New Email Subscribed to The News Letter"></input>
								</div><!--/.foot-email-box-->
								<div class="foot-email-subscribe">
									<span></span>
									<span><button type="submit"><i class="fa fa-arrow-right"></i></button></span>
								</div><!--/.foot-email-icon-->
							</form>
						</div><!--/.hm-foot-email-->
						<!-- modify this form HTML and place wherever you want your form -->





					</div>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="row">
				<div class="col-sm-6">
					<p style="color:white">
						Designed And Developed by Engineer Ali Sleiman
					</p><!--/p-->
					<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

				</div>
				<div class="col-sm-6">
					<div class="footer-social">
						<a href="<?php echo htmlspecialchars($socialLinks['facebook']); ?>" target="_blank" class="social-icon" style="margin-right:5px; color:white">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="<?php echo htmlspecialchars($socialLinks['twitter']); ?>" target="_blank" class="social-icon" style="margin-right:5px; color:white">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="<?php echo htmlspecialchars($socialLinks['instagram']); ?>" target="_blank" class="social-icon" style="margin-right:5px; color:white">
							<i class="fab fa-instagram"></i>
						</a>
						<a href="<?php echo htmlspecialchars($socialLinks['linkedin']); ?>" target="_blank" class="social-icon" style="margin-right:5px; color:white;">
							<i class="fab fa-linkedin-in"></i>
						</a>
					</div>
				</div>
			</div>
		</div><!--/.footer-copyright-->
	</div><!--/.container-->

	<div id="scroll-Top">
		<div class="return-to-top">
			<i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
		</div>

	</div><!--/.scroll-Top-->

</footer><!--/.contact-->