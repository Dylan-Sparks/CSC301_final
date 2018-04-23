<?php

//JDATE

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

$JID = $_GET['JID'];

// Get a list of categories from the database matching categoryid from the URL
$sql = file_get_contents('sql/getJedi.sql');
$params = array(
	'JID' => $JID
);
$statement = $database->prepare($sql);
$statement->execute($params);
$jedis = $statement->fetchAll(PDO::FETCH_ASSOC);

// 9. After querying all categories, get the first category into a $category variable
$thisJedi = $jedis[0];



?>

<?php include('./navbar.php');
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
    
    <div class="pageLeft">
    
        <h1>Name: <?php echo $jedi['prefix'] ?> <?php echo $jedi['jediName'] ?></h1>
        
        <h1>Birthdate: <?php echo $jedi['birthdate'] ?></h1>
        
        <h1>Bio: </h1>
            <p><?php echo $jedi['bio']?></p>
        
    </div>
    
    <div class="pageRight">
    
        <h1>Name: <?php echo $thisJedi['prefix'] ?> <?php echo $thisJedi['jediName'] ?></h1>
        
        <h1>Birthdate: <?php echo $thisJedi['birthdate'] ?></h1>
        
        <h1>Bio: </h1>
            <p><?php echo $thisJedi['bio']?></p>
        
    </div>
    
    
		
    
    
        <footer>Currently accessed by: <?php echo $jedi['jediName']?>&nbsp;|&nbsp;<a href="./logout.php">Logout</a></footer>
</body>
</html>