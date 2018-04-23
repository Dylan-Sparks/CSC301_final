<?php

//JDATE

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');


$sql = file_get_contents('sql/getAllJedi.sql');
$statement = $database->prepare($sql);
$statement->execute();
$jedis = $statement->fetchAll(PDO::FETCH_ASSOC);
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

	<link rel="stylesheet" href="./css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
    
	<div class="page">
		<h1>Jedi on JDate: </h1>
		
        
        <?php foreach($jedis as $eachJedi) : ?>
        <h2><?php echo $eachJedi['JID'] ?> - <?php echo $eachJedi['jediName'] ?></h2>
        <p><a href="jediProfile.php?JID=<?php echo $eachJedi['JID'] ?>">View <?php echo $eachJedi['jediName'] ?>'s Profile</a></p>
        <?php endforeach; ?>
		
	</div>
    
    
    
    
    <footer>Currently accessed by: <?php echo $jedi['jediName']?>&nbsp;|&nbsp;<a href="./logout.php">Logout</a></footer>
    
    
</body>
</html>