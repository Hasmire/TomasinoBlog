<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomasino Blog: Create a Post</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <?php
    include 'function.php';
    $data = viewPost();
    if (isset($_POST["edit_post"])) {
        editPost();
    }
    ?>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light mb-3 p-3">
        <div class="container">
            <i class="fas fa-cat fa-2x me-3"></i>
            <span class="navbar-brand mb-0 h1">Tomasino Blog</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav ms-auto">
                    <a class="nav-item nav-link me-4" href="./index.php">Home</a>
                    <?php foreach ($data as $d) { ?>
                        <a class="btn btn-outline-dark me-4" role="button" href="page.php?post_id=<?php echo $d['POST_ID']; ?>">Go Back</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <?php
    checkConnection();
    ?>

    <div class="container w-50">
        <form method="POST">
            <?php foreach ($data as $d) { ?>
                <div class="mb-3">
                    <label for="Input1" class="form-label">Article Title</label>
                    <input type="text" name="title" class="form-control" id="Input1" value=<?php echo $d['POST_TITLE']; ?> required>
                </div>
                <div class="mb-3">
                    <label for="Input2" class="form-label">Author</label>
                    <input type="text" name="author" class="form-control" id="Input2" value=<?php echo $d['POST_AUTHOR']; ?> required>
                </div>
                <div class="mb-3">
                    <label for="Input3" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="Input3" rows="12" required><?php echo $d['POST_CONTENT']; ?></textarea>
                </div>
            <?php } ?>

            <button type="submit" class="btn btn-outline-dark" name="edit_post">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>