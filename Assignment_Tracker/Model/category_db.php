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
        <?php 

    function get_categories() {
        global $db;
        $query = 'SELECT * FROM categories ORDER BY category_id';
        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();
        return $categories;
    }

    function get_category_name($category_id) { //based on category
        if (!$category_id) { //if category_id is null
            return "All Courses";
        }
        global $db;
        $query = 'SELECT * FROM categories WHERE category_id = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $category = $statement->fetch(); //one record if category id is given
        $statement->closeCursor();
        $category_name = $category['category_name'];
        return $category_name;//return category 
    } 

    function delete_category($category_id) {
        global $db;
        $query = 'DELETE FROM categories WHERE category_id = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_category($category_name) {
        global $db;
        $query = 'INSERT INTO categories (category_name)
              VALUES
                 (:category_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $category_name);
        $statement->execute();
        $statement->closeCursor();
    }
