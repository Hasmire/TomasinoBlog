<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomasino Blog: Single Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <?php
    include 'function.php';
    $data = viewPost();
    if (isset($_POST["delete_post"])) {
        delPost();
    }
    ?>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light mb-3 p-3">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Tomasino Blog: Single Post</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto">
                    <a class="nav-item nav-link me-4" href="./index.php">Home</a>
                    <?php foreach ($data as $d) { ?>
                        <a class="btn btn-outline-dark me-4" role="button" href="edit.php?post_id=<?php echo $d['POST_ID']; ?>">Edit Post</a>
                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete Post</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <?php foreach ($data as $d) { ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this post?</h1>
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
    
    <?php
    checkConnection();
    ?>

    <article>
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7 ">
                    <?php foreach ($data as $d) { ?>
                        <h1><?php echo $d['POST_TITLE']; ?></h1>
                        <h5><?php echo "By: ", $d['POST_AUTHOR'], " | ", $d['POST_DATE']; ?></h5>
                        <?php echo nl2br($d['POST_CONTENT']); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </article>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>