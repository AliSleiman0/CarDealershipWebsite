					<!--welcome-hero start -->
					<?php session_start();
					?>
					<div class="top-area">
						<div class="header-area"></div>
						<!-- Start Navigation -->
						<nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy" data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

							<div class="container">

								<!-- Start Header Navigation -->
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
										<i class="fa fa-bars"></i>
									</button>
									<a class="navbar-brand" href="index.php">Speed Motive<span></span></a>

								</div><!--/.navbar-header-->
								<!-- End Header Navigation -->

								<!-- Collect the nav links, forms, and other content for toggling -->
								<div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
									<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
										<li class=" scroll active"><a href="#home">Home</a></li>
										<li class="scroll"><a href="#featured-cars">Featured cars</a></li>

										<li class="scroll"><a href="#contact">Contact</a></li>
										<li class=""><a href="allCars.php">All Cars</a></li>
										<?php
										$button = isset($_SESSION['login']) === true
											? '<a href="logout.php" class="button">Logout</a>'
											: '<a href="SignINUP/signinup.php" class="button">Login</a>';
										?>
										<li class=""><?php echo $button ?></li>
									</ul><!--/.nav -->
								</div><!-- /.navbar-collapse -->
							</div><!--/.container-->
						</nav><!--/nav-->

					</div><!--/.header-area-->
					<div class="clearfix"></div>

					</div><!-- /.top-area-->