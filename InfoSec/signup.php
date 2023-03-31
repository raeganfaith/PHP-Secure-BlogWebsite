<?php
require 'partials/header.php';

//get back form data if there was a add-user error
$fullname = $_SESSION['signup-data']['fullname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['password'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
//delete signup data session
unset($_SESSION['signup-data']);    
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' cdn.jsdelivr.net 'unsafe-inline';">

    <title>PawTalk</title>

    <link rel="icon" href="./images/white-logo.png">
    <!-- To automatically reload css-->
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/signin.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid mt-0 mt-lg-4">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 px-0 px-lg-3">
                <div class="signin-banner d-block">
                    <div class="side-img color-overlay" style="background-image: url('images/signup-abstract.jpg');">
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
            <div class="col-lg-6 pt-3 pt-lg-0">
                <div class="signin-form p-xl-5">
                <section class="form_section">
                    <div class="form_section-container">
                        <?php if(isset($_SESSION['signup'])) : ?>
                            <div class="alert_message error p-3 mb-3">
                                <?= $_SESSION['signup'];
                                unset($_SESSION['signup']);
                                ?>
                            </div>
                        <?php endif ?>
                    </div>
                </section>
                <form action="<?= ROOT_URL ?>signup-logic.php" class="form-control" id="frmLogin" enctype="multipart/form-data" autocomplete="off" method="POST">
                    <input type="hidden" class="form-control" id="form_name" name="form_name" value="frmLogin">
                    <h1 class="h3 mb-3 fw-bold">Sign Up</h1>
                    <div class="mb-3">
                        <input type="text" class="form-control p-3" id="fullname" name="fullname" placeholder="Full Name" value="<?= $fullname ?>" pattern="[A-Z][a-z]*([\s[A-Z][a-z]*)+$" title="Full name should contain your first and last name">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control p-3" id="username" name="username" placeholder="Username" value="<?= $username ?>" pattern="^[a-zA-Z0-9-_.]{5,20}$" title="Username should contain a minimum of 5 characters">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control p-3" id="email" name="email" placeholder="Email" value="<?= $email ?>" pattern="^[a-zA-Z0-9])*([@students.national-u|@admin.national-u])*([.edu])*([.ph])/" title="Email should be your university email">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control p-3" id="pass" name="password" placeholder="Password" value="<?= $password ?>" pattern="(?=[A-Za-z0-9@#$%^&+!=]+$)^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%^&+!=])(?=.{8,}).*$" title="Password should be at least 8 characters in length and should include at least one uppercase and lowercase letter, one number, and one special character">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control p-3" id="pass" name="confirmpassword" placeholder="Re-enter Password" value="<?= $confirmpassword ?>">
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" value="value1" name = "checkboxverify" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">I agree with the 
                            <a href="terms-condition.php" class="text-decoration-none fw-bold account-btn">Terms and Conditions
                            </a>
                        </label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold my-3 py-3" id="btn-primary" name="submit">Sign Up</button>
                    </div>
                </form>
                <div class="text-center pt-0 px-lg-2 px-1">
                    <p class="mb-4 text-sm mx-auto">
                        Already have an account?
                        <a routerLink="signup" class="text-decoration-none fw-bold account-btn" href="signin.php">Sign In</a>
                    </p>
                </div>
            </div>                 
            </div>           
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>





