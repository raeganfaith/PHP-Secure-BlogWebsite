<?php
require 'config/database.php';

if(isset($_GET['del_id'])){
    $id = filter_var($_GET['del_id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch post from databse in order to delete thumbnail from images folder
    $query = "SELECT * FROM tblComments WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);

    //make sure only 1 record/post was fetched
    if(mysqli_num_rows($result) == 1){
        //delete post from database
        $delete_post_query = "DELETE FROM tblComments WHERE id=$id";
        $delete_post_result = mysqli_query($connection, $delete_post_query);
        
        if(!mysqli_errno($connection)){
            $_SESSION['delete-post-success'] = "Post deleted successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-acads.php');
            die();
        }
    }
}


header('location: ' . ROOT_URL . 'admin/manage-acads.php');
die();