<?php
$movieSet = 0;
session_start();
if(isset($_SESSION["movie"])){
$movieSet = 1;
unset($_SESSION["movie"]); //unset the session so if i visit the addmovie page it will not show the alert on top
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Add Movie</title>
</head>

<body>
<?php
    if ($movieSet) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Movie Added! </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <h1 class="text-center mt-5">Add Movie</h1>
    <div class="container mt-5">
        <form action="addmovieconnect.php" method="post">
            <div class="mb-3">
                <label for="movie" class="form-label">Movie</label>
                <input id="movie" type="text" class="form-control" placeholder="Enter Movie" name="movie" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input id="genre" type="text" class="form-control" placeholder="Enter Genre" name="genre" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">Image</label>
                <input id="link" type="text" class="form-control" placeholder="Paste image link" name="link" autocomplete="off">
            </div>


            <button type="submit" class="btn btn-primary w-100">Add</button>

            <a href="home.php" class="btn btn-primary w-100 mt-2">Home</a>
        </form>
    </div>
</body>

</html>