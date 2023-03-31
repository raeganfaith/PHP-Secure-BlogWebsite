<?php
require 'config/database.php';

if(isset($_GET['del_id'])){
    $id = filter_var($_GET['del_id'], FILTER_SANITIZE_NUMBER_INT);

    // //fetch user from database
    $query = "SELECT * FROM tblAccounts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    //make sure we got back only one user
    if(mysqli_num_rows($result) == 1){
        //delete user from database
        $delete_user_query = "DELETE FROM tblAccounts WHERE id=$id";
        $delete_user_result = mysqli_query($connection, $delete_user_query);
        if(mysqli_errno($connection)){
            $_SESSION['delete-user'] = "Couldn't delete  '{$user['fullname']}'";
        } else { 
            $_SESSION['delete-user-success'] = "User deleted successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-accounts.php');
die();

