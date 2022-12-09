<?php 
    include __DIR__ . "/../../Model/Model.php";
	include("Singleton.php");
    include("Factory.php");

    class View {
        private $model;
		private $bookingInfo;

        public function __construct() {
            $this->model = new Model();
			if (!isset($_SESSION['bookingInfo'])) {
				$_SESSION['bookingInfo'] = Singleton::getInstance();
			}
			$this->bookingInfo = $_SESSION['bookingInfo'];
        }


		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// Navbar Views
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		public function getUserNavBar_NotHome() {
		if (!isset($_SESSION["user_id"])) {
			$html = "<nav class='navbar navbar-expand-lg navbar-light bg-light'>
						<div class='container-fluid'>
							<a class='navbar-brand' href='home.php'>E-Booking Cinema</a>
							<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavDropdown' aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle Navigation'>
								<span class='navbar-toggler-icon'></span>
							</button>
							<div class='collapse navbar-collapse' id='navbarNavDropdown'>
								<ul class='navbar-nav me-auto order-0'>
									<li class='nav-item'>
										<a class='nav-link active' href='home.php' aria-current='page'>Home</a>
									</li>
								</ul>
								
								<!-- </div> -->
								<div class='d-flex ms-auto order-5'>
									<div class='nav-item dropdown justify-content-end'>
										<a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
											Account
										</a>
										<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdownMenuLink'>";
		} else {
			$html = "<nav class='navbar navbar-expand-lg navbar-light bg-light'>
						<div class='container-fluid'>
							<a class='navbar-brand' href='home.php'>E-Booking Cinema</a>
							<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavDropdown' aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle Navigation'>
								<span class='navbar-toggler-icon'></span>
							</button>
							<div class='collapse navbar-collapse' id='navbarNavDropdown'>
								<ul class='navbar-nav me-auto order-0'>
									<li class='nav-item'>
										<a class='nav-link active' href='home.php' aria-current='page'>Home</a>
									</li>
									<li>
										<a class='nav-link active' href='viewBookings.php' aria-current='page'>View Bookings</a>
									</li>
								</ul>
								
								<!-- </div> -->
								<div class='d-flex ms-auto order-5'>
									<div class='nav-item dropdown justify-content-end'>
										<a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
											Account
										</a>
										<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdownMenuLink'>";
		}

											if (isset($_SESSION['user_id'])) {
												$html = $html . "<li><a class='dropdown-item' href='editprofile.php'>Edit Profile</a></li>";
												$html = $html . "<li><a class='dropdown-item' href='logout.php'>Logout</a></li>";
											} else {
												$html = $html . "<li><a class='dropdown-item' href='login.php'>Login</a></li>";
												$html = $html . "<li><a class='dropdown-item' href='signup.php'>Register</a></li>";
											}

			$html = $html . 			"</ul>
									</div>
								</div>
							</div>
						</div>
					</nav>";
			return $html;
		}

		public function getUserNavBar_Home() {
		if (!isset($_SESSION["user_id"])) {
			$html = "
			<nav class='navbar navbar-expand-lg navbar-light bg-light'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='home.php'>E-Booking Cinema</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavDropdown' aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle Navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNavDropdown'>
                <ul class='navbar-nav me-auto order-0'>
                    <li class='nav-item'>
                        <a class='nav-link active' href='home.php' aria-current='page'>Home</a>
                    </li>
                </ul>
                Sort Movies:
                <div class='col-md-4'>
                    <form name='movieSorting'>
                        <select class='form-control' id='movieCategories' , name='movieCategories' id='movieCategories' onchange='sortMovies()'>
                            <option disabled='true'>Sort By Category</option>
                            <option value='0'>All Movies</option>";
		} else {
			$html = "
			<nav class='navbar navbar-expand-lg navbar-light bg-light'>
        <div class='container-fluid'>
            <a class='navbar-brand' href='home.php'>E-Booking Cinema</a>
            <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavDropdown' aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle Navigation'>
                <span class='navbar-toggler-icon'></span>
            </button>
            <div class='collapse navbar-collapse' id='navbarNavDropdown'>
                <ul class='navbar-nav me-auto order-0'>
                    <li class='nav-item'>
                        <a class='nav-link active' href='home.php' aria-current='page'>Home</a>
                    </li>
                    <li>
                        <a class='nav-link active' href='viewBookings.php' aria-current='page'>View Bookings</a>
                    </li>
                </ul>
                Sort Movies:
                <div class='col-md-4'>
                    <form name='movieSorting'>
                        <select class='form-control' id='movieCategories' , name='movieCategories' id='movieCategories' onchange='sortMovies()'>
                            <option disabled='true'>Sort By Category</option>
                            <option value='0'>All Movies</option>";
		}
							foreach ($this->model->getMovieCategories() as $cat) {  // pasting all categories in list 
                                $html = $html . "<option value='" . $cat["idCategory"] . "'>" . $cat["category"] . "</option>";
                            }

			$html = $html . "
                            <option disabled='true'>Sort by available movies</option>
                            <option value='-1'>Currently Playing</option>
                            <option value='-2'>Coming Soon</option>
                        </select>
                    </form>
                </div>
				<div class='col-md-4'>
				<form name='titleSorting'>
				<input type='text' name='searchbox' id='searchbox' class='titleSearch' placeholder='Search by title here' onkeyup='searchByTitle()'> 
				</form>
				</div>
                <div class='d-flex ms-auto order-5'>
                    <div class='nav-item dropdown justify-content-end'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                            Account
                        </a>
                        <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdownMenuLink'>";
                            if (isset($_SESSION["user_id"])) {
                                $html = $html . "<li><a class='dropdown-item' href='editprofile.php'>Edit Profile</a></li>";
                                $html = $html . "<li><a class='dropdown-item' href='logout.php'>Logout</a></li>";
                            } else {
                                $html = $html . "<li><a class='dropdown-item' href='login.php'>Login</a></li>";
                                $html = $html . "<li><a class='dropdown-item' href='signup.php'>Register</a></li>";
                            }
			$html = $html . "
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>";
		
	return $html;	
		
	}

		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// Booking Views
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		public function getMovieSeats($movieID) {

			// reset the object data if user switches to a new movie
			if($this->bookingInfo->movieID != $movieID) {
				$this->bookingInfo->showID = -1;
				unset($this->bookingInfo->selectedSeatsArray);
				$this->bookingInfo->selectedSeatsArray = array();
				// set the ticket types
				$this->bookingInfo->childTickets = 0;
				$this->bookingInfo->adultTickets = 0;
				$this->bookingInfo->seniorTickets = 0;
			} // if

			// update the buttons table
			if($this->bookingInfo->showID != -1) {
				// get seats from the database
				$seats = $this->model->getShowSeats($this->bookingInfo->showID);
		
				// set the buttonTypeArray from database
				for($i = 0; $i < 27; $i++) {
					if($seats[$i]["isReserved"]) {
						$this->bookingInfo->buttonTypeArray[$i] = 1;
					}
				}
		
			// if there is no show selected reset seats and selectedSeats array
			} else {
				for($i = 0; $i < 27; $i++) {
					$this->bookingInfo->buttonTypeArray[$i] = 2;
				}
				unset($this->bookingInfo->selectedSeatsArray);
				$this->bookingInfo->selectedSeatsArray = array();
				// set the ticket types
				$this->bookingInfo->childTickets = 0;
				$this->bookingInfo->adultTickets = 0;
				$this->bookingInfo->seniorTickets = 0;
			}

			$html = "<div class='column theater'>
						<div id='movie_screen'>
							Movie Screen
						</div>
						<div class='seats'>
							<div class='row first'>";
								$i = 0; 
								for($i; $i < 3; $i++) {
									$button = Factory::getButton($this->bookingInfo->buttonTypeArray[$i], $i);
									$html = $html . "<div class='col-md-1'> " . $button . "</div>";
								} 
			$html = $html . "</div>
							<div class='row second'>";
								$i = 3;
								for($i; $i < 8; $i++) { 
									$button = Factory::getButton($this->bookingInfo->buttonTypeArray[$i], $i);
									$html = $html . "<div class='col-md-1'> " . $button . "</div>";
								}
			$html = $html . "</div>
							<div class='row second'>";
								$i = 8;
								for($i; $i < 13; $i++) {
									$button = Factory::getButton($this->bookingInfo->buttonTypeArray[$i], $i);
									$html = $html . "<div class='col-md-1'> " . $button . "</div>";
								}
			$html = $html . "</div>
							<div class='row third'>";
								$i = 13;
								for($i; $i < 20; $i++) {
									$button = Factory::getButton($this->bookingInfo->buttonTypeArray[$i], $i);
									$html = $html . "<div class='col-md-1'> " . $button . "</div>";
								}
			$html = $html . "</div>
							<div class='row third'>";
								$i = 20;
								for($i; $i < 27; $i++) {
									$button = Factory::getButton($this->bookingInfo->buttonTypeArray[$i], $i);
									$html = $html . "<div class='col-md-1'> " . $button . "</div>";
								}
			$html = $html . "</div>
						</div>
					</div>";

					return $html;
		}

		public function getShowtimes($movieID) {
			// get the showtiimes for the movie
			$showTimes = $this->model->getShowtimes();
			$showTimeArr = array_column($showTimes, "showtime", "idShowtime"); // maps idShowtime to the actual time

			// get the shows for the movie
			$shows = $this->model->getShowsOfMovie($movieID);

			// create the HTML
			$html = "<h3 style='text-align: center'>Showtimes</h3>
						<div class='showtimes'>";
							// if no show is selected, display showtimes
							if($this->bookingInfo->showID == -1) {
								foreach($shows as $show) {
			$html = $html . 		"<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' name='addShow' method='POST'>
										<input type='hidden' id='postID' name='postID' value='showtimeBookingPage'>
										<input type='hidden' id='showID' name='showID' value={$show['idShow']}>
										<input type='hidden' id='showDate' name='showDate' value={$show['date']}>
										<input type='hidden' id='showTime' name='showTime' value='{$showTimeArr[$show['showtimeID']]}'>
										<button class='btn btn-secondary child' type='submit'> {$show['date']} - {$showTimeArr[$show['showtimeID']]} </button>
									</form>";
								} 
							// if a showtime is selected only display that showtime
							} else { 
			$html = $html . "<div class='row'>
									<div class='col-md-7'>
									<button class='btn btn-secondary child'> {$this->bookingInfo->showDate} - {$this->bookingInfo->showTime} </button>
									</div>
									<div class='col-md-2'>
									<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' name='resetShow' method='POST'>
										<input type='hidden' id='postID' name='postID' value='resetShow'>
										<button class='btn btn-secondary child' type='submit'> Reset </button>
									</form>
									</div>
								</div>";
							}
				$html = $html . "</div>";
			return $html;
		}

		public function getSelectedSeats() {
			$html = "<h3 style='text-align: center;'>Seats</h3>
					<div class='showtimes'>";

			if($this->bookingInfo->selectedSeatsArray != NULL) {
				foreach($this->bookingInfo->selectedSeatsArray as $seat) {
					$html = $html . "Seat $seat <br>";
				} 
			}

			$html = $html . "</div>";

			return $html;
		}

		public function getTicketSelector() {
			$numSeats = count($this->bookingInfo->selectedSeatsArray);
			$html = "<div class='ticketSelection'>
						<p>You have selected $numSeats seats. Please choose your ticket types below:</p>
						<div class='ticketType'>
							Adult Tickets: {$this->bookingInfo->adultTickets} Selected
							<div class='btn-group' role='group' aria-label='test'>
								<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' name='removeAdultTicket' method='POST'>
									<input type='hidden' id='postID' name='postID' value='removeAdultTicket'>
									<button type='submit' class='btn btn-secondary'>-</button>
								</form>
								<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' name='addAdultTicket' method='POST'>
									<input type='hidden' id='postID' name='postID' value='addAdultTicket'>
									<button type='submit' class='btn btn-secondary'>+</button>
								</form>
							</div>
						</div>

						<div class='ticketType'>
							Child Tickets: {$this->bookingInfo->childTickets} Selected
							<div class='btn-group' role='group' aria-label='test'>
								<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' name='removeChildTicket' method='POST'>
									<input type='hidden' id='postID' name='postID' value='removeChildTicket'>
									<button type='submit' class='btn btn-secondary'>-</button>
								</form>
								<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' name='addChildTicket' method='POST'>
									<input type='hidden' id='postID' name='postID' value='addChildTicket'>
									<button type='submit' class='btn btn-secondary'>+</button>
								</form>
							</div>
						</div>

						<div class='ticketType'>
							Senior Tickets: {$this->bookingInfo->seniorTickets} Selected
							<div class='btn-group' role='group' aria-label='test'>
								<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' name='removeSeniorTicket' method='POST'>
									<input type='hidden' id='postID' name='postID' value='removeSeniorTicket'>
									<button type='submit' class='btn btn-secondary'>-</button>
								</form>
								<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' name='addSeniorTicket' method='POST'>
									<input type='hidden' id='postID' name='postID' value='addSeniorTicket'>
									<button type='submit' class='btn btn-secondary'>+</button>
								</form>
							</div>
						</div>";

			// calculate total price of tickets
			$ticketPrices = $this->model->getTicketPrices();
			$childPrice = $ticketPrices["CHILD"];
			$adultPrice = $ticketPrices["ADULT"];
			$seniorPrice = $ticketPrices["SENIOR"];
			$totalPrice = $childPrice * $this->bookingInfo->childTickets + $adultPrice * $this->bookingInfo->adultTickets + $seniorPrice * $this->bookingInfo->seniorTickets;
			
			$html = $html . "Total Price: $$totalPrice
						</div>
						<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' name='submitBooking' method='POST'>
							<input type='hidden' id='postID' name='postID' value='submitBooking'>
							<button type='submit' class='btn btn-secondary proceedToPayment'>Add tickets to cart</button>
						</form>
				
					</div>";
			return $html;
		}

		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// ViewBooking Views
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		public function getBookings($userID) {
			// get user info
			$user = $this->model->getUserInfo($userID);
			$userID = $user["id"];

			// get bookings for user
			$bookings = $this->model->getBookings($userID);

			// get showrooms
			$showRooms = $this->model->getShowRooms();
			$roomNames = array_column($showRooms, "name", "idRoom");

			// get showtimes
			$showTimes = $this->model->getShowTimes();
			$showTimeArr = array_column($showTimes, "showtime", "idShowtime");

			// create HTML
			$html = "<div class='container form-control form-block'>
						<h1> Bookings </h1>
						<hr class='my-4'>";

			if($bookings) {
				foreach($bookings as $booking) {
					// print booking
					$html = $html . "BookingID: " . $booking["idBooking"] . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Total Price: $" . $booking["totalPrice"] . "<br>";
					// print show, date, time, room
					// get the show
					$showID = $booking["showID"];
					$show = $this->model->getShow($showID);
					$showTime = $show["showtimeID"];
                    $showRoom = $show["showroomID"];

					// get the movie
					$movie = $this->model->getMovie($show["movieID"]);

					// print show info
					$html = $html . "ShowID: " . $showID . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Movie: " . $movie["title"] 
						. "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ShowDate: " . $show["date"]
						. "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ShowTime: " . $showTimeArr[$showTime]
						. "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ShowRoom: " . $roomNames[$showRoom] . "<br>";

					// print tickets
					$html = $html. "Tickets<br>";
						// get the tickets
						$bookingID = $booking["idBooking"];
						$tickets = $this->model->getTickets($bookingID);
						foreach($tickets as $ticket) {
							$html = $html . "Seat: " . $ticket["seatNumber"] . "<br>";
						}
	
					$html = $html . "<hr class='my-4'>";
						
				}
			} else {
				return "No bookings.";
			}
					
			$html = $html . "</div>";

			return $html;

		}

		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// Checkout View
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		public function getCheckout() {
			$ticketPrices = $this->model->getTicketPrices();
			$totalTickets = count($this->bookingInfo->selectedSeatsArray);

			// get total price
			$childPrice = $ticketPrices["CHILD"];
			$adultPrice = $ticketPrices["ADULT"];
			$seniorPrice = $ticketPrices["SENIOR"];
			$totalPrice = $childPrice * $this->bookingInfo->childTickets + $adultPrice * $this->bookingInfo->adultTickets + $seniorPrice * $this->bookingInfo->seniorTickets;
			
			$seniorTotalPrice = $this->bookingInfo->seniorTickets * $ticketPrices['SENIOR'];
			$adultTotalPrice = $this->bookingInfo->adultTickets * $ticketPrices['ADULT'];
			$childTotalPrice = $this->bookingInfo->childTickets * $ticketPrices['CHILD'];
			
			$discountPrice = $this->bookingInfo->promoDiscount * $totalPrice;
			$finalPrice = $totalPrice - $discountPrice;

			$checkout = "<div class='py-5 text-center'>
							  <h2>Checkout</h2>
							</div>

							<div class='row g-5'>
							  <div class='col-md-5 col-lg-4 order-md-last'>
								<h4 class='d-flex justify-content-between align-items-center mb-3'>
								  <span class='text-primary'>Your cart</span>
								  <span class='badge bg-primary rounded-pill'> {$totalTickets} </span>
								</h4>
								
								<ul class='list-group mb-3'>
								  <li class='list-group-item d-flex justify-content-between lh-sm'>
									<div>
									  <h6 class='my-0'>Ticket: Senior</h6>
									  <small class='text-muted'> x{$this->bookingInfo->seniorTickets}  </small>
									</div>
									<span class='text-muted'> $$seniorTotalPrice </span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between lh-sm'>
									<div>
									  <h6 class='my-0'>Ticket: Adult</h6>
									  <small class='text-muted'> x{$this->bookingInfo->adultTickets} </small>
									</div>
									<span class='text-muted'> $$adultTotalPrice </span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between lh-sm'>
									<div>
									  <h6 class='my-0'>Ticket: Child</h6>
									  <small class='text-muted'> x{$this->bookingInfo->childTickets} </small>
									</div>
									<span class='text-muted'> $childTotalPrice </span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between bg-light'>
									<div class='text-success'>
									  <h6 class='my-0'>Promo code</h6>
									  <small> {$this->bookingInfo->promoCode} </small>
									</div>
									<span class='text-success'> -$$discountPrice </span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between'>
									<span>Total (USD)</span>
									<strong> $$finalPrice </strong>
								  </li>
								</ul>

								<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' class='card p-2' method='POST'>
								  <div class='input-group'>
									<input type='hidden' id='postID' name='postID' value='submitPromo'>
									<input type='text' class='form-control' placeholder='Promo code' name='promo' id ='promo' required>
									<button type='submit' class='btn btn-secondary'>Redeem</button>
								  </div>
								</form>
								
							  </div>					  
							  
							  <div class='col-md-7 col-lg-8'>
								  <hr class='my-4'>
								  <h4 class='mb-3'>Payment</h4>
								  <hr class='my-4'>";

			$userInfo = $this->model->getUserInfo($_SESSION["user_id"]);
			$userID = $userInfo["id"];
			$paymentCards = $this->model->getPaymentCards($userID);

			foreach($paymentCards as $paymentCard) {
				$checkout = $checkout . "<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' method='POST'>
											<input type='hidden' id='postID' name='postID' value='submitPayment'>
											<input type='hidden' id='cardID' name='cardID' value='{$paymentCard['idPaymentCard']}'>
											<div class='row gy-3'>
												<div class='col-md-6'>
												<label class='form-label'>Card Number:</label>
												<label class='form-label'> {$paymentCard['cardNum']} </label>
												</div>

												<div class='col-md-6'>
												<label for='cc-number' class='form-label'>Expiration:</label>
												<label class='form-label'> {$paymentCard['experationDate']} </label>
												</div>
											</div>
											<br>
											<button class='w-20 btn btn-primary btn-lg' type='submit'>Checkout</button>
											</form>
											<hr class='my-4'>";
			}

			$checkout = $checkout . "<h4 class='mb-3'>One Time Payment</h4>
										<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' method='POST'>
											<input type='hidden' id='postID' name='postID' value='submitNewPayment'>
											<div class='row gy-3'>
											<div class='col-md-6'>
												<label for='cc-name' class='form-label'>Card Number</label>
												<input type='text' class='form-control' id='cardNumber' name='cardNumber' placeholder='' required>
											</div>

											<div class='col-md-6'>
												<label for='cc-number' class='form-label'>Expiration</label>
												<input type='text' class='form-control' id='expiration' name='expiration' placeholder='' required>
											</div>
											</div>
											<br>
											<button class='w-20 btn btn-primary btn-lg' type='submit'>Checkout</button>
										</form>
										<br><br>
										</div>
									</div>
									</main>

								</div>";

			return $checkout;
		} // getCheckout

		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// EditProfile View
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		public function getEditProfile() {
			// get USER info
			$user = $this->model->getUserInfo($_SESSION["user_id"]);

			// set USER variables
			$userID = $_SESSION["user_id"];
			$first_name = $user["first_name"];
			$last_name = $user["last_name"];
			$phone = $user["phone"];
			$password = $user["password"];
			$address = $user["address"];
			$city = $user["city"];
			$state = $user["state"];
			$zip = $user["zip"];

			$html = "<div class='container form-control form-block'>
							<div class='center'>
							<h1>Hello $first_name</h1>
						<form action='Controller/Post_Controller.php' method='POST'>
							<input type='hidden' id='postID' name='postID' value='editProfile'>
									<div class='col-sm-6'>
									  <label for='first_name' class='form-label'>Edit First name</label>
									  <input type='text' class='form-control' id='first_name' name='first_name' value='$first_name '>
									</div>

									<div class='col-sm-6'>
									  <label for='last_name' class='form-label'>Edit Last name</label>
									  <input type='text' class='form-control' id='last_name' name='last_name' value='$last_name'>
							  </div>
								
								<label for='phone'>Edit phone number:<br></label>
								<input type='text' class='form-control' id='phone' name='phone' value='$phone'>
								
								<label for='floatingPassword'>Edit password:</label>
								<input type='password' class='form-control' id='password' name='password' value='$password'>
								
								<label for='floatingPassword'>Confirm password:</label>
								<input type='password' class='form-control' id='password_confirmation' name='password_confirmation' value='$password'>
								<br>

							<label for='promo'>Sign up for promotion?</label>
										<select class='form-control' id='promo', name='promo'>
											<option>Yes</option>
											<option>No</option>
										</select>
							<br>
							<h2>Edit Billing Address</h2>

							<div class='my-3'>

							  <div class='row gy-3'>

								<div class='col-md-6'>
								  <label for='address' class='form-label'>Address Line:</label>
								  <input type='text' class='form-control' id='address' name='address' value='$address'>
								</div>

								<div class='col-md-6'>
								  <label for='city' class='form-label'>City:</label>
								  <input type='text' class='form-control' id='city' name='city' value='$city'>
								</div>

								<div class='col-md-6'>
								  <label for='state' class='form-label'>State:</label>
								  <input type='text' class='form-control' id='state' name='state' value='$state'>
								</div>

								<div class='col-md-3'>
								  <label for='zip' class='form-label'>Zip Code:</label>
								  <input type='text' class='form-control' id='zip' name='zip' value='$zip'>
								</div>

							  </div>
						</div>

								<h2>Save Payment Information</h2>

								<div class='my-3'>

								  <div class='row gy-3'>";
								  	$counter = 0;
									$paymentCards = $this->model->getPaymentCards($userID);
									foreach($paymentCards as $paymentCard) { 
										$counter++;
										$idPaymentCard = $paymentCard['idPaymentCard']; // use this to update the database
										$cardNum = $paymentCard['cardNum'];
										$expireDate = $paymentCard['experationDate'];
									  

			$html = $html . 		  "<div class='col-md-6'>
										<label for='cc_number' class='form-label'>Credit card number</label>
										<input type='text' class='form-control' id='cc_number' name='cc_number' value='$cardNum'>
									  </div>

									  <div class='col-md-3'>
										<label for='cc_expiration' class='form-label'>Expiration</label>
										<input type='text' class='form-control' id='cc_expiration' name='cc_expiration' value='$expireDate'>
									  </div>";

									}
			$html = $html . 		"</div>";

									if($counter != 3) { 
										// if the textboxes are not null then create a new row in the table for credit cards
			$html = $html .				"<div class='row gy-3'>

											<div class='col-md-6'>
												<label for='cc_number' class='form-label'>Credit card number</label>
												<input type='text' class='form-control' id='cc_number' name='cc_number' >
											</div>

											<div class='col-md-3'>
												<label for='cc_expiration' class='form-label'>Expiration</label>
												<input type='text' class='form-control' id='cc_expiration' name='cc_expiration' >
											</div>

										</div>";
								  	}
			$html = $html .		"</div>";
								
			$html = $html . "<button class='w-100 btn btn-lg btn-primary' type='submit'>Confirm</button>
								</form>
							</div>
						</div>";
			return $html;
		} // getEditProfile

		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// HomePage View
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		public function getMovies() {
			$num_movies = $this->model->getNumMovies();
			$result = $this->model->getMovies();

			$html = "
			<div class='container'>
			<div class='row'>
			";

			for ($i = 0; $i < $num_movies; $i++) {
				$movie = $result->fetch_assoc();
				$disabled = '0';

				$html = $html . "<div class='col-sm-4' name='movieCardCol'>";
				$html = $html . "<movie-card imgSrc='{$movie['trailerPicture']}' title='{$movie['title']}' rating='{$movie['filmRating']}' id='{$movie['idMovie']}' genre='{$movie['categoryID']}' playing='{$movie['isCurrentlyPlaying']}' disabled='{$disabled}' />";
				$html = $html . "</div>";
			}

			$html = $html . "</div>";
			$html = $html . "</div>";

			return $html;

		}

		public function getTrailer($url) {
			$html = "    <div class='trailer'>
			<iframe width='840' height='472.5' src='";
			$html = $html . $url;
			
			$html = $html . "' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>
			</div>";
			return $html;
		}

		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// Movie Info Views
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

		public function getMovieInfo($id) {
			// get movie categories
			$categories = $this->model->getMovieCategories();
			$genere = array_column($categories, "category", "idCategory");

			// get showtimes
			$showTimes = $this->model->getShowTimes();
			$showTimeArr = array_column($showTimes, "showtime", "idShowtime");

			// get movie info 
			$movie = $this->model->getMovie($id);

			// get shows for movie
			$shows = $this->model->getShowsOfMovie($id);

			// create HTML
			$html = "<div class='row'>
						<div class='col-md-1'>
							<!Buffer spacing using bootstrap format>
						</div>
						<div class='col-md-12'>
							<iframe width='840' height='472.5' src='{$movie['trailerVideo']}' title='YouTube video player'
								frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture'
								allowfullscreen>
							</iframe>
						</div>
							
					</div>
				
					<div class='container form-control form-block'>
						<div class='row'>
							<div class='center text-center'>
								<p style='font-size:45px;'> {$movie['title']} </p>
							</div><br>
				
							<div class='col-md-1'></div>
							<div class='col-md-10'>
								<h5>Description:</h5> 
								<p> {$movie['synopsis']} </p>
							</div>
							<div class='col-md-1'></div>
				
							<div class='col-md-1'></div>
							<div class='col-md-2'>
								<h5>Movie Genre:</h5>
							</div>
							<div class='col-md-9'>
								<p> {$genere[$movie['categoryID']]} </p>
							</div>
				
							<div class='col-md-1'></div>
							<div class='col-md-2'>
								<h5>Director:</h5>
							</div>
							<div class='col-md-9'>
								<p> {$movie['director']} </p>
							</div>
				
							<div class='col-md-1'></div>
							<div class='col-md-2'>
								<h5>Movie Cast:</h5>
							</div>
							<div class='col-md-9'>
								<p> {$movie['cast']} </p>
							</div>
				
							<div class='col-md-1'></div>
							<div class='col-md-2'>
								<h5>Movie Status: </h5>
							</div>
							<div class='col-md-9'>";
							if($movie['isCurrentlyPlaying']) {
								$html = $html . "<p> Currently Playing </p>";
							} else { 
								$html = $html . "<p> Upcoming </p>";
							}
							$html = $html . "</div>
				
							<div class='col-md-1'></div>
							<div class='col-md-2'>
								<h5>Showtimes:</h5>
							</div>
				
							<div class='col-md-4'>
								<select class='form-control' id='showtime', name='showtime'>";
									foreach($shows as $show) { 
										$html = $html . "<option> {$show['date']} &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
											{$showTimeArr[$show['showtimeID']]} </option>";
									}
								$html = $html . "</select>
							</div>
							<div class='col-md-2'></div>
							<div class='col-md-2'>
								<a href='booking.php?movieID=$id' class='btn btn-primary'>Buy Tickets</a>
							</div>
								<br><br><br>
						</div>
				
					</div>";

			return $html;
		}


		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		// Other
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*
        public function getLogin() {
            $login = "<div class='centerBlock form-control'>
								<main class='form-signin w-100 m-auto'>
								  <form method='post'>
									<h1 class='h3 mb-3 fw-normal'>Login</h1>

							  <?php if ($is_invalid): ?>
							  <em>Invalid Login</em>
							  <?php endif; ?>

									<div class='form-floating'>
									  <input type='email' class='form-control' id='email' name='email'>
									  <label for='floatingInput'>Email address</label>
									</div>
									<div class='form-floating'>
									  <input type='password' class='form-control' id='password' name='password'>
									  <label for='floatingPassword'>Password</label>
									</div>
									
									<input type='checkbox' onclick='myFunction()'>Show Password
									
									<button class='w-100 btn btn-lg btn-primary' name='signIn'>Sign in</button>

								<button class='w-100 btn btn-lg btn-primary' name='resetPassword' style='margin-top: 5px'>Forgot Password</button>

								  </form>
								</main>
							</div>";
							
            return $login;
        } // getLogin
		
		*/
		
		public function getCheckoutConfirmation() {
			$confirm = "<div class='container'>
							<h4 class='d-flex justify-content-between align-items-center mb-3'>
								  <span class='text-primary' style='color:white;'>Your Order</span>
								  <span class='badge bg-primary rounded-pill'>0</span>
								</h4>
								<ul class='list-group mb-3'>
								  <li class='list-group-item d-flex justify-content-between lh-sm'>
									<div>
									  <h6 class='my-0'>Ticket: Senior</h6>
									  <small class='text-muted'>x0</small>
									</div>
									<span class='text-muted'>$8</span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between lh-sm'>
									<div>
									  <h6 class='my-0'>Ticket: Adult</h6>
									  <small class='text-muted'>x0</small>
									</div>
									<span class='text-muted'>$12</span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between lh-sm'>
									<div>
									  <h6 class='my-0'>Ticket: Child</h6>
									  <small class='text-muted'>x0</small>
									</div>
									<span class='text-muted'>$5</span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between bg-light'>
									<div class='text-success'>
									  <h6 class='my-0'>Promo code</h6>
									  <small>EXAMPLECODE</small>
									</div>
									<span class='text-success'>−$5</span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between'>
									<span>Total (USD)</span>
									<strong>-$5</strong>
								  </li>
								</ul>
							<form action='checkoutSuccess.html' method='POST'>
								<button class='w-100 btn btn-lg btn-primary' type='submit'>Confirm</button>
							</form>
						</div>";
			return $confirm;
		} // getCheckoutConfirmation


		public function getResetPassword() {
			$resetpassword = "<div class='centerBlock form-control'>
						<main class='form-signin w-100 m-auto'>
						<h1 style='color:white;font-size:20px;'>Fill in the following field(s) to get a link to reset your password</h1>
	
						<form action='/B8-Cinema-E-Booking/MVC_Pages/Controller/Post_Controller.php' method='POST'>
							<input type='hidden' id='postID' name='postID' value='sendResetPassword'>

						<div class='form-floating'>
	
	 					 <input type='text' class='form-control' id='email' name='email'><br>
       					 <label for='email'>Current Email:  </label>  
						</div>

     						 <button type='submit' class='-100 btn btn-lg btn-primary'>Send Password Reset Link</button>

						</form>

					</div>";
			return $resetpassword;
		} // getResetPassword

		public function getVerifyPassword() {
			$verifypassword = "<div class='centerBlock form-control'>
							<main class='form-signin w-100 m-auto'>
 								<form method='POST'>

				   			 		<h1 class='h3 mb-3 fw-normal'>Change Password</h1>
      	       		 				<label for='password' style='color: black'>New Password: </label>
            				 			<input type='text' value='' name='password'><br><br>
            			 				<button  class='w-100 btn btn-lg btn-primary' type='submit' name='submit'>Submit</button>
        							</form>
							</main>
	    					</div>";

			return $verifypassword;
		} // getVerifyPassword


    } // View


?>