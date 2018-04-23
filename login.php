<?php

//JDATE

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');


// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get username and password from the form as variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// Query records that have usernames and passwords that match those in the customers table
	$sql = file_get_contents('sql/attemptLogin.sql');
	$params = array(
		'username' => $username,
		'password' => $password
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);

	// If $users is not empty
	if(!empty($users)) {
		// Set $user equal to the first result of $users
		$user = $users[0];
		
		// Set a session variable with a key of customerID equal to the customerID returned
		$_SESSION['JID'] = $user['JID'];
		
		// Redirect to the index.php file
		header('location: index.php');
	}
}



?>

<?php include('./navbar.php');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Login</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/login_style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
    
	<div class="page">
		<h1>Login</h1>
        <div class="login">
            <form class="login" method="POST">
                <input class="" type="text" name="username" placeholder="Username" />
                <input type="password" name="password" placeholder="Password" />
                <input class="button" type="submit" value="Log In" />
            </form>
        </div>
        
	</div>
    
    <div id="createuser">
        <a href=./newJedi.php?action=add>New Force User?</a>
    </div>
    
    
    <div id='stars'></div>
    <div id='stars2'></div>
    <div id='stars3'></div>
    
</body>
</html>