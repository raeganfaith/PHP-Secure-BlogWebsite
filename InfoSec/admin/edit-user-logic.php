<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    //get updated form data
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

    //check for valid input
    if(!$fullname || !$username){
        $_SESSION['edit-user'] = "Invalid form input on edit page.";
    } else {
        //update user
        $query = "UPDATE tblAccounts SET fullname='$fullname', username='$username', is_admin=$is_admin WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
            $_SESSION['edit-user'] = "Failed to update user.";
        } else {
            $_SESSION['edit-user-success'] = "User $fullname updated successfully.";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-accounts.php');
die();