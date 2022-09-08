<div class="header">
		<div class="container">
			<div class="w3_agile_logo">
				<h1><a href="index.html"><span>L</span>iberators.<span>C</span>om</a></h1>
			</div>
			<div class="header-nav">
				<nav class="navbar navbar-default">
					<div class="navbar-header navbar-left">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<nav class="link-effect-12">
							<ul class="nav navbar-nav w3_agile_nav">
								<li><a href="index.php"><span>Home</span></a></li>
								<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="About"><i class='fa fa-user'></i> About Us</span> <b class="caret"></b></a>
								<ul class="dropdown-menu agile_short_dropdown">
									<li><a href="about.php"><span>About Us</span></a></li>
									<li><a href="manifesto.php"><span>Manifesto</span></a></li>	
								</ul>
								</li>
								<li><a href="gallery.php"><span>Gallery</span></a></li>
								<li><a href="blog.php"><span>Blog</span></a></li>
								<?php
								if(isset($m_id))
									{
								?>
								<li class="dropdown active">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span data-hover="Short Codes"><i class='fa fa-user'></i> Account</span> <b class="caret"></b></a>
									<ul class="dropdown-menu agile_short_dropdown">
										<li><a href="raffle.php"><i class='fa fa-gift text-left'></i> Raffle Draw</a></li>
										<li><a href="raffle.php"><i class='fa fa-sign-language'></i> Winnings</a></li>
										<li><a href="cpassword.php"><i class='fa fa-key'></i> Change Password</a></li>	
										<li><a href="registerEdit.php"><i class='fa fa-user'></i> Edit Proflie</a></li>
										<li><a href="passport.php"><i class='fa fa-image'></i> Passport</a></li>
										<li><a href="printid.php"> <i class='fa fa-print'></i> Print Membership ID  Card</a></li>
										<li><a href="logout.php"> <i class='fa fa-logout'></i> Logout</a></li>
									</ul>
								</li>
								<?php
									}
									else
									{
								?>
									<li ><a href="login.php"><span>Login</span></a></li>
									<li ><a href="register.php"><span>Register</span></a></li>
								<?php
									}
								?>
								<li ><a href="mail.php"><span>Contact Us</span></a></li>
							</ul>
							
						</nav>
					</div>
				</nav>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>