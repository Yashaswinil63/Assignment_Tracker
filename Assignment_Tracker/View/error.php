<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!<!-- Referencing other files that are not yet created -->
        <?php include('header.php') ?>
        <h2>Error</h2>
        <p><?php echo $error; ?></p> <!<!-- error displayed  -->
        <br>
        <p><a href=".">Back to List</a></p> <!<!-- link back to root -->
        <?php include('footer.php') ?>
        <!<!-- between header and footer -->
    </body>
</html>
