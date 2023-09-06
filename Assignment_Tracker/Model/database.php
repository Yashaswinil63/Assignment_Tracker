<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!--<!-- This file is going to establish the connection between the database -->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
        $dsn = 'mysql:host=localhost;dbname=assignment_tracker';
        $username = 'root';
        $password = '';

        try {
        $db = new PDO($dsn, $username); //PDO : PHP data object
       //successful connection
        } catch (PDOException $e) {
        $error = "Database Error: ";
        $error .= $e->getMessage();
        include('view/error.php');
        exit();
        }
        ?>
        
    </body>
</html>
