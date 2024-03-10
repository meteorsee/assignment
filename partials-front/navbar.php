<?php include("config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">
	<link rel="shortcut icon" href="favicon.png">

	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->
	<title>Register - Food Order System</title>
    <link rel="stylesheet" href="css/user-login-register.css">
</head>
	<!-- Start Header/Navigation -->
	<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

		<div class="container">
			<a class="navbar-brand" href="index.php">Furni<span>.</span></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
				aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'index.php')
						echo 'active'; ?>">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'category.php')
						echo 'active'; ?>">
						<a class="nav-link" href="category.php">Category</a>
					</li>
					<li
						class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'product-search.php' || basename($_SERVER['PHP_SELF']) == 'shop.php')
							echo 'active'; ?>">
						<a class="nav-link" href="shop.php">Shop</a>
					</li>
					<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'about.php')
						echo 'active'; ?>">
						<a class="nav-link" href="about.php">About</a>
					</li>
					<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'services.php')
						echo 'active'; ?>">
						<a class="nav-link" href="services.php">Services</a>
					</li>
					<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'blog.php')
						echo 'active'; ?>">
						<a class="nav-link" href="blog.php">Blog</a>
					</li>
					<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'contact.php')
						echo 'active'; ?>">
						<a class="nav-link" href="contact.php">Contact</a>
					</li>

				</ul>

				<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
					<li><a class="nav-link" href="user-login.php"><img src="images/user.svg"></a></li>
					<li><a class="nav-link" href="cart.php"><img src="images/cart.svg"></a></li>
				</ul>
			</div>
		</div>

	</nav>
	<!-- End Header/Navigation -->