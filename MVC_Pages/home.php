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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="../css/homepage.css" rel="stylesheet">
    <title>Homepage</title>


    <style>

        .titleSearch {
            margin-left: 20px;
            padding: 5px;
        }

        #movieCategories {
            margin-left: 5px;
        }
        
    </style>


</head>

<body id='bg'>

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

<script>
    function searchByTitle() {

    var searchInput = document.getElementById("searchbox").value;
    var movie_cards = document.getElementsByTagName("movie-card")
    var col_cards = document.getElementsByName("movieCardCol")
        // console.log(searchInput)
    for (let i = 0; i < movie_cards.length; i++) {

        let classListChange = col_cards[i]
        let movie = movie_cards[i]

        if (movie.getAttribute("title").toLowerCase().includes(searchInput.toLowerCase())) {
            classListChange.classList.remove("d-none");
        } else {
            classListChange.classList.add("d-none");
        }

    }
    
    // console.log(movie_cards)
    console.log("TEXT INPUT")
    }

</script>


<script type="text/javascript" src="Scripts/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="Scripts/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="../components/movieCard.js" type="text/javascript" defer></script>


</body>



</html>