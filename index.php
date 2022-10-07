<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomasino Blog</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light mb-3 p-3">
        <div class="container">
            <i class="fas fa-cat fa-2x me-3"></i>
            <span class="navbar-brand mb-0 h1">Tomasino Blog</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active me-4" aria-current="page" href="./index.php">Home</a>
                    <a class="btn btn-outline-dark" role="button" href="./create.php">Create a Post</a>
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

        <div class="card-group">
            <div class="row">
                <?php foreach ($data as $d) { ?>
                    <div class="col-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-truncate-container">
                                <h5 class="card-title"><?php echo $d['POST_TITLE']; ?></h5>
                                <small class="card-text text-muted"><?php echo 'By: ', $d['POST_AUTHOR'], ' | ', $d['POST_DATE']; ?></small>
                                <p class="card-text"><?php echo $d['POST_CONTENT']; ?></p>
                                <a href="page.php?post_id=<?php echo $d['POST_ID']; ?>" class="btn btn-dark">View Article</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>