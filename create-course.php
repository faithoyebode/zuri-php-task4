<?php include_once('lib/header.php'); 

?>
<h3 class="pt-5">Create New Course</h3>
     
    <form method="POST" action="./processes/process-course-ceation.php" class="w-50">
        <p>
            <?php
                if(isset($_SESSION['courseCreationError']) && !empty($_SESSION['courseCreationError'])){
                    echo "<span style='color:red'>" . $_SESSION['courseCreationError'] . "</span>";
                }
            ?>
        </p>
        
        <p class="form-group">
            <label>Name</label><br />
            <input
            value= 
            "<?php
                if(isset($_SESSION['course-name'])){
                   echo $_SESSION['course-name'];
                }
            ?>"
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
                    if(isset($_SESSION['course-description'])){
                        echo htmlspecialchars($_SESSION['course-description']);
                    }
                ?>
            </textarea>
        </p>
        
        <p>
            <button type="submit" class="form-control btn btn-success">Create</button>
        </p>
    </form>

<?php 
    include_once('lib/footer.php'); 
    unset($_SESSION['courseCreationError']);
    unset($_SESSION['course-name']);
    unset($_SESSION['course-description']);
?>