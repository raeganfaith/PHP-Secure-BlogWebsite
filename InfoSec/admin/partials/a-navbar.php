<?php
require 'config/database.php';

//fetch current user from database
if(isset($_SESSION['user-id'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT username FROM tblAccounts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $username = mysqli_fetch_assoc($result);
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>PawTalk</title>

	<link rel="icon" href="../images/white-logo.png">
  	<link rel="stylesheet" href="../css/admin-main.css">
  	<link rel="stylesheet" href="../css/style.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

	<nav class="navbar navbar-expand-lg fixed-top">
		<div class="container-fluid d-flex justify-content-between">
			<button type="button" id="sidebarCollapse" class="btn btn-primary collapse-btn">
				<i class="fa fa-bars"></i>
				<span class="sr-only"><i class="bi bi-list" style="font-size: 1.5rem;"></i></span>
			</button>
			<div class="nav-item dropdown">
				<a class="nav-link p-0 dropdown-toggle text-white" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<?php echo $username['username']; ?>
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="../logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<script src="./sidebar.js"></script>