<?php

    $DB_SERVER='localhost';
    $DB_DATABASE='movilmad';
    $DB_USERNAME='root';
    $DB_PASSWORD='rootroot';
    try {
        $conn = new PDO("mysql:host=$DB_SERVER;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);	 	 	 	 	 	
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	
    } catch (PDOException $ex) {
        echo $ex->getMessage(); 	 	 	 	 	 	
    }
?>