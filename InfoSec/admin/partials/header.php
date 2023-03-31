<?php
require 'partials/a-navbar.php';

//check login status
if(!isset($_SESSION['user-id'])){
    header('location: ' . ROOT_URL . 'index.php');
    die();
}
?>

