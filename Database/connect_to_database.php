<?php

    /**
     * use .env files or sorts in the real world boys and girls!
     * never place passwords or other sensitive data in code
     * all code goes in git so use .env files and add it to .gitignore
     */ 
    $servername = "localhost";
    $databasename = "muddy";
    $username = "root";
    $password = "root"; 
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
      
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "\033[32mdone!\033[0m\n";
    } catch(PDOException $e) {
      echo "\033[31mConnection failed: " . $e->getMessage() . "\033[0m\n";
      echo "\tgame will shut down, have a nice day!\n";
      exit();
    }

?>