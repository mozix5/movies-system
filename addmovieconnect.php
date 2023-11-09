<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $movie = $_POST['movie'];
    $genre = $_POST['genre'];
    $image = $_POST['link'];

    $con =new mysqli('localhost','root','','projectlogin');

    if($con){
        $sql = "insert into `movie` (movie, genre, link) values('$movie','$genre', '$image')";
        $result=mysqli_query($con,$sql);
        if($result){
            echo"Movie added to Database";
            session_start();
            $_SESSION["movie"] = $movie;
            // sleep(3);
            header("location:addmovie.php");
        }
        else{
            die(mysqli_errno($con));
        }
    }
    else{
        die(mysqli_error($con));
    }
 }
?>