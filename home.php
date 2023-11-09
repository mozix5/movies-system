<?php
$logstatus = 0;
$user = "";
session_start();
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $logstatus = 1;
}
include 'connect.php';
$sql = "select * from movie";
$result = $con->query($sql);
$genreName;
$changepage = 0;
$resultName;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $movieName = strtolower($_POST['movieName']);
    $genreName = $_POST['movieName'];
    $changepage = 1;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">

        <!-- <h1 class="text-white mt-5 main-heading"><strong>Movie Recommendation System</strong></h1> -->
        <h1 class="text-white mt-5 main-heading">
            <?php
            if ($logstatus) {
                echo '<strong>Welcome ' . $user . ',</strong>';
            } else {
                echo '<strong>Movie Recommendation System</strong>';
            }
            ?>

        </h1>
        <h4 class="text-white fw-light mt-4">What are you looking for today?</h4>
        <form action="home.php" method="post">
            <input class="mt-3 w-100" type="text" placeholder="Enter genre name" name="movieName">
            <button class="button-48 mt-3" type="submit"><span class="text">Recommend</span></button>
        </form>

        <!-- <div class="btn-group mt-3 w-100" role="group" aria-label="Basic outlined example">
            <button type="button" class="btn btn-dark">Add Movie</button> &nbsp;
            <button type="button" class="btn btn-dark">Log-in</button>
        </div>

        <div class="btn-group mt-1 w-100" role="group" aria-label="Basic outlined example">
            <button type="button" class="btn btn-dark">Sign-up</button> &nbsp;
            <button type="button" class="btn btn-dark">Log-out</button>
        </div> -->

        <?php
        if (!$logstatus) {
            echo '<div class="btn-group mt-3 w-100" role="group" aria-label="Basic outlined example">
            &nbsp;
            <a href="signup.php" class="btn btn-dark">Sign up</a> &nbsp;
            <a href="login.php" class="btn btn-dark">Log in</a>
        </div>';
        } else {
            echo '<div class="btn-group mt-3 w-100" role="group" aria-label="Basic outlined example">
            <a href="addmovie.php" class="btn btn-dark">Add Movie</a> &nbsp;
            <a href="logout.php" class="btn btn-dark">Log-out</a>
        </div>';
        }
        ?>

        <?php
        if (!$changepage || $genreName == 'All') {


            ?>
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
                <?php
                $id;
                $name;
                $image;
                // $name;
                for ($i = 0; $i < $result->num_rows; $i++) {
                    $row = $result->fetch_assoc();
                    $name = $row['movie'];
                    $image = $row['link'];
                    ?>
                    <div class="col">
                        <div class="card" style="width: 300px;">
                            <img class="card-img" style="height:450px;" src="<?php echo $image; ?>" alt="Card image">
                            <div class="card-img-overlay">
                                <h3 class="card-text text-white fw-normal">
                                    <?php echo $name; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        } else {
            ?>

            <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
                <?php
                $id;
                $name;
                $image;
                // $name;
                $getGenreWithMovieName = "SELECT * FROM movie WHERE genre = '$genreName'";
                $resultName = $con->query($getGenreWithMovieName);

                for ($i = 0; $i < $resultName->num_rows; $i++) {
                    $row = $resultName->fetch_assoc();
                    $name = $row['movie'];
                    $image = $row['link'];
                    ?>
                    <div class="col">
                        <div class="card" style="width: 300px;">
                            <img class="card-img" style="height:450px;" src="<?php echo $image; ?>" alt="Card image">
                            <div class="card-img-overlay">
                                <h3 class="card-text text-white fw-normal">
                                    <?php echo $name; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?php

        }
        ?>


        <!-- <div class="col">

                <div class="card" style="width: 300px;">
                    <img class="card-img" src="./content/movie1.webp" alt="Card image">
                    <div class="card-img-overlay">
                        <h3 class="card-text text-white fw-normal">Batman</h3>
                    </div>
                </div>
            </div> -->





        <div class="mb-5 mt-5">
            Footer
        </div>






    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>