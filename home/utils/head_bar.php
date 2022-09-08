<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="header_address_mail">
		<div class="container">
		<div class="agileits_w3layouts_header_address_grid" style='float:left !important;'>
		<img src='images/1.jpg' height="60px">
		</div>
		<div class="agileits_w3layouts_header_address_gridx" style='float:left !important;'>
					<ul class="agileits_social_list1">
						<li><a href="http://www.facebook.com/Liberatorsmandate" class="w3_agile_all"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="http://www.twitter.com/LiberatorsM" class="w3_agile_all"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="liberatorsmandate@gmail.com" class="w3_agile_all"><i class="fa fa-google" aria-hidden="true"></i></a></li>
						
					</ul>
				</div>	
			<div class="agileits_w3layouts_header_address_grid hidden-xs ">
				<ul>	
					<li><a href="mailto:liberatorsmandate@gmail.com">Welcome !</a></li>
					<li>
					<?php
						if(isset($m_pics))
						{
					?>
					<?php
						}
						else
						{
					?>
							<i class="fa fa-user" aria-hidden="true"></i>
					<?php
						}
					?>
					</li>
					<li><?php if(isset($m_name)){echo $m_name;}?></li>
				</ul>
			</div>
		</div>
	</div>