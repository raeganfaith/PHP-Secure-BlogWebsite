<?php
require 'config/database.php';

//get form data if submit button was clicked
if(isset($_POST['submit'])){
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

     // Validate password strength
     $uppercase = preg_match('@[A-Z]@', $password);
     $lowercase = preg_match('@[a-z]@', $password);
     $number    = preg_match('@[0-9]@', $password);
     $specialChars = preg_match('@[^\w]@', $password);
     
     // Validation for email
     $emailvalidation = preg_match('/([a-zA-Z0-9!#$%&’?^_`~-])+@+(students.national-u|admin.national-u)+(.edu)+(.ph)/',$email);

    //validate input values
    if (!$fullname) {
        $_SESSION['add-user'] = "Please enter your Full Name.";
    } elseif (!$username) {
        $_SESSION['add-user'] = "Please enter your Username";
    } elseif (!$emailvalidation) {
        $_SESSION['add-user'] = "Please enter a National University email";
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $_SESSION['add-user'] = "Password should be at least 8 characters in length and should include at least one uppercase and lowercase letter, one number, and one special character";
    } else {
        //check if passwords match
        if($password !== $confirmpassword){
            $_SESSION['add-user'] = "Passwords do not match";
        } else {
            //hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //check if username or email already exists in database
        $user_check_query = "SELECT * FROM tblAccounts WHERE username='$username' OR email='$email'";
        $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0){
                $_SESSION['add-user']= "Username or Email already exists";
            } 
        }
    }

    //redirect back to add-user page if there was any problem
    if(isset($_SESSION['add-user'])){
        //pass form data back to add-user page
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-user.php');
        die();
    } else { 
        //insert new user into users table
        $insert_user_query = "INSERT INTO tblAccounts SET fullname='$fullname', username='$username', email='$email', password='$hashed_password', is_admin=$is_admin";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if(!mysqli_errno($connection)){
            //redirect to login page with success message
            $_SESSION['add-user-success'] = "New user $fullname added successfully";
            header('location: ' . ROOT_URL . 'admin/manage-accounts.php');
            die();
        }
    }
}else{
    //if button wasn't clicked, bounce back to add-user page
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}