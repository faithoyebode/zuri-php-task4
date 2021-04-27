<?php session_start();
    require_once('../db-connection.php');
    $conn = openCon();

    if(isset($_GET['course-id'])){
        $sql = "DELETE from courses WHERE id = '{$_GET['course-id']}'";
        if($conn->query($sql) === true){
            $deleteMessage = "Course was successfully deleted";
            $_SESSION['courseDeleteMsg'] = $deleteMessage;
            header("Location: ../dashboard.php");
        }else{
            $deleteError = $conn->error;
            $_SESSION['courseDeleteError'] = $deleteError;
            header("Location: ../dashboard.php");
        }
    }else{
        $deleteError = "No course was selected to be deleted";
        $_SESSION['courseDeleteError'] = $deleteError;
        header("Location: ../dashboard.php");
    }
?>