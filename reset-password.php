<?php 
    require_once('lib/header.php');
    // if(!isset($_GET['token']) && !isset($_SESSION['token'])){
    //     $_SESSION['error'] = "You are not authorized to view that page";
    //     header("Location: login.php");
    //     die();
    // }
?>
    <h3>Reset password </h3>
    <p>Reset password associated with your account</p>
    <form action="processes/processreset.php" method="POST" class="w-50">
        <p>
            <?php
                if(isset($_SESSION["resetError"]) && !empty($_SESSION["resetError"])){
                    echo "<span style='color:red'>" . $_SESSION["resetError"] . "</span>";
                }
            ?>
        </p>
        <p class="form-group">
            <label>Email</label><br />
            <input type="text" name="email" placeholder="Email" class="form-control" required />
        </p>
        <p>
            <?php
                if(isset($_SESSION['unAuthMsg'])){
                    echo "<span style='color:green'>" . $_SESSION['unAuthMsg'] . "</span>";
                }
            ?>
        </p>
        <p class="form-group">
            <label>Enter New Password</label><br />
            <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off" required />
        </p>
        <p class="form-group">
            <label>Confirm Password</label><br />
            <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control" autocomplete="off" required />
        </p>
        <p>
            <?php
                if(isset($_SESSION['diffPassword'])){
                    echo "<span style='color:green'>" . $_SESSION['diffPassword'] . "</span>";
                }
            ?>
        </p>
        <p>
            <button type="submit" class="form-control btn btn-danger">Change Password</button>
        </p>
    </form>
<?php 
    require_once('lib/footer.php');
    unset($_SESSION['unAuthMsg']);
    unset($_SESSION['diffPassword']);
    unset($_SESSION["resetError"]);

?>