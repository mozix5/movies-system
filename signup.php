<?php
$user = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "connect.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * from `registration` where username='$username'";
    $result = mysqli_query($con, $sql);
    //above lines creates an object of columns that matches with the username values and query function establish a connection with database and sql query is the executable string
    if ($result) {
        $num = mysqli_num_rows($result); //return number of rows in the result set
        //check if username exist by checking the returned number
        if ($num > 0) {
            //user already exist
            $user = 1;
        } else {
            //if not exist create a sql query to insert the user in the table
            $sql = "insert into `registration` (username, password) values ('$username','$password')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                // signup successful
                header('location:login.php');
            } else {
                die(mysqli_error($con));
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Signup Page</title>
</head>

<body>

    <?php
    if ($user) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ohh no Sorry</strong> User already exist.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <h1 class="text-center mt-5">Sign up</h1>
    <div class="container mt-5">
        <form action="signup.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" class="form-control" placeholder="Enter Username" name="username" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input id="pass" type="password" class="form-control" placeholder="Enter password" name="password" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary w-100">Signup</button>
        </form>
    </div>
</body>

</html>