<?php
include 'partials/header.php';

//fetch current user from database
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM tblAccounts WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-accounts.php');
    die();
}
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
					<a href="manage-acads.php" class="sidenav-link"><li class="sidenav-item text-white ps-5"><i class="bi bi-book me-3"></i>Academics</li></a>
					<a href="manage-blockmates.php" class="sidenav-link"><li class="sidenav-item text-white ps-5"><i class="bi bi-people me-3"></i>Blockmates</li></a>
					<a href="manage-profs.php" class="sidenav-link"><li class="sidenav-item text-white ps-5"><i class="bi bi-eyeglasses me-3"></i>Professors</li></a>
					<a href="manage-faci.php" class="sidenav-link"><li class="sidenav-item text-white ps-5"><i class="bi bi-building me-3"></i>Facilities</li></a>
				</ul>
			</div>
			<a href="manage-accounts.php" class="sidenav-link active"><li class="sidenav-item text-white active"><i class="bi bi-person-circle me-3"></i>Accounts</li></a>
		</ul>
	</aside>

	<main>
		<h1 class="fw-bold">
            <a href="manage-accounts.php"><i class="bi bi-caret-left-square-fill me-4" style="font-size: 2rem; color: var(--secondary-color)"></i></a>Edit Account
        </h1>
		<hr class="mb-4">

        <div class="container px-0">
            <div class="card">
                <h4 class="card-header fw-bold" id="card-header">User Information</h4>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info mb-3">
                                <h6 class="fw-bold">Full Name:</h6>
                                <h6><?= $user['fullname'] ?></h6>
                            </div>
                            <div class="info mb-3">
                                <h6 class="fw-bold">Username:</h6>
                                <h6><?= $user['username'] ?></h6>
                            </div>
                            <div class="info mb-3">
                                <h6 class="fw-bold">Email:</h6>
                                <h6><?= $user['email'] ?></h6>
                            </div>
                            <div class="info mb-3">
                                <h6 class="fw-bold">Admin:</h6>
                                <h6><?= $user['is_admin'] ? 'Yes' : 'No' ?></h6>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST" class="">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                
                                <label for="fullname" class="fw-bold mb-2">Full Name</label>
                                <input class="form-control p-3 mb-3" type="text" name="fullname" value="<?= $user['fullname'] ?>" placeholder="fullname">

                                <label for="username" class="fw-bold mb-2">Username</label>
                                <input class="form-control p-3 mb-3" type="text" name="username" value="<?= $user['username'] ?>" placeholder="username">
                                
                                <label for="userrole" class="fw-bold mb-2">Admin</label>
                                <select class="form-select p-3 mb-3" name="userrole">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                                <div class="d-flex justify-content-end mt-md-5">
                                    <button type="submit" name="submit" class="btn btn-primary px-4" id="btn-primary">Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-md-end mt-3">
                    <button class="btn btn-outline-danger mb-4 px-4"  onclick="deleteme(<?php echo $user['id']; ?>)">Delete Account</button>
                <?php ?>
                    <script language = "javascript">
                    function deleteme(delid){
                        swal({
                          title: "Are you sure?",
                          text: "Once deleted, you will not be able to recover this account!",
                          icon: "warning",										  
                          buttons: true,
                          dangerMode: true,
                        })
                        .then((willDelete) => {
                          if (willDelete) {
                            window.location.href = 'delete-user.php?del_id=' +delid+'';
                          }
                        });
                    }
                    </script>
                <?php ?>
            </div>
        </div>

	</main>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>




