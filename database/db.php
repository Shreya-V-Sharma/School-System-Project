<?php
    function OpenCon() {
        //connect to the database(dal one) with the CSID 
        $host = 'db.cs.dal.ca';
        $username = "sharma4";
        $password = "pyPPZDZdLjCfifTDZFpvQ3Sxw";
        $dbname = "sharma4";

        // $host = 'localhost';
        // $username = "root";
        // $password = "root";
        // $dbname = "sharma4";

        //try to connect
        try
        {
            $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        //if error occurs print echo the error message
        catch(PDOException $e)
        {
            echo("connection failed: " . $e->getMessage());
        }
        return $conn;
    } 
?>