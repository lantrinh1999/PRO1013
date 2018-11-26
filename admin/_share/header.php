<?php 
require_once $path.'../commons/utils.php';
$id = $_SESSION['login']['id'];
$sql = "select 
      * from users where id = '$id'";

$stmt = $conn->prepare($sql);
$stmt->execute();
$u = $stmt->fetch();
 ?>
<header class="main-header">
	<!-- Logo -->
	<a href="<?= $adminUrl ?>" class="logo">
	  <!-- mini logo for sidebar mini 50x50 pixels -->
	  <span class="logo-mini"><b>A</b>LT</span>
	  <!-- logo for regular state and mobile devices -->
	  <span class="logo-lg"><b>Admin</b>LTE</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
	  <!-- Sidebar toggle button-->
	  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	    <span class="sr-only">Toggle navigation</span>
	  </a>

	  <div class="navbar-custom-menu">
	    <ul class="nav navbar-nav">
	     
	      <li class="dropdown user user-menu">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	          <img src="<?= $siteUrl . $u['avatar'] ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $u['email'] ?></span>
              <br>
              
	        </a>
	        <ul class="dropdown-menu">
	          <!-- User image -->
	          <li style="color: white" class="user-header">
	            <img src="<?= $siteUrl . $u['avatar'] ?>" class="img-circle" alt="User Image">

	          <div>
	          	<br>
	          	<span class="hidden-xs"><?= $u['email'] ?></span>
	          </div>
	          <div>
              	<span class="hidden-xs"><?= $u['fullname'] ?></span>
              </div>
	          </li>
	          <!-- Menu Body -->
	          <!-- Menu Footer-->
	          <li class="user-footer">
	            <div class="pull-left">
	              <a href="<?= $adminUrl ?>profile" class="btn btn-default btn-flat">Profile</a>
	            </div>
	            <div class="pull-right">
	              <a href="<?= $siteUrl ?>logout.php" class="btn btn-default btn-flat">Sign out</a>
	            </div>
	          </li>
	        </ul>
	      </li>
	      <!-- Control Sidebar Toggle Button -->
	      <li>
	        <i href="#" data-toggle=""></i>
	      </li>
	    </ul>
	  </div>
	</nav>
</header>