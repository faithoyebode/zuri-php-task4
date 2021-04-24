<?php session_start(); 
    $errorCount = 0;
    //Assign variables to user inputs
    $email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
    $password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
    $_SESSION['email'] = $email; 
    //if any of the field is empty, execute this
    if($errorCount > 0){
        echo "about to work";
                die();
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
        $allUsers = scandir("../db/users/");
        $countAllUsers = count($allUsers);
        
        for ($counter=0; $counter < $countAllUsers; $counter++){
            $currentUser = $allUsers[$counter];
            if($currentUser == $email . ".json"){
                //check user password
                $userString=file_get_contents("../db/users/" . $currentUser);
                $userObject = json_decode($userString);
                $passwordFromDB = ($userObject->password);
                $passwordFromUser = password_verify($password, $passwordFromDB);
                

                if($passwordFromUser == true){
                    
                    //redirect to dashboard
                    date_default_timezone_set("Africa/Lagos");
                    $loginTime = date('h:i:sa');
                    $loginDate = date('d/m/Y');
                    $_SESSION['logInTime'] = $loginTime;
                    $_SESSION['logInDate'] = $loginDate;
                    $_SESSION['lastLogDate'] = isset($userObject->lastLogDate) ? $userObject->lastLogDate : '';
                    $_SESSION['lastLogTime'] = isset($userObject->lastLogTime) ? $userObject->lastLogTime : '';
                    $_SESSION['loggedIn'] = $userObject->id;
                    $_SESSION['fullname'] = $userObject->first_name . " " . $userObject->last_name;
                   
                    //Record New Last Login Time and Date
                    $userObject->lastLogTime = $loginTime;
                    $userObject->lastLogDate = $loginDate;
                    file_put_contents("../db/users/" . $currentUser, json_encode($userObject));
                    header("Location: ../dashboard.php");
                    die();
                    
                }else{
                    $session_error = "Invalid username or password";
                    $_SESSION["loginError"] = $session_error;
                    header("Location: ../login.php");
                    die();
                }
                 
            }

        }
        $session_error = "Invalid username or password";
        $_SESSION["loginError"] = $session_error;
        header("Location: ../login.php");
        die();
    }
?>