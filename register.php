<?php include_once('lib/header.php');

//If the user is logged in, and  is not trying to add another user as a super admin
if(isset($_SESSION['loggedIn'])){
    //redirect to dashboard
    header("Location: dashboards/dashboard.php");
}
?>  <!-- page title -->
    <p class="pt-5">
        <strong> Welcome, Please Register </strong>
    </p>

    <p>All fields are required </p>

   <!-- page form field --> 
    <form method="POST" action="processes/processregister.php" class="w-50">
        <p>
            <?php
                if(isset($_SESSION['registerError']) && !empty($_SESSION['registerError'])){
                    echo "<span style='color:red'>" . $_SESSION['registerError'] . "</span>";
                }
            ?>
        </p>
        <p class="form-group">
            <?php
            /********************** 
             * FIRST NAME;
             * ***************/
            ?>
            <label>First Name</label><br />
            <input 
            <?php
                if(isset($_SESSION['first_name'])){
                   echo "value=" . $_SESSION['first_name'];
                }
            ?>
            type="text" name="first_name" placeholder="First Name" class="form-control mt-n1" required />
            <p>
                <?php
                    if(isset($_SESSION['noNumber'])){
                        echo "<span style='color:red'>" . $_SESSION['noNumber']  . "</span>";
                    }
                ?>
            </p>
            <p>
                <?php
                    if(isset($_SESSION['lessThanTwo'])){
                        echo "<span style='color:red'>" . $_SESSION['lessThanTwo'] . "</span>";
                    }
                ?>
            </p>
            <p>
                <?php
                    if(isset($_SESSION['blankName'])){
                        echo "<span style='color:red'>" . $_SESSION['blankName'] . "</span>";
                    }
                ?>
            </p>
        </p>
        <p class="form-group">
        <?php
            /********************** 
             * LAST NAME;
             * ***************/
        ?>
            <label>Last Name</label><br />
            <input 
            <?php
                if(isset($_SESSION['last_name'])){
                   echo "value=" . $_SESSION['last_name'];
                }
            ?>
            type="text" name="last_name" placeholder="Last Name" class="form-control mt-n1" required />
        </p>
        <p>
                <?php
                    if(isset($_SESSION['noNumberL'])){
                        echo "<span style='color:red'>" . $_SESSION['noNumberL']  . "</span>";
                    }
                ?>
            </p>
            <p>
                <?php
                    if(isset($_SESSION['lessThanTwoL'])){
                        echo "<span style='color:red'>" . $_SESSION['lessThanTwoL'] . "</span>";
                    }
                ?>
            </p>
            <p>
                <?php
                    if(isset($_SESSION['blankNameL'])){
                        echo "<span style='color:red'>" . $_SESSION['blankNameL'] . "</span>";
                    }
                ?>
            </p>
        </p>
        <p class="form-group">
        <?php
            /********************** 
             * E--MAIL;
             * ***************/
        ?>
            <label>Email</label><br />
            <input 
            <?php
                if(isset($_SESSION['email'])){
                   echo "value=" . $_SESSION['email'];
                }
            ?>
            type="text" name="email" placeholder="Email" autocomplete="off" class="form-control mt-n1" rquired >
            <p>
                <?php
                    if(isset($_SESSION['invalidMail'])){
                        echo "<span style='color:red'>" . $_SESSION['invalidMail']  . "</span>";
                    }
                ?>
            </p>
            <p>
                <?php
                    if(isset($_SESSION['blankMail'])){
                        echo "<span style='color:red'>" . $_SESSION['blankMail'] . "</span>";
                    }
                ?>
            </p>
            <p>
                <?php
                    if(isset($_SESSION['lessThanFive'])){
                        echo "<span style='color:red'>" . $_SESSION['lessThanFive'] . "</span>";
                    }
                ?>
            </p>
            <p>
                <?php
                    if(isset($_SESSION['mustHave'])){
                        echo "<span style='color:red'>" . $_SESSION['mustHave'] . "</span>";
                    }
                ?>
            </p>
        </p>
        <?php
            /********************** 
             * END OF E--MAIL;
             * *******************/
        ?>
        <p class="form-group">
            <label>Password</label><br />
            <input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control mt-n1"/>
        </p>
        <p class="form-group">
            <label>Gender</label><br />
            <select name="gender" class="form-control mt-n1">
            <?php
                if(isset($_SESSION['department'])){
                   echo "value=" . $_SESSION['department'];
                }
            ?>
                <option value="">Select One</option>
                <option
                <?php
                if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){
                   echo "selected";
                }
                ?>
                >Female</option>
                <option
                <?php
                if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male'){
                   echo "selected";
                }
                ?>>Male</option>
            </select>
        
        <p>
            <button type="submit" class="form-control btn btn-danger">Register</button>
        </p>
    </form>

<?php 
    include_once('lib/footer.php');
    unset($_SESSION['registerError']);
?>
