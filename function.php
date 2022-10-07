<?php
// Checks if the buttons are pushed or submmited
if (isset($_POST["submit_post"])) {
    createPost();
}

if (isset($_POST["delete_post"])) {
    delPost();
}

if (isset($_POST["edit_post"])) {
    editPost();
}

if (isset($_POST["delete_com"])) {
    delCom($_REQUEST['post_id'], $_POST["delete_com"]);
}

if (isset($_POST["submit_com"])) {
    createCom($_REQUEST['post_id']);
}

// Checks the database connection
function checkConnection()
{
    include 'conn.php';
    if (!$conn) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
        echo "<strong>Not able to establish Database Connection!</strong>";
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        echo "</div>";
    }
}

// Sends out a notification
function alert($string) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
    echo "<strong>$string</strong> Your news feed has been updated.";
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo "</div>";
}

// Gets all the data from the database
function getData()
{
    include 'conn.php';
    $sql = "SELECT * FROM post";
    $data = mysqli_query($conn, $sql);
    return $data;
}

// Creating a post
function createPost()
{
    include 'conn.php';
    // Creates the post
    $title = $_REQUEST["title"];
    $title= mysqli_real_escape_string($conn , $title);
    $author = $_REQUEST["author"];
    $author= mysqli_real_escape_string($conn , $author);
    $content = $_REQUEST["content"];
    $content= mysqli_real_escape_string($conn , $content);

    $sql = "INSERT INTO post(POST_TITLE, POST_AUTHOR, POST_CONTENT) VALUES('$title', '$author', '$content')";
    mysqli_query($conn, $sql);

    header('Location: index.php?created=success');
    exit();
}

// Selecting a spcefied post
function viewPost()
{
    include 'conn.php';
    $id = $_REQUEST['post_id'];
    $sql = "SELECT * FROM post WHERE POST_ID = $id";
    $data = mysqli_query($conn, $sql);

    return $data;
}

// Deleting a specified post
function delPost()
{
    include 'conn.php';
    $id = $_REQUEST['post_id'];
    $sql = "DELETE FROM post WHERE POST_ID = $id";
    mysqli_query($conn, $sql);
    header('Location: index.php?deleted=success');
    exit();
}

// Editing a specified post
function editPost() {
    include 'conn.php';
    $id = $_REQUEST['post_id'];
    $title = $_REQUEST["title"];
    $title= mysqli_real_escape_string($conn , $title);
    $author = $_REQUEST["author"];
    $author= mysqli_real_escape_string($conn , $author);
    $content = $_REQUEST["content"];
    $content= mysqli_real_escape_string($conn , $content);

    $sql = "UPDATE post SET POST_TITLE = '$title', POST_AUTHOR = '$author', POST_CONTENT = '$content' WHERE POST_ID = '$id'";
    mysqli_query($conn, $sql);

    header('Location: index.php?update=success');
    exit();
}

// Getting all comments that are inside the post
function getCom() {
    include 'conn.php';
    $id = $_REQUEST['post_id'];
    $sql = "SELECT * FROM comment WHERE POST_ID = $id";
    $data = mysqli_query($conn, $sql);

    return $data;
}

// Delete a comment from the post
function delCom($post_id, $id)
{
    include 'conn.php';
    $sql = "DELETE FROM comment WHERE COM_ID = $id";
    mysqli_query($conn, $sql);
    $header = 'page.php?post_id=';
    $header .= $post_id;
    $header .= '&deleted=success';
    header('Location: '.$header);
    exit();
}

// Creating a comment inside the post
function createCom($post_id)
{
    include 'conn.php';
    $author = $_REQUEST["author"];
    $author= mysqli_real_escape_string($conn , $author);
    $content = $_REQUEST["content"];
    $content= mysqli_real_escape_string($conn , $content);

    $sql = "INSERT INTO comment(COM_AUTHOR, COM_CONTENT, POST_ID) VALUES('$author', '$content', '$post_id')";
    mysqli_query($conn, $sql);

    $header = 'page.php?post_id=';
    $header .= $post_id;
    $header .= '&created=success';
    header('Location: '.$header);
    exit();
}
