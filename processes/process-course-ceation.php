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
        $description = $_POST['description'];
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
        $_SESSION["courseCreationError"] = $session_error;
        header("Location: ../create-course.php"); 
    }else{
        //do actual reset things here
        //check that the email is registered in tokens folder
        //check if the content of the registered token (in our folder) is thesame as token 
        $result = $conn->query("SELECT name FROM courses WHERE user_id='{$_SESSION['loggedIn']}'");
        $allMyCourses = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $countAllMyCourses = count($allMyCourses);

        for($counter=0; $counter < $countAllMyCourses; $counter++){
            $currentCourse = $allMyCourses[$counter];
            var_dump($currentCourse); 
            if(strtolower($currentCourse['name']) === strtolower($name)){
                $_SESSION['creationError'] = "Course creation failed, You have already created a course with the same name" ;
                header("Location: ../create-course.php");
                die();
            }else{
                $sql = "INSERT INTO courses (name, description, user_id) VALUES ('{$name}', '{$description}', '{$_SESSION['loggedIn']}')";

                if($conn->query($sql) === TRUE){
                    //file_put_contents("../db/users/" . $email . ".json", json_encode($userObject));
                    $_SESSION['successCreateMessage'] = "Course Creation Successful!";
                    header("Location: ../dashboard.php");
                    die();
                }else{
                    $_SESSION['courseCreationError'] = $conn->error;
                    header("Location: ../create-course.php");
                    die();
                }
            }
        }

    }
?>    