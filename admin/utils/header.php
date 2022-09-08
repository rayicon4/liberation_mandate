<nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span></span><strong class="text-primary">Liberators Mandate</strong></div></a></div>
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <?php
                  $rg = $op->select('clients', NULL, array('centers'=> 2));
                  $rg_n = count($rg);
              ?>
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><span class="badge badge-warning"><?php echo $rg_n;?></span>
                </a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                  <?php
                  if(isset($rd) && is_array($rd))
                  {
                  foreach($rd as $tf)
                  {
                  ?>
                    <li><a rel="nofollow" href="#" class="dropdown-item"> 
                        <div class="notification d-flex justify-content-between">
                          <div class="notification-content"><i class="fa fa-envelope"></i><?php echo strtoupper($tf->surname);?></div>
                        </div></a>
                    </li>
                    <?php
                      }
                    }
                    ?>
                    
                    <li><a rel="nofollow" href="mandatesChange.php" class="dropdown-item all-notifications text-center"> <strong> <i class="fa fa-bell"></i>View all request for Password change                                            </strong></a></li>
                  </ul>
                </li>
                
                <li class="nav-item"><a href="logout.php" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>