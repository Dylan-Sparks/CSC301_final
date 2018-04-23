<?php

// Create and include a configuration file with the database connection
    include('config.php');

// Include functions for application
    include('functions.php');

// Get an associative array of races from database
    $sql = file_get_contents('sql/getAllRaces.sql');
    $statement = $database->prepare($sql);
    $statement->execute();
    $races = $statement->fetchAll(PDO::FETCH_ASSOC);
// Dynamically print the categories as options in the form

// Get type of form either add or edit from the URL (ex. form.php?action=add)
    $action = $_GET['action']; 

// If form submitted	
    if ($_SERVER['REQUEST_METHOD'] == 'POST' ){

	      
		// Get variables from the form submitted using $_POST

        $jediName = $_POST['jediName'];
        $prefix = $_POST['prefix'];
        $birthdate = $_POST['birthdate'];
        $bio = $_POST['bio'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // if the type of form specified in the URL is add
        if ($action == 'add') {
            
		// Insert the book into the database 
            $sql = file_get_contents('./sql/insert_new_jedi.sql');
            $params = array(
                'jediName' => $jediName,
                'prefix' => $prefix,
                'birthdate' => $birthdate,
                'bio' => $bio,
                'username' => $username,
                'password' => $password
            );
            $statement = $database->prepare($sql);
            $statement->execute($params);

		// Set the categories of the book in the database
           /* foreach($book_categories as $catid) {
                $sql = file_get_contents('sql/insert_to_book_categories.sql');
                $params = array(
                    'isbn' => $isbn,
                    'catid' => $catid
                );
                $statement = $database->prepare($sql);
                $statement->execute($params);
            }
        } */
            
        }
	// Redirect to book listing page
    header('Location: login.php');
    die();

    }
        
?>

<?php include('./navbar.php');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Welcome to Jedi Date</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
	<div class="page">
		<h1>Add New Jedi</h1>
		<form action="" method="POST">
			<div class="form-element">
				<label>Jedi Name:</label>
				<input type="text" name="jediName" class="textbox" />
			</div>
			<div class="form-element">
				<label>Prefix:</label>
				<input type="text" name="prefix" class="textbox" />
			</div>
            <div class="form-element">
				<label>Birthdate:</label>
				<input type="date" name="birthdate" class="textbox" />
			</div>
            <div class="form-element">
				<label>Bio:</label>
				<input type="text" name="bio"/>
			</div>
			<div class="form-element">
				<label>Race:</label>
                
                <?php foreach($races as $race) : ?>
                
				<input class="radio" type="checkbox" name="race[]" value="<?php echo $race['RID'] ?>" /><span class="radio-label"><?php echo $race['raceName'] ?></span><br />
                
                <?php endforeach; ?>
                
			</div>
			<div class="form-element">
				<label>Username: </label>
				<input type="text" name="username" class="textbox" />
			</div>
			<div class="form-element">
				<label>Password: </label>
				<input type="password" name="password" class="textbox" />
			</div>
			<div class="form-element">
				<input type="submit" class="button" />&nbsp;
				<input type="reset" class="button" />
			</div>
		</form>
	</div>
</body>
</html>