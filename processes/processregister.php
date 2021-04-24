 <?php session_start(); 
    //collecting data
    $errorCount = 0;
    
    //Assigning variables to the various form inputs
    // the errorcount variable deals with the number of blank spaces in the form
    if($_POST['first_name'] != ""){
        $first_name = $_POST['first_name'];
    }else{
        $errorCount++;
    }
    if($_POST['last_name'] != ""){
        $last_name = $_POST['last_name'];
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
    if(!empty($_POST['gender']) ){
        $gender = $_POST['gender'];
    }else{
        $errorCount++;
    }
    

    //assigning session variables to the form inputs
    $_SESSION['first_name'] = $first_name; 
    $_SESSION['last_name'] = $last_name; 
    $_SESSION['email'] = $email; 
    $_SESSION['password'] = $password; 
    $_SESSION['gender'] = $gender; 
    $nameErrorMsg = []; 

    //if any of the input is blank, execute this code
    if($errorCount > 0){
        $session_error = "You have " . $errorCount . " blank field";
        if($errorCount > 1){
            $session_error .= "s";
        }
        $session_error .= " in your form submission";
        //error message (no of blank spaces) is assigned to the session-error variable;
        //the remaining code in these "if" blocks also check for other errors associated with each user input
        $_SESSION["registerError"] = $session_error;
        if ($_POST['first_name'] == "" ){
            $nameErrorMsg['blank'] = "Name cannot be blank";
            $_SESSION['blankName'] = $nameErrorMsg['blank'];
        }
        if (strlen($_POST['first_name']) < 2 ){
            $nameErrorMsg['lessThanTwo'] = "Name should not be less than 2 characters";
            $_SESSION['lessThanTwo'] = $nameErrorMsg['lessThanTwo'];
        }
        if(isset($_POST['first_name'])){
            $arr = str_split($_POST['first_name']);
            $countArr = count($arr);
            for ($counter=0; $counter < $countArr; $counter++){
                if(is_numeric($arr[$counter])){
                    $nameErrorMsg['noNumber'] = "Name should not have numbers";
                    $_SESSION['noNumber'] = $nameErrorMsg['noNumber'];
                }
            }
        }

        if ($_POST['last_name'] == "" ){
            $nameErrorMsg['blankL'] = "Name cannot be blank";
            $_SESSION['blankNameL'] = $nameErrorMsg['blankL'];
        }
        if (strlen($_POST['last_name']) < 2 ){
            $nameErrorMsg['lessThanTwoL'] = "Name should not be less than 2 characters";
            $_SESSION['lessThanTwoL'] = $nameErrorMsg['lessThanTwoL'];
        }
        if(isset($_POST['last_name'])){
            $arrL = str_split($_POST['last_name']);
            $countArrL = count($arrL);
            for ($counter=0; $counter < $countArrL; $counter++){
                if(is_numeric($arrL[$counter])){
                    $nameErrorMsg['noNumberL'] = "Name should not have numbers";
                    $_SESSION['noNumberL'] = $nameErrorMsg['noNumberL'];
                }
            }
        }

        if ($_POST['email'] == "" ){
            $emailErrorMsg['blank'] = "Email must not be empty";
            $_SESSION['blankMail'] = $emailErrorMsg['blank'];
        }
        if (strlen($_POST['email']) < 5 ){
            $emailErrorMsg['lessThanFive'] = "Email must not be less than 5 characters";
            $_SESSION['lessThanFive'] = $emailErrorMsg['lessThanFive'];
        }
        if(isset($_POST['email'])){
            $atChars=false;
            $dotChars=false;
            $earr = str_split($_POST['email']);
            $countEarr = count($earr);
            for($counter=0; $counter < $countEarr; $counter++){
                if($earr[$counter] == "@"){$atChars = true;}
                if($earr[$counter] == "."){$dotChars = true;}   
            }
            if($atChars == false || $dotChars == false){
                $emailErrorMsg['mustHave'] = "Email must have @ and . in it";
                $_SESSION['mustHave'] = $emailErrorMsg['mustHave'];
            }
        }
        if(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) == FALSE){
            $emailErrorMsg['invalidMail'] = "Your email input is invalid";
            $_SESSION['invalidMail'] = $emailErrorMsg['invalidMail'];

        }
        //any blank input redirects the user back to the register page showing all the input errors of the user
        header("Location: ../register.php");
    }else{
         //if every field is filled, execute the code in this block
        if(isset($_POST['first_name'])){
            $arr = str_split($_POST['first_name']);
            $countArr = count($arr);
            for ($counter=0; $counter < $countArr; $counter++){
                if(is_numeric($arr[$counter])){
                    $nameErrorMsg['noNumber'] = "Name should not have numbers";
                    $_SESSION['noNumber'] = $nameErrorMsg['noNumber'];
                }
            }
        }
        if (strlen($_POST['first_name']) < 2){
            $nameErrorMsg['lessThanTwo'] = "Name should not be less than 2";
            $_SESSION['lessThanTwo'] = $nameErrorMsg['lessThanTwo'];   
        }

        if(isset($_POST['last_name'])){
            $arrL = str_split($_POST['last_name']);
            $countArrL = count($arrL);
            for ($counter=0; $counter < $countArrL; $counter++){
                if(is_numeric($arrL[$counter])){
                    $nameErrorMsg['noNumberL'] = "Name should not have numbers";
                    $_SESSION['noNumberL'] = $nameErrorMsg['noNumberL'];
                }
            }
        }
        if (strlen($_POST['last_name']) < 2 ){
            $nameErrorMsg['lessThanTwoL'] = "Name should not be less than 2 characters";
            $_SESSION['lessThanTwoL'] = $nameErrorMsg['lessThanTwoL'];
        }

        if (strlen($_POST['email']) < 5 ){
            $emailErrorMsg['lessThanFive'] = "Email must not be less than 5 characters";
            $_SESSION['lessThanFive'] = $emailErrorMsg['lessThanFive'];
        }
        if(isset($_POST['email'])){
            $atChars=false;
            $dotChars=false;
            $earr = str_split($_POST['email']);
            $countEarr = count($earr);
            for($counter=0; $counter < $countEarr; $counter++){
                if($earr[$counter] == "@"){$atChars = true;}
                if($earr[$counter] == "."){$dotChars = true;}   
            }
            if($atChars == false || $dotChars == false){
                $emailErrorMsg['mustHave'] = "Email must have @ and . in it";
                $_SESSION['mustHave'] = $emailErrorMsg['mustHave'];
            }
        }
        if(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) == FALSE){
            $emailErrorMsg['invalidMail'] = "Your email input is invalid";
            $_SESSION['invalidMail'] = $emailErrorMsg['invalidMail'];

        }
        // if there is any validation error and there is no blank field, prevent the user from registering
        if(isset($_SESSION['lessThanTwo']) || isset($_SESSION['noNumber']) || isset($_SESSION['lessThanTwoL']) 
        || isset($_SESSION['noNumberL']) || isset($_SESSION['lessThanFive']) || isset($_SESSION['mustHave']) 
        || isset($_SESSION['invalidMail'])){
            header("Location: ../register.php");
            die();
        }
        //execute this part when there are no errors in the input
        $allUsers = scandir("../db/users/");
        $countAllUsers = count($allUsers);
        $newUserId = ($countAllUsers - 2) + 1;
        $userObject= [
            'id'=>$newUserId,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'email'=>$email,
            'password'=>password_hash($password,PASSWORD_DEFAULT),
            'gender'=>$gender                                                                                                                                                                                                              
        ];
        
        //this section checks if the email the user is using to register is existing on the database
        // If its is, the user is redirected back to the register page with an error message
        for ($counter=0; $counter < $countAllUsers; $counter++){
            $currentUser = $allUsers[$counter];
            if($currentUser == $email . ".json"){
                $_SESSION['registerError'] = "Registration failed, User already exist" ;
                header("Location: ../register.php");
                die();

            }
        }

        //If everything is fine, the user records are saved in the database
        file_put_contents("../db/users/" . $email . ".json", json_encode($userObject));
        $_SESSION['regToLoginMessage'] = "Registration Successful, you can now login! " . $first_name ;
       
        //redirect the user to login page when registration is successful
        header("Location: ../login.php");
}
    



    //saving data into the database
 ?>  