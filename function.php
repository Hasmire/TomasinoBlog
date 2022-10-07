<?php
// Check if the database is connected
function checkConnection()
{
    include 'conn.php';
    if (!$conn) {
        echo "<h3 class='container bg-warning text-dark text-center rounded-lg mb-3 p-2'>Not able to establish Database Connection!</h3>";
    }
}

function alert($string) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
    echo "<strong>$string</strong> Your news feed has been updated.";
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo "</div>";
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

function getCom() {
    include 'conn.php';
    $id = $_REQUEST['post_id'];
    $sql = "SELECT * FROM comment WHERE POST_ID = $id";
    $data = mysqli_query($conn, $sql);

    return $data;
}

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

function createCom($post_id)
{
    include 'conn.php';
    // Creates the post
    $author = $_REQUEST["author"];
    $content = $_REQUEST["content"];

    $sql = "INSERT INTO comment(COM_AUTHOR, COM_CONTENT, POST_ID) VALUES('$author', '$content', '$post_id')";
    mysqli_query($conn, $sql);

    $header = 'page.php?post_id=';
    $header .= $post_id;
    $header .= '&created=success';
    header('Location: '.$header);
    exit();
}

?>