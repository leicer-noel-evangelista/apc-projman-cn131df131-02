<!DOCTYPE html>
<?php
	include("php/init.php");
	$isOtherPage = (isset($isOtherPage))?$isOtherPage:true;
	if($isOtherPage) {
		Helper::checkActivity();
	}
?>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="content-language" content="en">
		<meta charset="utf-8">
		<!-- Bootstrap -->
		<link href="css/jquery-ui.min.css" rel="stylesheet">
		<link href="css/jquery-ui.theme.min.css" rel="stylesheet">
		<link href="css/jquery-ui.structure.min.css" rel="stylesheet">
		
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		
		<link href="css/reset.css" rel="stylesheet">
		<link href="css/header.css" rel="stylesheet">
		<?php
		$listOfCss = (isset($listOfCss))?$listOfCss:array();
		$active = (isset($active))?$active:"";
		foreach($listOfCss as $css) {
			echo '<link href="css/'.$css.'.css" rel="stylesheet">';
		}
		?>
		<title><?php echo BPHIMS_WEB_TITLE; ?></title>
		<link rel="icon" href="img/default/icon.png">
	</head>
	<body>
		<div id="main-header">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3> <img src="img/default/logo.png">  <span></span> <?php echo BPHIMS_APPLICATION_NAME; ?></h3>
						<link rel="icon" href="img/default/icon.png">
	</head>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<ul class="nav nav-pills">

						<li class="<?php echo ($active=="home")?"active":""; ?>">
								<a href="index.php">Home</a>
							</li>

							<li class="<?php echo ($active=="dashboard")?"active":""; ?>">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dashboard <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="dashboard_supply.php">Supply</a>
									</li>
									<li>
										<a href="dashboard_equipment.php">Equipment</a>
									</li>
								</ul>
							</li>
							<li class="dropdown <?php echo ($active=="transactions")?"active":""; ?>">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Transactions <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="transactions.php">View Transactions</a>
									</li>
									<li>
										<a href="transactions_department_create.php">Create Department Request</a>
									</li>
									<li>
										<a href="transactions_doctor_create.php">Create Doctor Request</a>
									</li>
								</ul>
							</li>
							<li class="dropdown <?php echo ($active=="deliveries")?"active":""; ?>">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Deliveries <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="deliveries.php">View Deliveries</a>
									</li>
									<li>
										<a href="deliveries_create.php">Create Deliveries</a>
									</li>
								</ul>
							</li>
							<li class="dropdown <?php echo ($active=="inventories")?"active":""; ?>">
								<a class="dropdown-toggle" data-toggle="dropdown" href="#">Inventories <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="inventories_supply.php">Supply</a>
									</li>
									<li>
										<a href="inventories_equipment.php">Equipment</a>
									</li>
									<li>
										<a href="inventories_create.php">Create Item</a>
									</li>
								</ul>
							</li>
							<?php
								if($_SESSION['user_id'] != 0) {
							?>

							<li>
								<a href="logout.php">Logout</a>
							</li>

							<?php
								} else {
							?>
							<?php
								}
							?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div id="main-body">
			<div class="container">
				<div class="row">
					<!--Sidebar content-->
					<div id="main-sidebar" class="col-md-3">
						<?php
							if($_SESSION['user_id'] == 0) {
						?>
						<div id="main-login">
							<h4>Login</h4>
							<form action="php/action.php" method="post">
								<input type="hidden" name="action" value="authentication" />
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="Username">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								</div>
								<button type="submit" class="btn btn-primary">Login</button>
							</form>
						</div>
						<br/> 
						<?php $systemMessage = Helper::getMessage(); ?>
						<?php } else { ?>
						<div id="main-profile">
							<h4>User</h4>
							<center>
								<img src="img/default/default-avatar.png" class="img-thumbnail">
								<br/>
								<span><?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?></span>
							</center>
						</div>
						<?php } ?>
						<hr/>
						<div id="main-newsfeed">
							<h4>News</h4>
							<div class="news">
								<span class="title">New Equipment</span><br/>
								The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog.
							</div>
							<div class="news">
								<span class="title">New Equipment</span><br/>
								The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog.
							</div>
							<div class="news">
								<span class="title">New Equipment</span><br/>
								The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog. The quick brown fox jumps over the lazy dog.
							</div>
						</div>
					</div>
					<!--Body content-->
					<div class="col-md-9">
		