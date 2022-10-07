<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomasino Blog</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://fonts.cdnfonts.com/css/din-condensed" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/eingrantch-mono" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Karla' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light mb-3 p-3">
        <div class="container">
            <a href="./index.php">
                <i class="fas fa-cat fa-2x me-3 cat"></i>
                <span class="navbar-brand mb-0 h1 title">Tomasino Blog</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto right-nav">
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-file fa-2x"></i></button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        include 'function.php';
        checkConnection();
        $data = getData();

        if (isset($_REQUEST['created'])) {
            if ($_REQUEST['created'] == "success") {
                alert("Succesfully created a new post!");
            }
        }

        if (isset($_REQUEST['deleted'])) {
            if ($_REQUEST['deleted'] == "success") {
                alert("Succesfully deleted a post!");
            }
        }

        if (isset($_REQUEST['update'])) {
            if ($_REQUEST['update'] == "success") {
                alert("Succesfully updated a post!");
            }
        } ?>

        <div class="d-flex">
            <div class="row">
                <?php foreach ($data as $d) { ?>
                    <div class="col-4 mb-3" style="height: 300px;">
                        <div class="card h-100 index">
                            <div class="card-body text-truncate-container">
                                <h4 class="card-title"><?php echo $d['POST_TITLE']; ?></h4>
                                <small class="card-text text-muted"><?php echo 'By: ', $d['POST_AUTHOR'], ' | ', $d['POST_DATE']; ?></small>
                                <p class="card-text"><?php echo $d['POST_CONTENT']; ?></p>
                                <a href="page.php?post_id=<?php echo $d['POST_ID']; ?>" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Editing this post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Input1" class="form-label">Article Title</label>
                            <input type="text" name="title" class="form-control" id="Input1" placeholder="Input title" required>
                        </div>
                        <div class="mb-3">
                            <label for="Input2" class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" id="Input2" placeholder="Input name of author" required>
                        </div>
                        <div class="mb-3">
                            <label for="Input3" class="form-label">Content</label>
                            <textarea class="form-control" name="content" id="Input3" placeholder="Lorem ipsum..." rows="12" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="submit_post">Confirm</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>