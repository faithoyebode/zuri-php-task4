<?php 
    include_once('lib/header.php');
?>
    <h3>Forgot password </h3>
    <p>Provide the email address associated with your account</p>
    <form action="processes/processforgot.php" method="POST">
        <p>
            <?php
                if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
                    echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
                    #session unset
                   session_destroy();
                }
            ?>
        </p>
        <p>
            <label>Email</label><br />
            <input 
            <?php
                if(isset($_SESSION['email'])){
                   echo "value=" . $_SESSION['email'];
                }
            ?>
            type="text" name="email" placeholder="Email"/>
        </p>
        <p>
            <button type="submit">Send Reset Code</button>
        </p>
    </form>
<?php 
    include_once('lib/footer.php');
?>