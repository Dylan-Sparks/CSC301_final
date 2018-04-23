<?php

//JDATE

// Connecting to the MySQL database
$username = 'sparksd6';
$password = 'DrA7ruDe';

$database = new PDO('mysql:host=localhost;dbname=db_spring18_sparksd6', $username, $password);

// Start the session
session_start();


$current_url = basename($_SERVER['REQUEST_URI']);

// if customerID is not set in the session and current URL not login.php redirect to login page
if(!isset($_SESSION['JID']) && $current_url !='login.php') {
    header('Location: login.php');
}

// Else if session key customerID is set get $customer from the database
elseif(isset($_SESSION['JID'])) {
    $sql = file_get_contents('sql/getJedi.sql');
    $statement = $database->prepare($sql);
    $params = array(
                'JID' => $_SESSION['JID']
            );
    $statement->execute($params);
    $jedis = $statement->fetchAll(PDO::FETCH_ASSOC);
    $jedi = $jedis[0];
}

?>