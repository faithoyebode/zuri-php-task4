<?php include_once('lib/header.php'); 
require_once('db-connection.php');
$conn = openCon();

    if(!isset($_GET['course-id'])){
        $editError = "No course was selected to be edited";
        $_SESSION['courseEditError'] = $editError;
        header("Location: dashboard.php");
        die();
    }

     $_SESSION['course-id']= $_GET['course-id'];
    $sql = "SELECT * FROM courses where id='{$_GET['course-id']}'";
    $result = $conn->query($sql);
    $currentCourse = mysqli_fetch_assoc($result);
?>
<h3 class="pt-5">Edit Course</h3>
    
    <form method="POST" action="./processes/process-course-edit.php" class="w-50">
        <p>
            <?php
                if(isset($_SESSION['courseEditError']) && !empty($_SESSION['courseEditError'])){
                    echo "<span style='color:red'>" . $_SESSION['courseEditError'] . "</span>";
                }
            ?>
        </p>
        
        <p class="form-group">
            <label>Name</label><br />
            <input 
            value=
            "<?php
                if(isset($currentCourse['name'])){
                    echo $currentCourse['name']; 
                }else{
                    echo $_SESSION['course-name'];
                }
            ?>""
            type="text" name="name" placeholder="Name of course" class="form-control" required>
        </p>
        <p class="form-group">
            <label>Description</label><br />
            <textarea 
                name="description" 
                id="description" 
                cols="30" rows="5" 
                placeholder="What is this course about?" 
                class="form-control" 
                required
            >
                <?php
                    if(isset($currentCourse['description'])){
                        echo htmlspecialchars($currentCourse['description']);
                    }else{
                        echo htmlspecialchars($_SESSION['course-description']);
                    }
                ?>
            </textarea>
        </p>
        
        <p>
            <button type="submit" class="form-control btn btn-success">Edit</button>
        </p>
    </form>

<?php 
    include_once('lib/footer.php'); 
    unset($_SESSION['courseCreationError']);
    unset($_SESSION['course-name']);
    unset($_SESSION['course-description']);
?>