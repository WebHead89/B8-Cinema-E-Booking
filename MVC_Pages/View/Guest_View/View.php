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

													<li><a class='dropdown-item' href='login.php'>Login</a></li>
													<li><a class='dropdown-item' href='signup.php'>Register</a></li>
												
												
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

	  public function getSignUp() {
		$signup = "	<form action='process-signup.php' method='POST'>
				<div class='centerBlock form-control'>
					<main class='form-signin w-100 m-auto'>

						<h1 class='h3 mb-3 fw-normal'>Sign Up</h1>

						<div class='form-floating'>
							<input type='text' class='form-control' id='first_name', name='first_name'>
							<label for='first_name'>First Name</label>
						</div>

						<div class='form-floating'>
							<input type='text' class='form-control' id='last_name', name='last_name'>
							<label for='last_name'>Last Name</label>
						</div>

						<div class='form-floating'>
							<input type='text' class='form-control' id='phone', name='phone'>
							<label for='floatingInput'>Phone Number</label>
						</div>
		
						<div class='form-floating'>
							<input type='email' class='form-control' id='email', name='email'>
							<label for='floatingInput'>Email</label>
						</div>

	
						<div class='form-floating'>
							<input type='password' class='form-control' id='password', name='password'>
							<label for='floatingPassword'>Password</label>
						</div>

						<input type='checkbox' onclick='myFunction()'>Show Password


						<div class='form-floating'>
							<input type='password' class='form-control' id='password_confirmation', name='password_confirmation'>
							<label for='floatingPassword'>Confirm Password</label>
						</div>

						<label for='promo'>Sign up for promotion?</label>
						<select class='form-control' id='promo', name='promo'>
							<option>Yes</option>
							<option>No</option>
						</select>
						<br>
						<button class='w-100 btn btn-lg btn-primary'>Sign up</button>

					</main>
				</div>
				</form>";
		return $signup;
	  } //getSignUp

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