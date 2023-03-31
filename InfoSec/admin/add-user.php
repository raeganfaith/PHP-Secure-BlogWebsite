<?php
include 'partials/header.php';

//get back form data if there was a add-user error
$fullname = $_SESSION['add-user-data']['fullname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$password = $_SESSION['add-user-data']['password'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
//delete signup data session
unset($_SESSION['add-user-data']); 
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
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="fw-bold">
                <a href="manage-accounts.php"><i class="bi bi-caret-left-square-fill me-4" style="font-size: 2rem; color: var(--secondary-color)"></i></a>Add a New Account
            </h1>
            <?php if(isset($_SESSION['add-user'])) : ?>
                <div class="alert_message error p-3">
                    <?= $_SESSION['add-user'];
                    unset($_SESSION['add-user']);
                    ?>
                </div>
            <?php endif ?>
        </div>
		<hr class="mb-4">

        <div class="container px-0">
            <div class="card">
                <h4 class="card-header fw-bold" id="card-header">User Information</h4>
                <div class="card-body p-4">
                    <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST" class="block">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="fullname" class="fw-bold mb-2">Full Name</label>
                                <input class="form-control p-3 mb-3" type="text" name="fullname" value="<?= $fullname ?>">

                                <label for="username" class="fw-bold mb-2">Username</label>
                                <input class="form-control p-3 mb-3" type="text" name="username" value="<?= $username ?>">

                                <label for="email" class="fw-bold mb-2">Email</label>
                                <input class="form-control p-3 mb-3" type="email" name="email" value="<?= $email ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="userrole" class="fw-bold mb-2">Admin</label>
                                <select class="form-select p-3 mb-3" name="userrole">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>

                                <label for="password" class="fw-bold mb-2">Password</label>
                                <input class="form-control p-3 mb-3" type="password" name="password" value="<?= $password ?>">

                                <label for="confirmpassword" class="fw-bold mb-2">Confirm Password</label>
                                <input class="form-control p-3 mb-3" type="password" name="confirmpassword" value="<?= $confirmpassword ?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="submit" class="btn btn-primary px-5" id="btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
