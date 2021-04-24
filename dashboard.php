<?php require_once('lib/header.php'); 
    if(!isset($_SESSION['loggedIn'])){
        //redirect to dashboard
        header("Location: ../login.php");
    }
?>
    <h3 class="pt-5">Dashboard</h3>
    <!-- <p>
        //<?php
        //    if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
        //        echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
        //    }
        //?>
    </p> -->
    <p>
        <?php
            if(isset($_SESSION['message'])){
                echo "<span style='color:green'>" . $_SESSION['message'] . "</span>";
            }
        ?>
    </p>
    <p>Welcome, <?php echo $_SESSION['fullname']?>,  You are logged in.</p>
    <p> 
        Your ID is <?php echo $_SESSION['loggedIn']?>.
    </p>
    <?php 
    if($_SESSION['lastLogDate'] != "" && $_SESSION['lastLogTime'] != ""){
    ?>
        <p>
            The last time you logged in was on  <?php echo $_SESSION['lastLogDate']?> at <?php echo $_SESSION['lastLogTime']?>
        </p>
    <?php } ?>
    <p>
        Your present login time is  <?php echo $_SESSION['logInTime']?>
    </p>
    <p>
        Your present login date is <?php echo $_SESSION['logInDate']?>
    </p>
<?php 
    require_once('lib/footer.php'); 
?>