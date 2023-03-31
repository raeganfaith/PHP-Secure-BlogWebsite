<?php
require 'config/database.php';

if (isset($_SESSION['locked'])) {
   $now = time();
   if($now >= ($_SESSION['locked'])) {
    unset($_SESSION['attempt']);
    unset($_SESSION['locked']);
   }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self' cdn.jsdelivr.net 'unsafe-inline';"> -->

    <title>PawTalk</title>

    <link rel="icon" href="./images/white-logo.png">
    <!-- To automatically reload css-->
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/signin.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container-fluid mt-0 mt-lg-4">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1">
                <div class="signin-form p-xl-5">
                    <section class="form_section my-3 p-md-4">
                        <div class="form_section-container">
                            <?php if (isset($_SESSION['signup-success'])) : ?>
                                <div class="alert_message success p-3">
                                    <?= $_SESSION['signup-success'];
                                    unset($_SESSION['signup-success'])
                                    ?>
                                </div>
                            <?php elseif (isset($_SESSION['signin'])) : ?>
                                <div class="alert_message error p-3">
                                    <?= $_SESSION['signin'];
                                    unset($_SESSION['signin'])
                                    ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </section>
                    <form action="<?= ROOT_URL ?>signin-logic.php" class="form-control" id="frmLogin" autocomplete="off" method="POST">
                        <input type="hidden" class="form-control" id="form_name" name="form_name" value="frmLogin">
                        <h1 class="h3 mb-0 fw-bold">Sign In</h1>
                        <p>Enter your username and password to sign in</p>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control p-3" id="username" name="username" placeholder="Username" pattern="^[a-zA-Z0-9-_.]{5,20}$" title="Username should contain a minimum of 5 characters">
                        </div>
                        <div class="form-group mb-3 password-container">
                            <input type="password" class="form-control p-3" id="password" name="password" placeholder="Password" pattern="(?=[A-Za-z0-9@#$%^&+!=]+$)^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+!=])(?=.{8,}).*$" title="Password should be at least 8 characters in length and should include at least one uppercase and lowercase letter, one number, and one special character">
                            <i class="fa-solid fa-eye" id="eye"></i>
                        </div>
                        <?php if (isset($_SESSION['locked'])) : ?>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary fw-bold shadow my-3 py-3" id="btn-primary" name="submit" disabled="true">Sign in</button>
                            </div>
                        <?php else : ?>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary fw-bold shadow my-3 py-3" id="btn-primary" name="submit">Sign in</button>
                            </div>
                        <?php endif ?>
                    </form>
                    <div class="text-center pt-0 px-lg-2 px-1">
                        <p class="mb-4 text-sm mx-auto">
                            Don't have an account?
                            <a routerLink="signup" class="text-decoration-none fw-bold account-btn" href="signup.php">Sign up</a>
                        </p>
                    </div>
                </div>     
            </div>
            <div class="col-lg-6 px-0 px-lg-3 order-1 order-lg-2">
                <div class="signin-banner d-block">
                    <div class="side-img color-overlay" style="background-image: url('images/signin-abstract.jpg');">
                        <div class="color-overlay d-flex justify-content-center align-items-center">
                            <div class="text-center signin-header">
                                <img src="images/white-logo.png" alt="" class="mb-3">
                                <h3 class="fw-bolder">Let your bark be heard!</h3>
                                <p>A free space where Nationalians can speak their mind, vent, and ask for advice.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>