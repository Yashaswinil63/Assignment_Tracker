<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<!<!-- here we create functions that interact with assignment tables -->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php 

    function get_assignments_by_category($category_id) {
        global $db; //global variable to reference database connections
        if ($category_id) { //if the category_id is not null
            //this is going to display all the assignments respective of the category by joining those two tables
            $query = 'SELECT A.id, A.description, C.category_name FROM assignments A LEFT JOIN categories C ON A.category_id = C.category_id WHERE A.category_id = :category_id ORDER BY id';
        } else {
            //this is going to display all the assignments irrespective of the category by joining those two tables
            $query = 'SELECT A.id, A.description, C.category_name FROM assignments A LEFT JOIN categories C ON A.category_id = C.category_id ORDER BY C.category_id';
        }
        $statement = $db->prepare($query); //database connection
        if ($category_id) {
            $statement->bindValue(':category_id', $category_id);
        }
        $statement->execute();
        $assignments = $statement->fetchAll();
        $statement->closeCursor();
        return $assignments; //at the end our functions all the assignments that is prepared 
        //with the query.
    }

    function delete_assignment($assignment_id) {
        global $db;
        $query = 'DELETE FROM assignments WHERE id = :assign_id';
        // : specify that it is a name parameter.
        //When the query is executed, the value of ":assign_id" will be 
        ////substituted with the actual value provided by the application or user.
        $statement = $db->prepare($query);
        //A prepared statement is a feature of PDO that allows you to 
        ////execute a query with parameters that are supplied at execution time.
        $statement->bindValue(':assign_id', $assignment_id);
        $statement->execute();
        $statement->closeCursor(); //to free up resources holding at that instance
    }

    function add_assignment($category_id, $description) {
        global $db;
        $query = 'INSERT INTO assignments (Description, category_id)
              VALUES
                 (:descr, :category_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':descr', $description);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    }
    /*
     function update_assignment($assignment_id, $category_id, $description) {
    global $db;
    $query = 'UPDATE assignments SET category_id = :category_id, description = :description WHERE id = :assign_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':assign_id', $assignment_id);
    $statement->execute();
    $statement->closeCursor();
    }

*/
