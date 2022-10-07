<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomasino Blog: Single Post</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <?php
    include 'function.php';
    $data = viewPost();
    $data_com = getCom();
    if (isset($_POST["delete_post"])) {
        delPost();
    }

    if (isset($_POST["delete_com"])) {
        delCom($_REQUEST['post_id'], $_POST["delete_com"]);
    } ?>

    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light mb-3 p-3">
        <div class="container">
            <i class="fas fa-cat fa-2x me-3"></i>
            <span class="navbar-brand mb-0 h1">Tomasino Blog</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto order-3">
                    <a class="nav-item nav-link me-4" href="./index.php">Home</a>
                    <?php foreach ($data as $d) { ?>
                        <button type="button" class="btn btn-outline-dark me-4" data-bs-toggle="modal" data-bs-target="#delModal">Delete Post</button>
                        <a class="btn btn-outline-dark" role="button" href="edit.php?post_id=<?php echo $d['POST_ID']; ?>">Edit Post</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7 ">
                <?php
                checkConnection();

                if (isset($_REQUEST['deleted'])) {
                    if ($_REQUEST['deleted'] == "success") {
                        alert("Succesfully deleted a comment!");
                    }
                }

                if (isset($_REQUEST['created'])) {
                    if ($_REQUEST['created'] == "success") {
                        alert("Succesfully created a comment!");
                    }
                }

                if (isset($_POST["submit_com"])) {
                    createCom($_REQUEST['post_id']);
                }

                ?>
                <div class="card">
                    <div class="card-body">
                        <?php foreach ($data as $d) { ?>
                            <h1><?php echo $d['POST_TITLE']; ?></h1>
                            <h5><?php echo "By: ", $d['POST_AUTHOR'], " | ", $d['POST_DATE']; ?></h5>
                            <?php echo nl2br($d['POST_CONTENT']); ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <h4>Comment Section:</h4>
                            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addComment">Add a comment</button>
                        </div>
                        <div class="row">
                            <div class="col">
                                <?php foreach ($data_com as $d) { ?>
                                    <div class="d-flex flex-start mb-3 align-items-center">
                                        <i class='fas fa-user-alt fa-2x me-3'></i>
                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="mb-1">
                                                        <?php echo $d['COM_AUTHOR']; ?> <span class="small">- <?php echo $d['COM_DATE']; ?></span>
                                                    </p>
                                                    <form method="POST">
                                                        <button type="submit" class="btn btn-light" name="delete_com" value="<?php echo $d['COM_ID']; ?>"><i class="far fa-trash-alt fa-xs"></i><span class="small"> delete</span></button>
                                                    </form>
                                                </div>
                                                <p class="small mb-0">
                                                    <?php echo $d['COM_CONTENT']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($data as $d) { ?>
        <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delModalLabel">Are you sure you want to delete this post?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">The article '<?php echo $d['POST_TITLE']; ?>' will be gone forver!</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                        <form method="POST">
                            <button type="submit" class="btn btn-danger" name="delete_post">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="modal fade" id="addComment" tabindex="-1" aria-labelledby="addCommentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCommentModalLabel">Creating a comment!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Input1" class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" id="Input2" placeholder="Input name of author" required>
                        </div>
                        <div class="mb-3">
                            <label for="Input2" class="form-label">Content</label>
                            <textarea class="form-control" name="content" id="Input3" placeholder="Lorem ipsum..." rows="12" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning" name="submit_com">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>