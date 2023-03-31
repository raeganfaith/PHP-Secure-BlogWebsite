<?php
require 'partials/header.php';

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
			<a href="<?= ROOT_URL ?>admin/index.php" class="sidenav-link"><li class="sidenav-item text-white"><i class="bi bi-house me-3"></i>Dashboard</li></a>
			<li class="sidenav-item" data-bs-toggle="collapse" data-bs-target="#postmanagement" aria-expanded="false" aria-controls="postmanagement">
				<a class="sidenav-link"><i class="bi bi-pencil-square me-3"></i>Post Management<i class="bi bi-caret-down ms-4"></i></a>
			</li>
			<div class="collapse" id="postmanagement">
				<ul class="text-white list-unstyled">
					<a href="manage-acads.php" class="sidenav-link active"><li class="sidenav-item text-white active ps-5"><i class="bi bi-book me-3"></i>Academics</li></a>
					<a href="manage-blockmates.php" class="sidenav-link"><li class="sidenav-item text-white ps-5"><i class="bi bi-people me-3"></i>Blockmates</li></a>
					<a href="manage-profs.php" class="sidenav-link"><li class="sidenav-item text-white ps-5"><i class="bi bi-eyeglasses me-3"></i>Professors</li></a>
					<a href="manage-faci.php" class="sidenav-link"><li class="sidenav-item text-white ps-5"><i class="bi bi-building me-3"></i>Facilities</li></a>
				</ul>
			</div>
			<a href="manage-accounts.php" class="sidenav-link"><li class="sidenav-item text-white"><i class="bi bi-person-circle me-3"></i>Accounts</li></a>
		</ul>
	</aside>

	<main>
		<div class="d-flex justify-content-between align-items-center">
			<h1 class="fw-bold">Post Management</h1>
			<section>
				<?php if(isset($_SESSION['delete-post-success'])) : //shows if delete post was successful ?>
					<div class="alert_message success p-3">
						<?= $_SESSION['delete-post-success'];
						unset($_SESSION['delete-post-success'])
						?>
					</div>
				<?php endif ?>
			</section>
		</div>
		<hr class="mb-4">

		<div class="row">
			<div class="col-12">
				<div class="card">
					<h4 class="card-header fw-bold sticky-top" id="card-header">Academics</h4>
					<div class="card-body p-0 table-responsive">
						<table class="table">
							<thead>
								<tr class="table-primary">
									<th scope="col" class="ps-3">Comment ID</th>
									<th scope="col">Author ID</th>
									<th scope="col" style="width: 40%;">Comment</th>
									<th scope="col">Date and Time</th>
									<th scope="col" class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody class="align-middle">
								<?php foreach($posts as $post) : ?>
									<tr>
										<td class="ps-3">Raegan Paguirigan</td>
										<td>mynameisraegan</td>
										<td class="pe-3"><?= $post['comment'] ?></td>
										<td><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></td>
										<td class="text-center">
											<button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deletemodal">
												<i class="bi bi-trash3"></i>
											</button>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="deletemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content" style="border-radius: 20px;">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-12 d-flex justify-content-end">
									<i class="bi bi-x" data-bs-dismiss="modal" style="font-size: 2rem; color: black;"></i>
								</div>
							</div>
							<div class="row">
								<div class="col-12 text-center">
									<i class="bi bi-x-circle" style="color: red; font-size: 5rem;"></i>
									<input type="hidden" name="id" id="id">
									<h4 class="fw-bold">Are you sure?</h4>
									<p class="px-4">Are you sure you want to delete this user? This action cannot be undone.</p>
									<div class="choices mt-4 mb-3">
										<button type="button" class="btn btn-primary mb-2 mb-sm-0 mx-2 px-5 shadow" id="btn-primary" data-bs-dismiss="modal">Cancel</button>
										<a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>">
											<button type="button" class="btn btn-danger mx-2 px-5 shadow" id="btn-danger" data-bs-dismiss="modal">Delete</button>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</main>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
