<?php session_start();
    require_once('../db-connection.php');
    $conn = openCon();
    $errorCount = 0;
    if($_POST['name'] != ""){
        $name = trim($_POST['name']);
    }else{
        $errorCount++;
    }
    if($_POST['description'] != ""){
        $description = trim($_POST['description']);
    }else{
        $errorCount++;
    }
     

    $_SESSION['course-name'] = $name; 
    $_SESSION['course-description'] = $description;
    if($errorCount > 0){
        $session_error = "You have " . $errorCount . " blank field";
        if($errorCount > 1){
            $session_error .= "s";
        }
        $session_error .= " in your form submission";
        $_SESSION["courseEditError"] = $session_error;
        header("Location: ../create-course.php?course-id={$_SESSION['course-id']}"); 
    }else{

        $result = $conn->query("UPDATE courses SET name = '{$name}', description='{$description}' WHERE id='{$_SESSION['course-id']}'");
        if($result === true){
            $_SESSION['successEditMessage'] = "Course Edit Successful!";
            header("Location: ../dashboard.php");
        }else{
            $_SESSION['courseEditError'] = $conn->error;
            header("Location: ../create-course.php?course-id={$_SESSION['course-id']}"); 
        }
    }
?>    