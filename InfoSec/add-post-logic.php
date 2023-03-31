<?php
require 'config/database.php';

if(isset($_POST['submit-post'])){
    $author_id = $_SESSION['user-id'];
    $post = filter_var($_POST['post'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);

     //validate form data
     if(!$post){
        $_SESSION['add-post'] = "Enter your comment";
    } elseif (!$category_id){
        $_SESSION['add-post'] = "Select post category";
    } 
 
    //redirect back (with form data) to add-post page if there is any problem
    if(isset($_SESSION['add-post'])){
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'index.php');
        die();
    } else {
        //insert post into database
        $query = "INSERT INTO tblComments (comment, category_id, author_id) VALUES ('$post', $category_id, $author_id)";
        $result = mysqli_query($connection, $query);
        
        if(!mysqli_errno($connection)){
            $_SESSION['add-post-success'] = "Comment posted successfully!";
            header('location: ' . ROOT_URL . 'index.php');
            die();
        }
    }

}

header('location: ' . ROOT_URL . 'index.php');
die();