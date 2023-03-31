<?php
require 'config/database.php';
error_reporting(0);

//get signup form data if signup button was clicked
if(isset($_POST['submit'])){
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);
    
    // Validation for email
    $emailvalidation = preg_match('/([a-zA-Z0-9])+@+(students.national-u|admin.national-u)+(.edu)+(.ph)/',$email);

    // Checkbox Verification checkbox-verify
    $checkbox = $_POST['checkbox-verify'];
    $checkbox = filter_var($_POST['checkboxverify'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //validate input values
    if (!$fullname) {
        $_SESSION['signup'] = "Please enter your full name";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please enter your username";
    } elseif(!$checkbox == '1'){
        $_SESSION['signup'] = "You must agree with our terms & conditions";
    } elseif (!$emailvalidation) {
        $_SESSION['signup'] = "Please use your National University email";
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $_SESSION['signup'] = "Password should be at least 8 characters in length and should include 
        at least one uppercase and lowercase letter, one number, and one special character";
    } else {
         //check if passwords match
         if($password !== $confirmpassword){
            $_SESSION['signup'] = "Passwords do not match";
        } else {
        //hash password
             $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //check if username or email already exists in database
        $user_check_query = "SELECT * FROM tblAccounts WHERE username='$username' OR email='$email'";
        $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0){
                $_SESSION['signup']= "Username or Email already exists";
            }
        }
    }

    //redirect back to signup page if there was any problem
    if(isset($_SESSION['signup'])){
        //pass form data back to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else { 
        //insert new user into users table
        $insert_user_query = "INSERT INTO tblAccounts SET fullname='$fullname', username='$username', email='$email', 
        password='$hashed_password', is_admin=0";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if(!mysqli_errno($connection)){
            //redirect to login page with success message
            $_SESSION['signup-success'] = "Registered successfully. Please Sign In";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
}else{
    //if button wasn't clicked, bounce back to signup page
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
?>

