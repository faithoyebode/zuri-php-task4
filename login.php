<?php include_once('lib/header.php'); 
if(isset($_SESSION['loggedIn'])){
    header("Location: dashboard.php");
}
?>
<h3 class="pt-5">Login</h3>

    <?php 
        unset($_SESSION['first_name']);
        unset($_SESSION['noNumber']);
        unset($_SESSION['lessThanTwo']);
        unset($_SESSION['blankName']);
        unset($_SESSION['last_name']);
        unset($_SESSION['noNumberL']);
        unset($_SESSION['lessThanTwoL']);
        unset($_SESSION['blankNameL']);
        unset($_SESSION['email']);
        unset($_SESSION['invalidMail']);
        unset($_SESSION['blankMail']);
        unset($_SESSION['lessThanFive']);
        unset($_SESSION['mustHave']);
        unset($_SESSION['department']);
        unset($_SESSION['gender']);
    ?>
    <p>
        <?php
        
           if(isset($_SESSION['regToLoginMessage'])){
                echo "<span style='color:red'>" . $_SESSION['regToLoginMessage'] . "</span>";
                    
            }
            if(isset($_SESSION['resetToLoginMessage'])){
                echo "<span style='color:red'>" . $_SESSION['resetToLoginMessage'] . "</span>";
                    
            }
        ?>
    </p>
     
    <form method="POST" action="processes/processlogin.php" class="w-50">
        <p>
            <?php
                if(isset($_SESSION['loginError']) && !empty($_SESSION['loginError'])){
                    echo "<span style='color:red'>" . $_SESSION['loginError'] . "</span>";
                }
            ?>
        </p>
        <p>
            <?php
                if(isset($_SESSION['message'])){
                    echo "<span style='color:green'>" . $_SESSION['message'] . "</span>";
                }
            ?>
        </p>
        
        <p class="form-group">
            <label>Email</label><br />
            <input 
            <?php
                if(isset($_SESSION['email'])){
                   echo "value=" . $_SESSION['email'];
                }
            ?>
            type="text" name="email" placeholder="Email" class="form-control" required>
        </p>
        <p class="form-group">
            <label>Password</label><br />
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </p>
        
        <p>
            <button type="submit" class="form-control btn btn-success">Login</button>
        </p>
    </form>

<?php 
    include_once('lib/footer.php'); 
    unset($_SESSION['regToLoginMessage']);
    unset($_SESSION['resetToLoginMessage']);
    unset($_SESSION['loginError']);
?>