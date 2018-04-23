<?php

//JDATE

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

$sql = file_get_contents('sql/getAllPlanets.sql');
$statement = $database->prepare($sql);
$statement->execute();
$planets = $statement->fetchAll(PDO::FETCH_ASSOC);
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
    
    <style>
    
        iframe {
            margin: 0;
            padding: 0;
            border: none;
            
        }
        
        iframe:focus {
            outline: none;
        }

        iframe[seamless] {
            display: block;
        }
        
    </style>

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
    
    
		<div class="page">
            <h1>Planets: </h1>


            <?php foreach($planets as $planet) : ?>
                <h2><?php echo $planet['PID'] ?> - <?php echo $planet['planetName'] ?></h2>
                <iframe style="max-width: 25%;" scrolling="no" src="./images/PID<?php echo $planet['PID'] ?>.png"> </iframe>
                <p><a href="planetProfile.php?PID=<?php echo $planet['PID'] ?>">View <?php echo $planet['planetName'] ?></a></p>
            <?php endforeach; ?>

        </div>
    
        
</body>
</html>