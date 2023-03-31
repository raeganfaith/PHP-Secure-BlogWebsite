<?php
require 'partials/header.php';

//fetch current user from database
if(isset($_SESSION['user-id'])){
    // $id = filter_var($_GET['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM tblAccounts";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
}

//fetch users from database but not current user
$current_admin_id = $_SESSION['user-id'];
$query = "SELECT * FROM tblAccounts WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);

//fetch current user's posts from database
$query = "SELECT * FROM tblComments";
$posts = mysqli_query($connection, $query);
?>


	<aside id="sidebar" class="sidebar">
		<ul class="sidebar-nav list-unstyled" id="sidebar-nav">
			<li class="d-flex justify-content-center mb-3">
				<a class="navbar-brand" href="<?= ROOT_URL ?>admin/index.php">
					<img src="../images/white-logo.png" alt="PawTalk logo" class="nav-logo">
				</a>
			</li>
			<a class="sidenav-link active"><li class="sidenav-item active text-white"><i class="bi bi-house me-3"></i>Dashboard</li></a>
			<li class="sidenav-item" data-bs-toggle="collapse" data-bs-target="#postmanagement" aria-expanded="false" aria-controls="postmanagement">
				<a class="sidenav-link"><i class="bi bi-pencil-square me-3"></i>Post Management<i class="bi bi-caret-down ms-4"></i></a>
			</li>
			<div class="collapse" id="postmanagement">
				<ul class="text-white list-unstyled">
					<a href="manage-acads.php" class="sidenav-link"><li class="sidenav-item ps-5 text-white"><i class="bi bi-book me-3"></i>Academics</li></a>
					<a href="manage-blockmates.php" class="sidenav-link"><li class="sidenav-item ps-5 text-white"><i class="bi bi-people me-3"></i>Blockmates</li></a>
					<a href="manage-profs.php" class="sidenav-link"><li class="sidenav-item ps-5 text-white"><i class="bi bi-eyeglasses me-3"></i>Professors</li></a>
					<a href="manage-faci.php" class="sidenav-link"><li class="sidenav-item ps-5 text-white"><i class="bi bi-building me-3"></i>Facilities</li></a>
				</ul>
			</div>
			<a href="manage-accounts.php" class="sidenav-link"><li class="sidenav-item text-white"><i class="bi bi-person-circle me-3"></i>Accounts</li></a>
		</ul>
	</aside>

	<main>
		<h1 class="fw-bold">Admin Dashboard</h1>
		<hr class="mb-4">
		
		<div class="row">
			<div class="col-md-9 order-2 order-md-1">
				<div class="card" id="user-table">
					<h4 class="card-header fw-bold sticky-top" id="card-header">Manage Users</h4>
					<div class="card-body p-0 table-responsive">
						<table class="table">
							<thead>
								<tr class="table-primary">
									<th scope="col" class="ps-3">Full Name</th>
									<th scope="col">Username</th>
									<th scope="col">Email</th>
									<th scope="col">Admin</th>
								</tr>
							</thead>
							<tbody class="align-middle">
								<?php while($user = mysqli_fetch_assoc($users)) : ?>
									<tr>
										<td class="ps-3"><?= $user['fullname'] ?></td>
										<td><?= $user['username'] ?></td>
										<td><?= $user['email'] ?></td>
										<td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
									</tr>
								<?php endwhile ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-3 mb-3 mb-md-0 order-1 order-md-2">
				<div class="card h-100 text-center text-white" style="background-color: var(--hover-color);">
					<h3 class="text-uppercase fw-bold p-4">Total Number<br>of Users</h3>
					<h1 class="fw-bold pb-4" id="num-users"><?= $count-1 ?></h1>
				</div>
			</div>
		</div>

		<div class="row mt-4 mt-md-5">
			<div class="col-12">
				<div class="card" id="user-table">
					<h4 class="card-header fw-bold sticky-top" id="card-header">Manage Comments</h4>
					<div class="card-body p-0 table-responsive">
						<table class="table">
							<thead>
								<tr class="table-primary">
									<th scope="col" class="ps-3">Comment ID</th>
									<th scope="col">Category</th>
									<th scope="col" style="width: 40%;">Comment</th>
									<th scope="col">Date and Time</th>
								</tr>
							</thead>
							<tbody class="align-middle">
								<?php while($post = mysqli_fetch_assoc($posts)) : ?>
										<?php 
										$category_id = $post['category_id'];
										$category_query = "SELECT title FROM tblCategories WHERE id=$category_id";
										$category_result = mysqli_query($connection, $category_query);
										$category = mysqli_fetch_assoc($category_result);
										?>
									<tr>
										<td class="ps-3"><?= $post['id'] ?></td>
										<td><?= $category['title'] ?></td>
										<td class="pe-3"><?= $post['comment'] ?></td>
										<td><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></td>
									</tr>
								<?php endwhile ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script>
		
	</script>

	<!-- <script src="./sidebar.js"></script> -->
  	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>