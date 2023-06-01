<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="../css/customer_login_style.css">
	   <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <script  src="https://code.jquery.com/jquery-3.1.1.min.js"  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="  crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" ></script>
	
</head>

<body>
   <header>
    <?php
    include ('header-employee.php');
   ?>
   </header>

<div class="customer-login-body">
		<div class="veen">
			<div class="login-btn splits">
				<p>Already an user?</p>
				<button class="active">Login</button>
			</div>
			<div class="rgstr-btn splits">
				<p>Don't have an account?</p>
				<button>Register</button>
			</div>
			<div class="wrapper">
				<form id="login" tabindex="500" method="POST">
					<h3>Login</h3>
					<div class="mail">
						<input type="mail" name="username-login">
						<label>Username</label>
					</div>
					<div class="passwd">
						<input type="password" name="password-login">
						<label>Password</label>
					</div>
					<div class="submit">
						<input type="submit" class="darkS" name="login">
					</div>
				</form>
				<form id="register" method="POST">
					<h3>Register</h3>
					<div class="first_name">
						<input type="text" name="fname">
						<label>First Name</label>
					</div>
					<div class="last_name">
						<input type="text" name="lname">
						<label>Last Name</label>
					</div>
					<div class="middle_name">
						<input type="text" name="mname">
						<label>Middle Name</label>
					</div>
					<div class="contact">
						<input type="text" name="contact">
						<label>Contact</label>
					</div>
					
					<div class="contact">
						<input type="DATE" name="bday" required>
						<label>Birthdate</label>
					</div>
					<div class="uid">
						<input type="text" name="username">
						<label>Username</label>
					</div>
					<div class="passwd">
						<input type="password" name="password">
						<label>Password</label>
					</div>
					<div class="submit">
						<input type="submit" name="register" value="Register" class="dark">
					</div>
				</form>
			</div>
		</div>	
	</div>

	<style type="text/css">
		.site-link{
      padding: 5px 15px;
			position: fixed;
			z-index: 99999;
			background: #fff;
			box-shadow: 0 0 4px rgba(0,0,0,.14), 0 4px 8px rgba(0,0,0,.28);
			right: 30px;
			bottom: 30px;
			border-radius: 10px;
		}
		.site-link img{
			width: 30px;
			height: 30px;
		}
	</style>

<script src="../js/customer_login_script.js"></script>

</body>
<?php
if (isset($_POST['register'])){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mname = $_POST['mname'];
	$contact = $_POST['contact'];
	$bday = $_POST['bday'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	//echo all varaiable
	
	//check if username is in my database
	$query = "SELECT * FROM customer_accounts_view WHERE Username = '$username'";
	$sql = mysqli_query($conn, $query);
	$row = mysqli_num_rows($sql);
		//get the userID
	if($row == 0){
		//stored procedure
		$insert = "CALL customer_register('$fname','$lname','$mname','$contact','$bday')";
		$sql = mysqli_query($conn, $insert);
		$state = "SELECT CusID FROM customer_view WHERE FirstName = '$fname' AND LastName = '$lname' AND MiddleName = '$mname'";

		$sql2 = mysqli_query($conn, $state);
		$result2 = mysqli_fetch_assoc($sql2);
	
		$id = $result2['CusID'];
		$sql = mysqli_query($conn, "CALL customer_account_register('$id','$username','$password')");
		if($sql){
			echo '<script>alert("Registered Successfully")</script>';
			//logs
			$logs = mysqli_query($conn, "INSERT INTO cuslogs_view(CusID, Timestamp, Action) VALUES ('$id', NOW(), 'Registered')");
		}
		else{
			echo '<script>alert("Failed to Register")</script>';
		}
	}
	else{
		echo '<script>alert("Username already Taken")</script>';
	}
	}
	else if(isset($_POST['login'])){
		$username = $_POST['username-login'];
		$password = $_POST['password-login'];
		
		// Prepare the statement
		$stmt = $conn->prepare("CALL customer_login(?, ?, @p_user_id, @p_login_success)");
		$stmt->bind_param("ss", $username, $password);
		
		// Execute the statement
		$stmt->execute();
		
		// Retrieve the output parameters
		$stmt->close();
		
		// Fetch the output parameter values
		$result = $conn->query("SELECT @p_username as username, @p_user_id AS user_id, @p_login_success AS login_success");
		$row = $result->fetch_assoc();
		$user_id = $row['user_id'];
		$login_success = $row['login_success'];
		$result->free();
		
		if ($login_success == 1) {
			$_SESSION['CusID'] = $user_id;
			$_SESSION['username'] = $username;
			//logs
			$logs = mysqli_query($conn, "INSERT INTO cuslogs_view(CusID, Timestamp, Action) VALUES ('$user_id', NOW(), 'Logged in')");
			//header("Location: ../index.php");
			echo '<script>alert("Login Successful")</script>';
			echo '<script>window.location.href="../index.php";</script>';
			
		} else {
			echo '<script>alert("Invalid Username or Password")</script>';
		}
		
	}
	



?>
</html>
