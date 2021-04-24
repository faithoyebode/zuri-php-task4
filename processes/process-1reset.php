<?php session_start();
    $errorCount = 0;
    if($_POST['token'] != ""){
        $token = $_POST['token'];
    }else{
        $errorCount++;
    }
    if($_POST['email'] != ""){
        $email = $_POST['email'];
    }else{
        $errorCount++;
    }
    if($_POST['password'] != ""){
        $password = $_POST['password'];
    }else{
        $errorCount++;
    } 

    $_SESSION['token'] = $token; 
    $_SESSION['email'] = $email;
    if($errorCount > 0){
        $session_error = "You have " . $errorCount . " blank field";
        if($errorCount > 1){
            $session_error .= "s";
        }
        $session_error .= " in your form submission";
        $_SESSION["error"] = $session_error;
        header("Location: ../reset.php"); 
    }else{
        //do actual reset things here
        //check that the email is registered in tokens folder
        //check if the content of the registered token (in our folder) is thesame as token 
        $allUserTokens = scandir("../db/tokens/");
        $countAllUserTokens = count($allUserTokens);
        for ($counter=0; $counter < $countAllUserTokens; $counter++){
            $currentTokenFile = $allUserTokens[$counter];
            if($currentTokenFile == $email . ".json"){
                //now check if the token in the current token file is thesame as token
                $tokenContent=file_get_contents("../db/tokens/" .$currentTokenFile);
                $tokenObject = json_decode($tokenContent);
                $tokenFromDB = $tokenObject->token;

                if($tokenFromDB == $token){
                    $allUsers = scandir("../db/users/");
                    $countAllUsers = count($allUsers);
                    for ($counter=0; $counter < $countAllUsers; $counter++){
                        $currentUser = $allUsers[$counter];
                        if($currentUser == $email . ".json"){
                            //check user password
                            $userString=file_get_contents("../db/users/" .$currentUser);
                            $userObject = json_decode($userString, true);
                            $userObject['password'] = password_hash($password, PASSWORD_DEFAULT);
                            file_put_contents("../db/users/" . $currentUser, json_encode($userObject));
                            $_SESSION['message'] = "Pasword Reset Successful, you can now login! " . $userObject['first_name'] ;
                            /*
                            INFORM USER OF PASSWORD RESET
                            */
                            $subject = "Password Reset Successful";
                            $message = "Your account on SNH has just been updated, your password has changed. If you did not initiate the password change, please visit snh.org and reset your password immediately.";
                              
                            $headers = "From: no-reply@snh.org" ;
                
                            $try = mail($email,$subject,$message,$headers);
                
                            /*
                            INFORM USER OF PASSWORD RESET ENDS
                            */
                            unlink("../db/tokens/" . $currentTokenFile);
                            header("Location: ../login.php");
                            die();
                        }
                    }
                }    
            }
        }
        $_SESSION['message'] = "Password Reset Failed, token/email invalid or expired";
        header("Location: ../login.php");
    }
?>    