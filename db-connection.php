<?php
    function openCon(){
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "zuri-php-task4";

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

        if($conn->error){
            echo "working";
            die("Connect failed: %s\n".$conn->error);
        }

        return $conn;
    };

    function closeCon($conn){
        $conn->close();
    }

    function resultsToArray($result){
        $rows = array();
        while($row = $result->fetch_assoc()){

        }
        return $rows;
    }
?>