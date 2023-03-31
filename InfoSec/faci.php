<?php
require 'config/database.php';

//fetch current user from database
if (isset($_SESSION['user-id'])) {
	$id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT username FROM tblAccounts WHERE id=$id";
	$result = mysqli_query($connection, $query);
	$username = mysqli_fetch_assoc($result);
}

//fetch facilities posts from posts table
$query = "SELECT * FROM tblComments WHERE category_id=4 ORDER BY date_time DESC";
$posts = mysqli_query($connection, $query);
?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="default-src 'self' cdn.jsdelivr.net 'unsafe-inline';">
	
	<title>PawTalk</title>

	<link rel="icon" href="./images/white-logo.png">
	<!-- To automatically reload css on php-->
	<link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
	<div class = "fixed-container">
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top px-3">
			<div class="container-fluid">
				<a href="index.php"><img src="images/white-logo.png" alt="" class="nav-logo"></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
					<ul class="navbar-nav mx-auto my-3 my-lg-0">
						<li class="nav-item"><a class="nav-link" href="index.php">All</a></li>
						<li class="nav-item"><a class="nav-link" href="acads.php">Academics</a></li>
						<li class="nav-item"><a class="nav-link" href="blockmates.php">Blockmates</a></li>
						<li class="nav-item"><a class="nav-link" href="profs.php">Professors</a></li>
						<li class="nav-item"><a class="nav-link active" href="faci.php">Facilities</a></li>
					</ul>
					<?php if (isset($_SESSION['user-id'])) : ?>
						<div class="nav-item dropdown">
							<a class="nav-link p-0 dropdown-toggle text-white mb-2 mb-lg-0" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?php echo $username['username']; ?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="logout.php">Logout</a></li>
							</ul>
						</div>
					<?php else : ?>
						<a href="<?= ROOT_URL ?>signin.php"><button class="btn btn-outline-light px-4">Sign In</button></a>
					<?php endif ?>
				</div>
			</div>
		</nav>
		<header class="masthead">
			<div class="container h-100" id="up">
				<div class="row h-100 align-items-center">
					<div class="col-12 text-center pt-5 mt-5">
						<h2 class="text-white">PawTalk is a safe outlet that offers freedom for all Nationalians to be outspoken regarding their academics, blockmates, and professors.
							<br>Help us Improve our University!
						</h2>
					</div>
				</div>
			</div>
		</header>
		<main>
			<div class="container-fluid">
				<div class="comments">
					<?php while ($post = mysqli_fetch_assoc($posts)) : ?>
						<div class="card" id="card">
							<h5 class="card-header fw-bold sticky-top"><?= $post['id'] ?></h5>
							<h5 class="card-body"><?= $post['comment'] ?></h5>
							<div class="card-footer">
								<div class="d-flex justify-content-between">
									<h6 class="mb-0">
										<?php
										//fetch category from categories table using category_id of post
										$category_id = $post['category_id'];
										$category_query = "SELECT * FROM tblCategories WHERE id=$category_id";
										$category_result = mysqli_query($connection, $category_query);
										$category = mysqli_fetch_assoc($category_result);
										?>
										<?= $category['title'] ?>
									</h6>
									<h6 class="mb-0"><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></h6>
								</div>
							</div>
						</div>
					<?php endwhile ?>
				</div>
			</div>
		</main>
		<footer id="footer" class="footer mt-5">
		<div class="footer-top">
			<div class="container">
				<div class="row g-6 pb-5">
					<div class="col-lg-12">
					<div class = "row pt-4">
						<div class="up-icon-container">
            				<a href="#up">
            				  <img class="up-icon" src="images/up-btn.png" style="height: 60px; width: 60px; float:right;">
            				</a>
          				</div>		
					</div>
					<div class="row  pt-5">
					<div class="col-lg-4 col-md-12 text-center text-md-start footer-info">
						<a routerLink="/home" style="text-decoration: none;">
							<li class="d-flex align-items-center justify-content-center justify-content-lg-start mb-4">
								<img src="images/white-logo.png" alt="PawTalk logo" class="footer-logo mb-4">
							</li>
						</a>
						<p>A safe outlet where Nationalians can freely express their concerns, opinions, and problems regarding academics, blockmates, professors, and the university.</p>
					</div>
					<div class="col-lg-3 footer-links text-center text-lg-start offset-1">
						<h5 class="text-uppercase fw-bold mb-3">Quick Links</h5>
						<ul class="list-unstyled">
							<li><a class="quick-l" href="index.php">All</a></li>
							<li><a class="quick-l" href="acads.php">Academics</a></li>
							<li><a class="quick-l" href="blockmates.php">Blockmates</a></li>
							<li><a class="quick-l" href="profs.php">Professors</a></li>
							<li><a class="quick-l" href="faci.php">Facilities</a></li>
						</ul>
					</div>
					<div class="col-lg-2 footer-links text-center text-lg-start">
						<h5 class="text-uppercase fw-bold mb-3">Policies</h5>
						<ul class="list-unstyled">
							<li><a class="quick-l" href="terms-condition.php">Terms & Conditions</a></li>
							<li><a class="quick-l" href="privacy-policies.php">Privacy Policies</a></li>
							<li><a class="quick-l" href="disclaimer.php">Disclaimer</a></li>
						</ul>
					</div>
				
					</div>

					</div>
				</div>
			</div>
		</div>
		<div class="foot-extend d-flex justify-content-between align-items-center">
			<p class="m-2">PawTalk Copyright 2023 ©</p>
		</div>
	</footer>
	
	<a href="index.php#card-comment">
		<button class="comment-shortcut btn btn-primary" id="comment-btn">
			<i class="bi bi-pen"></i>
		</button>
	</a>

	</div>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>