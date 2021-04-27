<?php session_start();
 require_once('../db-connection.php');
 $conn = openCon();

    $errorCount = 0;
    //Assign variables to user inputs
    $email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
    $password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
    $_SESSION['email'] = $email; 
    //if any of the field is empty, execute this
    if($errorCount > 0){
        //this section determines the number of empty fields, output them and prevents login
        $session_error = "You have " . $errorCount . " error";
        if($errorCount > 1) {
            $session_error .= "s";
        }
        $session_error .= " in your form submission";
        //session_error indicates number of blank fields
        $_SESSION["loginError"] = $session_error;
        header("Location: ../login.php");
    }else{
        // this section processes all the fields if there is no blank one on input
        //get all the user files in the database as an array
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $result = $conn->query("SELECT * FROM users WHERE email='{$email}'");
        $currentUser = mysqli_fetch_assoc($result);

        $passwordFromDB = $currentUser['password'];
        $passwordFromUser = password_verify($password, $passwordFromDB);
        echo $passwordFromUser;
        //$countAllUsers = count($allUsers);

        if($passwordFromUser === true){
            
            //redirect to dashboard
            date_default_timezone_set("Africa/Lagos");
            $loginTime = date('H:i:s');
            $loginDate = date('Y-m-d');
            $_SESSION['logInTime'] = $loginTime;
            $_SESSION['logInDate'] = $loginDate;
            $_SESSION['lastLogDate'] = isset($currentUser['lastLogDate']) ? $currentUser['lastLogDate'] : '';
            $_SESSION['lastLogTime'] = isset($currentUser['lastLogTime']) ? $currentUser['lastLogTime'] : '';
            $_SESSION['fullname'] = $currentUser['first_name'] . " " . $currentUser['last_name'];
            
            //Record New Last Login Time and Date
            $currentUser['lastLogTime'] = $loginTime;
            $currentUser['lastLogDate'] = $loginDate;
            $sql = "UPDATE users SET lastLogTime = '{$currentUser['lastLogTime']}', lastLogDate = '{$currentUser['lastLogDate']}' WHERE email='{$email}'";
            $result = $conn->query($sql);
        
            if($result === true){
                $_SESSION['loggedIn'] = $currentUser['id'];
                header("Location: ../dashboard.php");
                die();
            }else{
                $session_error = $conn->error;
                $_SESSION["loginError"] = $session_error;
                header("Location: ../login.php");
                die();
            }
            
        }else{
            $session_error = "Invalid username or password";
            $_SESSION["loginError"] = $session_error;
            header("Location: ../login.php");
            die();
        }
                 
    }
?>