<?php

//JDATE

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

$JID = get('JID');

$action = get('action');

$sql = file_get_contents('sql/getJedi.sql');
$params = array(
	'JID' => $JID
);
$statement = $database->prepare($sql);
$statement->execute($params);
$jedis = $statement->fetchAll(PDO::FETCH_ASSOC);

// 9. After querying all categories, get the first category into a $category variable
$thisJedi = $jedis[0];

$sql = file_get_contents('sql/getAllRaces.sql');
    $statement = $database->prepare($sql);
    $statement->execute();
    $races = $statement->fetchAll(PDO::FETCH_ASSOC);
// Dynamically print the categories as options in the form
$race_check = array();

foreach($races as $race) {
		$race_array[] = $race['RID'];
	};

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
        if ($action == 'edit') {
            $sql = file_get_contents('sql/update_existing_jedi.sql');
            $params = array(
                'JID' => $jedi['JID'],
                'jediName' => $jediName,
                'prefix' => $prefix,
                'birthdate' => $birthdate,
                'bio' => $bio,
                'username' => $username,
                'password' => $password
            );
            $statement = $database->prepare($sql);
            $statement->execute($params);

		}
	}


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>JDate</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
    
    <?php include('./navbar.php');?>
    
    <div class="page">
        
        
		<h1>Edit Jedi Info</h1>
		<form action="" method="POST">
			<div class="form-element">
				<label>Jedi Name:</label>
				<input type="text" name="jediName" class="textbox" value="<?php echo $jedi['jediName'] ?>" />
			</div>
			<div class="form-element">
				<label>Prefix:</label>
				<input type="text" name="prefix" class="textbox" value="<?php echo $jedi['prefix'] ?>" />
			</div>
            <div class="form-element">
				<label>Birthdate:</label>
				<input type="date" name="birthdate" class="textbox" value="<?php echo $jedi['birthdate'] ?>" />
			</div>
            <div class="form-element">
				<label>Bio:</label>
				<input type="text" name="bio"  value="<?php echo $jedi['bio'] ?>"/>
			</div>
			<div class="form-element">
				<label>Race:</label>
                
                <?php foreach($races as $race) : ?>
                    <?php if(!in_array($race['RID'], $race_check)) : ?>
							<input class="radio" type="checkbox" name="race[]" value="<?php echo $race['RID'] ?>" /><span class="radio-label"><?php echo $race['raceName'] ?></span><br />
						<?php else : ?>
							<input checked class="radio" type="checkbox" name="race[]" value="<?php echo $race['RID'] ?>" /><span class="radio-label"><?php echo $race['raceName'] ?></span><br />
						<?php endif ?>
                
                <?php endforeach; ?>
                
			</div>
			<div class="form-element">
				<label>Username: </label>
				<input type="text" name="username" class="textbox" value="<?php echo $jedi['username'] ?>" />
			</div>
			<div class="form-element">
				<label>Password: </label>
				<input type="text" name="password" class="textbox" value="<?php echo $jedi['password'] ?>" />
			</div>
			<div class="form-element">
				<input type="submit" class="editButton" />&nbsp;
				<input type="reset" class="editButton" />
			</div>
		</form>
	</div>
    
</body>
    
</html>