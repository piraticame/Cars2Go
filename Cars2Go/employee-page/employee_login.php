
<head>
	<link rel="stylesheet" href="../css/employee_login_style.css">
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
			
			
			<div class="wrapper">
				<form id="login" method="POST">
					<h3>Login</h3>
					<div class="mail">
						<input type="mail" name="username">
						<label>Username</label>
					</div>
					<div class="passwd">
						<input type="password" name="password">
						<label>Password</label>
					</div>
					<div class="submit">
						<input type="submit" name="login" value="LOGIN">
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



</body>
<?php
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// Prepare the statement
	$stmt = $conn->prepare("CALL employee_login(?, ?, @p_user_id, @p_login_success)");
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
		$logs = mysqli_query($conn, "INSERT INTO emplogs_view(EmpID, Timestamp, Action) VALUES ('$user_id', NOW(), 'Logged in')");
		//header("Location: ../index.php");
		echo '<script>alert("Login Successful")</script>';
		$sql = mysqli_query($conn, "SELECT role,status from employee_view where EmpID= $user_id");
		$result = mysqli_fetch_assoc($sql);
		$role = $result['role'];
		$status = $result['status'];
		if($role == "admin"){
			echo '<script>window.location.href="../employee-page/admin-page.php";</script>';
		}
		else if($role == "employee"){
			echo '<script>window.location.href="../header.php";</script>';
		}
		
		
	} else {
		echo '<script>alert("Invalid Username or Password")</script>';
	}
	
}


?>
</html>
