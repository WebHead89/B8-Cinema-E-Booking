<?php 
    include __DIR__ . "/../../Model/Model.php";

    class View {
        private $model;

        public function __construct() {
            $this->model = new Model();
        }

        public function getNavbar() {
            $navbar = "<nav class='navbar navbar-expand-lg navbar-light bg-light'>
							<div class='container-fluid'>
								<a class='navbar-brand' href='home.php'>E-Booking Cinema</a>
								<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavDropdown'
									aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle Navigation'>
								<span class='navbar-toggler-icon'></span>
								</button>
								<div class='collapse navbar-collapse' id='navbarNavDropdown'>
									<ul class='navbar-nav me-auto order-0'>
										<li class='nav-item'>
											<a class='nav-link active' href='home.php' aria-current='page'>Home</a>
										</li>
										<li>
											<a class='nav-link active' href='checkout.php' aria-current='page'>View Cart</a>
										</li>
									</ul>
									<div class='mx-auto'>
										<form class='d-flex'>
											<input class='form-control me-2' type='search' placeholder='Search Movies'
												aria-label='Search'>
											<button class='btn btn-outline-success' type='submit'>Search</button>
										</form>
									</div>
									<div class='d-flex ms-auto order-5'>
										<div class='nav-item dropdown justify-content-end'>
											<a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button'
												data-bs-toggle='dropdown' aria-expanded='false'>
												Account
											</a>
											<ul class='dropdown-menu dropdown-menu-end' aria-labelledby='navbarDropdownMenuLink'>
											<?php
												if (isset($_SESSION['user_id'])) {
													echo '<li><a class='dropdown-item' href='editprofile.php'>Edit Profile</a></li>';
													echo '<li><a class='dropdown-item' href='logout.php'>Logout</a></li>';
												} else {
													echo '<li><a class='dropdown-item' href='login.php'>Login</a></li>';
													echo '<li><a class='dropdown-item' href='signup.html'>Register</a></li>';
												}
												?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</nav>";
            return $navbar;
        } // getNavbar

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
		
		public function getEditProfile() {
			$editProf = "<div class='container form-control form-block'>
							<div class='center'>
							<h1>Hello <?php echo $first_name ?></h1>
								<form action='process-profile.php' method='POST'>
								
									<div class='col-sm-6'>
									  <label for='first_name' class='form-label'>Edit First name</label>
									  <input type='text' class='form-control' id='first_name' name='first_name' value='<?php echo $first_name ?>'>
									</div>

									<div class='col-sm-6'>
									  <label for='last_name' class='form-label'>Edit Last name</label>
									  <input type='text' class='form-control' id='last_name' name='last_name' value='<?php echo $last_name ?>'>
							  </div>
								
								<label for='phone'>Edit phone number:<br></label>
								<input type='text' class='form-control' id='phone' name='phone' value='<?php echo $phone ?>'>
								
								<label for='floatingPassword'>Edit password:</label>
								<input type='password' class='form-control' id='password' name='password' value='<?php echo $password ?>'>
								
								<label for='floatingPassword'>Confirm password:</label>
								<input type='password' class='form-control' id='password_confirmation' name='password_confirmation' value='<?php echo $password ?>'>
								<br>

							<label for='promo'>Sign up for promotion?</label>
										<select class='form-control' id='promo', name='promo'>
											<option>Yes</option>
											<option>No</option>
										</select>
								
							<h2>Edit Billing Address</h2>

							<div class='my-3'>

							  <div class='row gy-3'>

								<div class='col-md-6'>
								  <label for='address' class='form-label'>Address Line:</label>
								  <input type='text' class='form-control' id='address' name='address' value='<?php echo $address ?>'>
								</div>

								<div class='col-md-6'>
								  <label for='city' class='form-label'>City:</label>
								  <input type='text' class='form-control' id='city' name='city' value='<?php echo $city ?>'>
								</div>

								<div class='col-md-6'>
								  <label for='state' class='form-label'>State:</label>
								  <input type='text' class='form-control' id='state' name='state' value='<?php echo $state ?>'>
								</div>

								<div class='col-md-3'>
								  <label for='zip' class='form-label'>Zip Code:</label>
								  <input type='text' class='form-control' id='zip' name='zip' value='<?php echo $zip ?>'>
								</div>

							  </div>



						</div>


								
								<h2>Save Payment Information</h2>

								<div class='my-3'>

								  <div class='row gy-3'>
									<?php while($row = $result->fetch_assoc()) { ?>
									  <?php
										$counter++;
										$idPaymentCard = $row['idPaymentCard']; // use this to update the database
										$cardNum = $row['cardNum'];
										$expireDate = $row['experationDate'];
									  ?>

									  <div class='col-md-6'>
										<label for='cc_number' class='form-label'>Credit card number</label>
										<input type='text' class='form-control' id='cc_number' name='cc_number' value='<?php echo $cardNum ?>'>
									  </div>

									  <div class='col-md-3'>
										<label for='cc_expiration' class='form-label'>Expiration</label>
										<input type='text' class='form-control' id='cc_expiration' name='cc_expiration' value='<?php echo $expireDate ?>'>
									  </div>

									<?php } ?>
								  </div>

								  <?php if($counter != 3) { ?>
									<?php // if the textboxes are not null then create a new row in the table for credit cards ?>
									<div class='row gy-3'>

									  <div class='col-md-6'>
										<label for='cc_number' class='form-label'>Credit card number</label>
										<input type='text' class='form-control' id='cc_number' name='cc_number' >
									  </div>

									  <div class='col-md-3'>
										<label for='cc_expiration' class='form-label'>Expiration</label>
										<input type='text' class='form-control' id='cc_expiration' name='cc_expiration' >
									  </div>

									</div>
								  
								  <?php } ?>
							</div>
								
								<button class='w-100 btn btn-lg btn-primary' type='submit'>Confirm</button>

								</form>
								
							
							
							
							</div>
						</div>"
			return editProf;
		} // getEditProfile
		
		public function getCheckout() {
			$checkout = "<div class='container form-block'>
						  <main>
							<div class='py-5 text-center'>
							  <h2>Checkout</h2>
							</div>

							<div class='row g-5'>
							  <div class='col-md-5 col-lg-4 order-md-last'>
								<h4 class='d-flex justify-content-between align-items-center mb-3'>
								  <span class='text-primary'>Your cart</span>
								  <span class='badge bg-primary rounded-pill'> <?php echo count($bookingInfo->selectedSeatsArray); ?> </span>
								</h4>
								
								<ul class='list-group mb-3'>
								  <li class='list-group-item d-flex justify-content-between lh-sm'>
									<div>
									  <h6 class='my-0'>Ticket: Senior</h6>
									  <small class='text-muted'> <?php echo 'x' . $bookingInfo->seniorTickets; ?>  </small>
									</div>
									<span class='text-muted'> <?php echo '$' . $bookingInfo->seniorTickets * $ticketPrices['SENIOR']; ?> </span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between lh-sm'>
									<div>
									  <h6 class='my-0'>Ticket: Adult</h6>
									  <small class='text-muted'> <?php echo 'x' . $bookingInfo->adultTickets; ?> </small>
									</div>
									<span class='text-muted'> <?php echo '$' . $bookingInfo->adultTickets * $ticketPrices['ADULT']; ?> </span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between lh-sm'>
									<div>
									  <h6 class='my-0'>Ticket: Child</h6>
									  <small class='text-muted'> <?php echo 'x' . $bookingInfo->childTickets; ?> </small>
									</div>
									<span class='text-muted'> <?php echo '$' . $bookingInfo->childTickets * $ticketPrices['CHILD']; ?> </span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between bg-light'>
									<div class='text-success'>
									  <h6 class='my-0'>Promo code</h6>
									  <small> <?php echo $bookingInfo->promoCode; ?> </small>
									</div>
									<span class='text-success'> <?php echo '-$' . $bookingInfo->promoDiscount * $totalPrice; ?> </span>
								  </li>
								  <li class='list-group-item d-flex justify-content-between'>
									<span>Total (USD)</span>
									<strong> <?php echo '$' . $totalPrice - ($bookingInfo->promoDiscount * $totalPrice);?> </strong>
								  </li>
								</ul>

								<form class='card p-2' method='POST'>
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
								  <hr class='my-4'>

								  <?php foreach($paymentCards as $paymentCard) { ?>
									<form method='POST'>
									  <input type='hidden' id='postID' name='postID' value='submitPayment'>
									  <input type='hidden' id='cardID' name='cardID' value='<?php echo $paymentCard['idPaymentCard'];?>'>
									  <div class='row gy-3'>
										<div class='col-md-6'>
										  <label class='form-label'>Card Number:</label>
										  <label class='form-label'> <?php echo $paymentCard['cardNum']; ?> </label>
										</div>

										<div class='col-md-6'>
										  <label for='cc-number' class='form-label'>Expiration:</label>
										  <label class='form-label'> <?php echo $paymentCard['experationDate']; ?> </label>
										</div>
									  </div>
									  <br>
									  <button class='w-20 btn btn-primary btn-lg' type='submit'>Checkout</button>
									</form>
									<hr class='my-4'>
								  <?php } ?>

								<h4 class='mb-3'>One Time Payment</h4>
								<form method='POST'>
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
							  </div>
							</div>
						  </main>

						</div>"
			
			return checkout;
		} // getCheckout
		
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
						</div>"
			return confirm;
		} // getCheckoutConfirmation





    } // View


?>