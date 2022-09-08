

<!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <div class="sidenav-header-inner text-center"><img src="../home/images/1.jpg" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5 text-uppercase"><?php echo $my_name;?></h2><span class="text-uppercase"><?php echo $my_rank;?></span>
          </div>
          <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>L</strong><strong class="text-primary">M</strong></a></div>
        </div>
        <div class="main-menu">
          <ul id="side-main-menu" class="side-menu list-unstyled">                  
            <li class="<?php if($active_menu == 1){echo 'active';}?>"><a href="index.html"> <i class="icon-home"></i><span>Home</span></a></li>
            <li class="<?php if($active_menu == 2){echo 'active';}?>"><a href="centers.php"> <i class="icon-home"></i><span>Redemption Centers</span></a></li>
            <li  class="<?php if($active_menu == 3){echo 'active';}?>"><a href="gift.php"> <i class="fa fa-gift"></i><span>Gifts</span></a></li>
            <li  class="<?php if($active_menu == 4){echo 'active';}?>"> <a href="liberators.php"><i class="fa fa-user"></i><span>Liberators</span></a></li>
            <li  class="<?php if($active_menu == 5){echo 'active';}?>"> <a href="mandates.php"><i class="fa fa-users"></i><span>Mandates</span></a></li>
            <li  class="<?php if($active_menu == 6){echo 'active';}?>"> <a href="raffles.php"><i class="icon-presentation"></i><span>Raffle</span></a></li>
            <li  class="<?php if($active_menu == 8){echo 'active';}?>"> <a href="blogs.php"><i class="icon-presentation"></i><span>Blogs</span>
            </a></li>
            <li  class="<?php if($active_menu == 10){echo 'active';}?>"> <a href="gallery.php"><i class="icon-picture"></i><span>Gallery</span></a></li>
            <li  class="<?php if($active_menu == 7){echo 'active';}?>"> <a href="users.php"><i class="icon-presentation"></i><span>Users</span></a></li>
             <li  class="<?php if($active_menu == 9){echo 'active';}?>"> <a href="logout.php"><i class="icon-presentation"></i><span>Logout</span></a></li>
          </ul>
        </div>
        
      </div>
    </nav>