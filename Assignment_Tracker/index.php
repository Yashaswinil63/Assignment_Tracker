<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
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
    require('Model/database.php');
    require('model/assignments_db.php');
    require('model/category_db.php');

    $assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $category_name = filter_input(INPUT_POST, 'category_name', FILTER_SANITIZE_STRING);

    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    if (!$category_id) {
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
        // an assignment of NULL or FALSE is ok here
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
        if (!$action) {
            $action = 'list_assignments'; // assigning default value if NULL or FALSE
        
            //if the actions were not defined on our page, then our default action would
            //be to list the assignments
        }
    }
    
    //different routes on the controller which needs different data
    switch($action) {
        case "list_categories": 
            $categories = get_categories();
            include('view/category_list.php');
            break;
        case "add_category":
            add_category($category_name);
            header("Location: .?action=list_categories");
            break;
        case "add_assignment": //once we have category, we can add assignment
            if ($category_id && $description) {
                add_assignment($category_id, $description); //call add_assignment funciton
                header("Location: .?category_id=$category_id"); //pass to the controller
                //new assignment added can be seen
            } else {
                $error = "Invalid assignment data. Check all fields and try again.";
                include('view/error.php');
                exit();
            }
            break;
        case "delete_category":
            if ($category_id) {
                try {
                    delete_category($category_id);
                } catch (PDOException $e) {
                    $error = "You cannot delete a category if assignments exist for it.";
                    include('view/error.php');
                    exit();
                }
                header("Location: .?action=list_categories");
            }
            break;
        case "delete_assignment":
            if ($assignment_id) {
                delete_assignment($assignment_id);
                header("Location: .?category_id=$category_id");
            } else {
                $error = "Missing or incorrect assignment id.";
                include('view/error.php');
            }
            break;
        default:
            $category_name = get_category_name($category_id);
            $categories = get_categories();
            $assignments = get_assignments_by_category($category_id);
            include('view/assignment_list.php');
    }


