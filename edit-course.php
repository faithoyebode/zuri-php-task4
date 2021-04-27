<?php include_once('lib/header.php'); 

?>
<h3 class="pt-5">Create New Course</h3>

    <?php 
        
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
     
    <form method="POST" action="./processes/process-course-ceation.php" class="w-50">
        <p>
            <?php
                if(isset($_SESSION['courseCreationError']) && !empty($_SESSION['courseCreationError'])){
                    echo "<span style='color:red'>" . $_SESSION['loginError'] . "</span>";
                }
            ?>
        </p>
        
        <p class="form-group">
            <label>Name</label><br />
            <input 
            <?php
                if(isset($_SESSION['course-name'])){
                   echo "value=" . $_SESSION['course-name'];
                }
            ?>
            type="text" name="name" placeholder="Name of course" class="form-control" required>
        </p>
        <p class="form-group">
            <label>Description</label><br />
            <textarea 
                name="description" 
                id="description" 
                cols="30" rows="5" 
                <?php
                    if(isset($_SESSION['course-description'])){
                        echo "value=" . $_SESSION['course-description'];
                    }
                ?>
                placeholder="What is this course about?" 
                class="form-control" 
                required
            >
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