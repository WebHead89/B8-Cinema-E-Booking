<?php
include("View/User_View/View.php");
session_start();

$homepage_trailer = "https://www.youtube.com/embed/In8fuzj3gck?autoplay=1"; // connect this to DB


$view = new View();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/homepage.css" rel="stylesheet">
    <link href="../css/form-validation.css" rel="stylesheet">
    <title>Homepage</title>
</head>

<body>

<?php


// display the navbar
echo $view->getUserNavBar_Home();

// display the trailer
echo $view->getTrailer($homepage_trailer);

// display the movies
echo $view->getMovies();

?>


<script type="text/javascript">
        // Get all movie cards
        function sortMovies() {
            // 0 = All movies
            // 1 = Action
            // 2 = Comedy
            // 3 = Horror
            // 4 = Sci Fi
            // 5 = Romance
            // -1 = Currently Playing
            // -2 = Coming Soon

            // var movie_cards = document.getElementsByTagName("movie-card");
            // var movie_cards = document.getElementById("movieCardCol");
            var col_cards = document.getElementsByName("movieCardCol")
            var movie_cards = document.getElementsByTagName("movie-card")
            var sortingID = document.movieSorting.movieCategories.options[document.movieSorting.movieCategories.selectedIndex].value;
            console.log(movie_cards)
            console.log("Movie card length: " + movie_cards.length)
            console.log("Sorting ID: " + sortingID)

            for (let i = 0; i < movie_cards.length; i++) {

                let classListChange = col_cards[i]
                let movie = movie_cards[i]

                console.log(movie)
                console.log(classListChange)
                
                // Sort by playing status
                if (sortingID < 0) {

                    // Currently Playing
                    if (sortingID == -1) {
                        if (movie.getAttribute("playing") == "0") {
                            // movie.setAttribute("disabled", "1");
                            classListChange.classList.add("d-none");
                        } else {
                            classListChange.classList.remove("d-none");
                            // movie.setAttribute("disabled", "0");
                        }
                    }

                    // Coming Soon
                    if (sortingID == -2) {
                        if (movie.getAttribute("playing") == "1") {
                            // movie.setAttribute("disabled", "1");
                            classListChange.classList.add("d-none");
                        } else {
                            classListChange.classList.remove("d-none");
                            // movie.setAttribute("disabled", "0");
                        }
                    }

                // Show all movies
                } else if (sortingID == 0) {
                    classListChange.classList.remove("d-none");

                    // Sort by genre
                } else {

                    if (movie.getAttribute("genre") != sortingID) {
                        classListChange.classList.add("d-none");
                    } else {
                        classListChange.classList.remove("d-none");

                    }

                }
            }
        }
</script>
<script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>



</html>