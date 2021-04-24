    
    
        <p>
            <a href=<?php path("../index.php"); ?> class="btn btn-primary">Index</a> 
            <?php 
            // if the user is not logged in, hide logout and reset password links
            if(isset($_SESSION['loggedIn'])){?>
                <a href=<?php path("../logout.php"); ?> class="btn btn-outline-danger font-weight-bold">Logout</a> 
                <a href=<?php path("../reset-password.php"); ?> class="btn btn-outline-primary font-weight-bold">Reset Password</a>
           
            <?php }else{?>

                <a href=<?php path("../login.php"); ?> class="btn btn-outline-success font-weight-bold">Login</a> 
                <a href=<?php path("../register.php"); ?> class="btn btn-outline-primary font-weight-bold">Register</a> 
           
            <?php } ?>
            
        </p>
    </div>
</body>
</html> 