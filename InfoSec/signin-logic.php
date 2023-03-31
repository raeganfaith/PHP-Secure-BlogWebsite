<?php
require 'config/database.php';


if(isset($_POST['submit'])){
    //get form data
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //set login attempt if not set
    if(!isset($_SESSION['attempt'])) {
        $_SESSION['attempt'] = 0;
    }

    //check if there are 3 attempt already
    if($_SESSION['attempt'] == 3) {
        $_SESSION['signin'] = "Attempt limit reached (3 failed attempts). Try again in 1 minute.";
    } else {
         //fetch user from database
         $fetch_user_query = "SELECT * FROM tblAccounts WHERE username='$username'";
         $fetch_user_result = mysqli_query($connection, $fetch_user_query);
 
         if(mysqli_num_rows($fetch_user_result) == 1){
             //convert the record into assoc array
             $user_record = mysqli_fetch_assoc($fetch_user_result);
             $db_password = $user_record['password'];
             //compare form password with database password
             if(password_verify($password, $db_password)){
                 //set session for access control
                 $_SESSION['user-id'] = $user_record['id'];
                 //set session if user is an admin
                 if($user_record['is_admin'] == 1){
                     $_SESSION['user_is_admin'] = true;
                     //log user in 
                     header('location: ' . ROOT_URL . 'admin/');
                     unset($_SESSION['attempt']);
                 } else {
                    header('location: ' . ROOT_URL . 'index.php');
                    unset($_SESSION['attempt']);
                 } 
             } else {
                $_SESSION['signin'] = 'Please check your input';
                //this is where we put our 3 attempt limit
                $_SESSION['attempt'] += 1;
                //set the time to allow login if third attempt is reached
                if($_SESSION['attempt'] == 3){
                    $_SESSION['signin'] = "Attempt limit reached (3 failed attempts). Try again in 1 minute.";
                    $_SESSION['locked'] = time() + (60);
                 }
             }
         } else {
             $_SESSION['signin'] = "User not found";
         }
    }

    if(!$username){
        $_SESSION['signin'] = "Username or Email required";
    } elseif (!$password) {
        $_SESSION['signin'] = "Password required";
    } 
    //if there is  any problem, redirect back to signin page with login data
    if(isset($_SESSION['signin'])){
        // $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');
        // die();
    }
} else {
    header('location: ' . ROOT_URL . 'index.php');
    die();
}
