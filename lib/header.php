<?php session_start(); 
    // This functions determine the directory of the file in which this module is running
    //and make sure the links are in relation to the file
    function path ($url){
        $dir = dirname($_SERVER['PHP_SELF']);
        echo $dir . $url;    
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to ZURI</title>
    <link rel="stylesheet" href=<?php path("../css/bootstrap.min.css"); ?>>
    <link rel="stylesheet" href=<?php path("../css/styles.css"); ?>>
</head>
<body>
    <div class="container">