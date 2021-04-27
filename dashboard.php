<?php require_once('lib/header.php'); 
    require_once('db-connection.php');
    $conn = openCon();
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

    <div class="courses mt-5">
        <h3>Courses</h3>
        <p>
            <?php
                if(isset($_SESSION['courseDeleteError'])){
                    echo "<span style='color:red'>" . $_SESSION['courseDeleteError'] . "</span>";
                }
            ?>
        </p>
        <p>
            <?php
                if(isset($_SESSION['courseDeleteMsg'])){
                    echo "<span style='color:green'>" . $_SESSION['courseDeleteMsg'] . "</span>";
                }
            ?>
        </p>
        <p>
            <?php
                if(isset($_SESSION['successCreateMessage'])){
                    echo "<span style='color:green'>" . $_SESSION['successCreateMessage'] . "</span>";
                }
            ?>
        </p>
        <a href=<?php path("./create-course.php"); ?> class="btn btn-success font-weight-bold d-block ml-auto" style="width: 200px">Create New Course +</a> 
        <?php 
            $sql = "SELECT * from courses WHERE user_id='{$_SESSION['loggedIn']}'";
            $result = $conn->query($sql);
            $allMyCourses = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $countAllMyCourses = count($allMyCourses);
        ?>
        <table class="table table-bordered table-hover table-dark">
            <thead>
                <th style="width: 250px">Name</th>
                <th>Description</th>
                <th></th>
            </thead>
            <tbody>
                <?php 
                    for($counter=0; $counter < $countAllMyCourses; $counter++){
                        $currentCourse = $allMyCourses[$counter];
                ?>
                <tr>
                    <td><?php echo $currentCourse['name']?></td>
                    <td>
                        <div style="max-height: 60px; overflow-y: auto">
                            <?php echo $currentCourse['description']?>
                        </div>
                    </td>
                    <td style="width: 200px"> 
                        <a href=<?php echo "edit-course.php?course-id={$currentCourse['id']}" ?> class="btn btn-outline-warning mr-3">Edit</a>
                        <a href=<?php echo "./processes/process-course-delete.php?course-id={$currentCourse['id']}" ?> class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                
            </tbody>
        </table>
        
    </div>
<?php 
    unset($_SESSION['successCreateMessage']);
    unset($_SESSION['courseDeleteMsg']);
    unset($_SESSION['courseDeleteError']);
    require_once('lib/footer.php'); 
?>