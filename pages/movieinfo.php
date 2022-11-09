<?php
session_start();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>More Information</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/homepage.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body id="bg">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">E-Booking Cinema</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto order-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a class="nav-link active" href="checkout.php" aria-current="page">View Cart</a>
                    </li>
                </ul>
                <div class="mx-auto">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search Movies"
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                <div class="d-flex ms-auto order-5">
                    <div class="nav-item dropdown justify-content-end">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                            if (isset($_SESSION["user_id"])) {
                                echo "<li><a class='dropdown-item' href='editprofile.php'>Edit Profile</a></li>";
                                echo "<li><a class='dropdown-item' href='logout.php'>Logout</a></li>";
                            } else {
                                echo "<li><a class='dropdown-item' href='login.php'>Login</a></li>";
                                echo "<li><a class='dropdown-item' href='signup.html'>Register</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-1">
            <!Buffer spacing using bootstrap format>
        </div>
        <div class="col-md-12">
            <iframe width="840" height="472.5" src="https://www.youtube.com/embed/6FG3BfPuwBA" title="YouTube video player"
                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
            
    </div>

    <div class="container form-control form-block">
        <div class="row">
            <div class="center text-center">
	            <h1>Troy</h1>
            </div><br>

            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h5>Description</h5>
                <p>It is the year 1250 B.C. during the late Bronze age. Two emerging nations begin to clash 
                    after Paris, the Trojan prince, convinces Helen, Queen of Sparta, to leave her husband, 
                    Menelaus, and sail with him back to Troy. After Menelaus finds out that his wife was taken 
                    by the Trojans, he asks his brother Agamemnon to help him get her back. Agamemnon sees this 
                    as an opportunity for power. So they set off with 1,000 ships holding 50,000 Greeks to Troy. 
                    With the help of Achilles, the Greeks are able to fight the never before defeated Trojans. 
                    But they come to a stop by Hector, Prince of Troy. The whole movie shows their battle 
                    struggles and the foreshadowing of fate in this adaptation of Homer's classic "The Iliad."</p>
            </div>
            <div class="col-md-1"></div>

            <div class="col-md-1"></div>
            <div class="col-md-2">
                <h5>Movie Genere:</h5>
            </div>
            <div class="col-md-9">
                <p>Action, Adventure, Drama</p>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-2">
                <h5>Director:</h5>
            </div>
            <div class="col-md-9">
                <p>Wolfgang Petersen</p>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-2">
                <h5>Movie Cast:</h5>
            </div>
            <div class="col-md-9">
                <p>rad Pitt, Eric Bana, Orlando Bloom</p>
            </div>

            <div class="col-md-1"></div>
            <div class="col-md-4">
                <select class="form-control" id="showtime", name="showtime">
                        <option> Showtimes </option>
                </select>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-2">
                <a href="booking.html" class="btn btn-primary">Buy Tickets</a>
            </div>
                <br><br><br>
        </div>

    </div>

</body>


</html>