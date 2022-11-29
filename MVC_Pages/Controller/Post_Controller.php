<?php
    include __DIR__ . "/../Model/Model.php";
    $model = new Model();

    if(isset($_POST['postID'])) {

        // POST to add a new movie
        if($_POST['postID'] == "addMovie") {
            // setting all variables from $_POST
            $posterImage=$_POST["image"];
            $trailerURL=$_POST["trailerURL"];
            $title=$_POST["title"];
            $cast=$_POST["cast"];
            $director=$_POST["director"];
            $producer=$_POST["producer"];
            $rating=$_POST["rating"];
            $genere=$_POST["genere"];
            $isCurrentlyPlaying=$_POST["isCurrentlyPlaying"];
            $synopsis=$_POST["synopsis"];

            // copy file to website folder
            $filename = basename($posterImage);
            $filepath = "Assets/" . $filename;
            copy($posterImage, $filepath);
            $filepath = "MVC_Pages/Controller/" . $filepath;

            // get isCurrentlyPlaying and genere
            if($isCurrentlyPlaying == "Upcoming") {
                $x = 0;
            } else {
                $x = 1;
            }

            // get movie categories
            $categories = $model->getMovieCategories();
            $generes = array_column($categories, "idCategory", "category");
            $genereID = $generes[$genere];

            // sql insert statement to update the database 
            $model->addNewMovie($title, $cast, $director, $producer, $synopsis, $filepath, $trailerURL, $rating, $genereID, $x);

            // redirect to admin home
            header("Location: admin_home.php");
        }



    }


?>