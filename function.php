<?php
// Check if the database is connected
function checkConnection()
{
    include 'conn.php';
    if (!$conn) {
        echo "<h3 class='container bg-warning text-dark text-center rounded-lg mb-3 p-2'>Not able to establish Database Connection!</h3>";
    }
}

function getData()
{
    include 'conn.php';
    // Gets the data from the database
    $sql = "SELECT * FROM post";
    $data = mysqli_query($conn, $sql);
    return $data;
}

function createPost()
{
    include 'conn.php';
    // Creates the post
    $title = $_REQUEST["title"];
    $author = $_REQUEST["author"];
    $content = $_REQUEST["content"];

    $sql = "INSERT INTO post(POST_TITLE, POST_AUTHOR, POST_CONTENT) VALUES('$title', '$author', '$content')";
    mysqli_query($conn, $sql);

    header('Location: index.php?created=success');
    exit();
}

function viewPost()
{
    include 'conn.php';
    $id = $_REQUEST['post_id'];
    $sql = "SELECT * FROM post WHERE POST_ID = $id";
    $data = mysqli_query($conn, $sql);

    return $data;
}

function delPost()
{
    include 'conn.php';
    $id = $_REQUEST['post_id'];
    $sql = "DELETE FROM post WHERE POST_ID = $id";
    mysqli_query($conn, $sql);

    header('Location: index.php?deleted=success');
    exit();
}

function editPost() {
    include 'conn.php';
    // Creates the post
    $id = $_REQUEST['post_id'];
    $title = $_REQUEST["title"];
    $author = $_REQUEST["author"];
    $content = $_REQUEST["content"];

    $sql = "UPDATE post SET POST_TITLE = '$title', POST_AUTHOR = '$author', POST_CONTENT = '$content' WHERE POST_ID = '$id'";
    mysqli_query($conn, $sql);

    header('Location: index.php?update=success');
    exit();
}
?>