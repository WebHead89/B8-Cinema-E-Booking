<?php 
    include __DIR__ . "/../../Model/Model.php";

    class View {
        private $model;

        public function __construct() {
            $this->model = new Model();
        }

        public function getAdminNavbar() {
            $navbar = "<nav class='navbar navbar-expand-lg navbar-light bg-light'>
                            <div class='container-fluid'>
                                <a class='navbar-brand' href='home.php'>E-Booking Cinema</a>
                                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavDropdown'
                                    aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle Navigation'>
                                <span class='navbar-toggler-icon'></span>
                                </button>
                                <div class='collapse navbar-collapse' id='navbarNavDropdown'>
                                    <ul class='navbar-nav me-auto order-0'>
                        
                                    </ul>
                        
                                    <div class='d-flex ms-auto order-5'>
                                        <div class='nav-item dropdown justify-content-end'>
                                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button'
                                                data-bs-toggle='dropdown' aria-expanded='false'>
                                                Account
                                            </a>
                                            <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdownMenuLink'>
                                                <li><a class='dropdown-item' href='login.php'>Logout</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>";
            return $navbar;
        } // getAdminNavbar

        public function getAddMovieForm() {
            $formFront = "<div class='container form-control form-block'>
                        <div class='center'>
                            <div class='center text-center'>
                                <h1>Add Movie</h1>
                            </div>
                            <form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' method='POST'>
                                <input type='hidden' id='postID' name='postID' value='addMovie'>

                                <label for='image' class='form-label'>Upload Poster Image (filepath)</label><br>
                                <input type='text' class='form-control' id='image' name='image' required><br>
                    
                                <label for='trailerURL' class='form-label'>Trailer URL</label>
                                <input type='text' class='form-control' id='trailerURL' name='trailerURL' required><br>
                    
                                <label for='title' class='form-label'>Movie Title</label>
                                <input type='text' class='form-control' id='title' name='title' required><br>
                    
                                <label for='cast' class='form-label'>Movie Cast</label>
                                <input type='text' class='form-control' id='cast' name='cast' required><br>
                    
                                <label for='director' class='form-label'>Movie Director</label>
                                <input type='text' class='form-control' id='director' name='director' required><br>
                    
                                <label for='producer' class='form-label'>Movie Producer</label>
                                <input type='text' class='form-control' id='producer' name='producer' required><br>
                    
                                <label for='rating' class='form-label'>Movie Film Rating</label>
                                <input type='text' class='form-control' id='rating' name='rating' required><br>
                    
                                <div>
                                <label for='genere' class='form-label'>Movie Genere</label>
                                        <select class='form-control' id='genere', name='genere'>";

            $formMiddle = "";
            $categories = $this->model->getMovieCategories();
            foreach($categories as $category) { 
                $formMiddle = $formMiddle . "<option> {$category['category']} </option>";
            }

            $formBack =                 "</select>
                                    <br>
                                </div>
                    
                                <div>
                                <label for='isCurrentlyPlaying' class='form-label'>Upcoming/Currently Showing</label>
                                    <select class='form-control' id='isCurrentlyPlaying', name='isCurrentlyPlaying'>
                                        <option> Upcoming </option> <!-- set isCurrentlyPlaying  to 0-->
                                        <option> Currently Showing </option> <!-- set isCurrentlyPlaying  to 1-->
                                    </select>
                                    <br>
                                </div>
                    
                                <label for='synopsis' class='form-label'>Movie Synopsis</label>
                                <textarea rows='5' class='form-control' id='synopsis' name='synopsis' required></textarea><br>
                    
                                </br>
                                <button class='w-100 btn btn-lg btn-primary' type='submit'>Add Movie</button>
                    
                            </form>
                        </div>
                    </div>";


            return $formFront . $formMiddle . $formBack;
        } // getAddMovieForm





    } // View


?>