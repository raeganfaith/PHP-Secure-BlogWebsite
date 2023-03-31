<?php
require 'partials/header.php';

//fetch users from database but not current user
$current_admin_id = $_SESSION['user-id'];
$query = "SELECT * FROM tblAccounts WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);
?>

<aside id="sidebar" class="sidebar">
	<ul class="sidebar-nav list-unstyled" id="sidebar-nav">
		<li class="d-flex justify-content-center mb-3">
			<a class="navbar-brand" href="<?= ROOT_URL ?>admin/index.php">
				<img src="../images/white-logo.png" alt="PawTalk logo" class="nav-logo">
			</a>
		</li>
		<a href="<?= ROOT_URL ?>admin/index.php" class="sidenav-link">
			<li class="sidenav-item text-white"><i class="bi bi-house me-3"></i>Dashboard</li>
		</a>
		<li class="sidenav-item" data-bs-toggle="collapse" data-bs-target="#postmanagement" aria-expanded="false" aria-controls="postmanagement">
			<a class="sidenav-link"><i class="bi bi-pencil-square me-3"></i>Post Management<i class="bi bi-caret-down ms-4"></i></a>
		</li>
		<div class="collapse" id="postmanagement">
			<ul class="text-white list-unstyled">
				<a href="manage-acads.php" class="sidenav-link">
					<li class="sidenav-item text-white ps-5"><i class="bi bi-book me-3"></i>Academics</li>
				</a>
				<a href="manage-blockmates.php" class="sidenav-link">
					<li class="sidenav-item text-white ps-5"><i class="bi bi-people me-3"></i>Blockmates</li>
				</a>
				<a href="manage-profs.php" class="sidenav-link">
					<li class="sidenav-item text-white ps-5"><i class="bi bi-eyeglasses me-3"></i>Professors</li>
				</a>
				<a href="manage-faci.php" class="sidenav-link">
					<li class="sidenav-item text-white ps-5"><i class="bi bi-building me-3"></i>Facilities</li>
				</a>
			</ul>
		</div>
		<a href="manage-accounts.php" class="sidenav-link active">
			<li class="sidenav-item text-white active"><i class="bi bi-person-circle me-3"></i>Accounts</li>
		</a>
	</ul>
</aside>
<main>
	<div class="d-flex justify-content-between align-items center">
		<h1 class="fw-bold">Accounts</h1>
		<section>
			<?php if (isset($_SESSION['edit-user-success'])) : //shows if edit user was successful 
			?>
				<div class="alert_message success p-3">
					<?= $_SESSION['edit-user-success'];
					unset($_SESSION['edit-user-success'])
					?>
				</div>
			<?php elseif (isset($_SESSION['delete-user-success'])) : //shows if delete user was successful 
			?>
				<div class="alert_message success p-3">
					<?= $_SESSION['delete-user-success'];
					unset($_SESSION['delete-user-success'])
					?>
				</div>
			<?php elseif (isset($_SESSION['add-user-success'])) : //shows if add user was successful 
			?>
				<div class="alert_message success p-3">
					<?= $_SESSION['add-user-success'];
					unset($_SESSION['add-user-success'])
					?>
				</div>
			<?php endif ?>
		</section>
	</div>
	<hr class="mb-4">

	<div class="d-flex justify-content-end">
		<a href="<?= ROOT_URL ?>admin/add-user.php"><button class="btn btn-warning mb-3 fw-bold" id="btn-warning"><i class="bi bi-plus-circle me-3"></i>Add Account</button></a>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<h4 class="card-header fw-bold" id="card-header">Manage Users</h4>
				<div class="card-body p-0 table-responsive">
					<table class="table">
						<thead>
							<tr class="table-primary">
								<th scope="col" class="ps-3">Full Name</th>
								<th scope="col">Username</th>
								<th scope="col">Email</th>
								<th scope="col">Admin</th>
								<th scope="col" class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody class="align-middle">
							<?php foreach ($users as $user) : ?>
								<tr>
									<td class="ps-3"><?= $user['fullname'] ?></td>
									<td><?= $user['username'] ?></td>
									<td><?= $user['email'] ?></td>
									<td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
									<td class="text-center">
										<a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>">
											<button class="btn btn-warning mb-2 mb-md-0">
												<i class="bi bi-pencil-square"></i>
											</button>
										</a>
										<button class="btn btn-danger" onclick="deleteme(<?php echo $user['id']; ?>)" type="button">
											<i class="bi bi-trash3"></i>
										</button>
									</td>
								</tr>
								<script language="javascript">
									function deleteme(delid) {
										swal({
												title: "Are you sure?",
												text: "Once deleted, you will not be able to recover this account!",
												icon: "warning",
												buttons: true,
												dangerMode: true,
											})
											.then((willDelete) => {
												if (willDelete) {
													window.location.href = 'delete-user.php?del_id=' + delid + '';
												}
											});
									}
								</script>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</main>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>
