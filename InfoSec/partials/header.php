<?php
require 'config/database.php';

//fetch current user from database
if(isset($_SESSION['user-id'])){
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id FROM tblAccounts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $users = mysqli_fetch_assoc($result);
}
?>