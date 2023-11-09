<?php
$invalid = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "connect.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * from `registration` where username='$username' and password='$password'";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            //login successful
            //if a user logs in a session will start so if the user closes the page and opens again the session will save the data the opens from where you closed the page
            //$_SESSION is a superglobal array in PHP used to manage session variables. Sessions are a way to store data on the server that can be accessed across multiple pages during a user's visit to a website.
            //we are storing the entered username in the username session variable so we can use it anywhere in the project
            session_start();
            $_SESSION["username"] = $username;
            header('location:home.php');
        } else {
            // echo "Invalid data";
            $invalid = 1;
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
    <title>Login Page</title>
</head>

<body>
    
    <?php
    if ($invalid) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Invalid credential! </strong> Please check username and password.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>

    <h1 class="text-center mt-5">Login</h1>
    <div class="container mt-5">
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" class="form-control" placeholder="Enter Username" name="username" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input id="pass" type="password" class="form-control" placeholder="Enter password" name="password" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>

</html>