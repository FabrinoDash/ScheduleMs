<?php
include "headerMainPage.php";
if (isset($_SESSION['uname'])) {

    $_SESSION['uname'];
    $_SESSION['fname'];
    $_SESSION['contact'];
    $uid = $_SESSION['id'];
    $_SESSION['nationality'];
    $_SESSION['city'];
    $_SESSION['gender'];
    $_SESSION['timeRegistered'];
?>
        <link rel="stylesheet" href="css/app.css">

        <?php
        if(isset($_GET['sucessDelete'])) {
        ?>
        <div class="success">
            <p>Successfully Deleted</p>
        </div>
        <?php
        }
        if(isset($_GET['added'])) {
            ?>
            <div class="success">
                <p>Successfully Added</p>
            </div>
            <?php
        }
        ?>
        <div class="app">
            <div class="appHeader">
                    <a href="task.php">Add Tasks<li></li></a>
                    <a href="schedule.php">Add Schedule<li></li></a>
            </div>
            <div class="content">
                <?php
                    $sql1 = "SELECT * FROM dashcorptask WHERE UserId=$uid ORDER BY TaskId DESC;";
                    $result = mysqli_query($conn,$sql1);
                    while($row=mysqli_fetch_array($result)){
                        $taskId = $row['TaskId'];
                        echo "<div class='taskDiv'>";
                            echo $row['TaskTitle']."<br>";
                            echo $row['TaskDetail']."<br>";
                            echo $row['TaskDate']."<br>";
                            echo $row['TaskTime']."<br>";?>
                            <div class="taskDelete"><a href="deleteTask.php?tid=<?=$taskId?>">Delete</a></div>
                            <?php
                        echo "</div>"; 
                    }
                ?>
            </div>
        </div>
    </body>
    </html>

<?php
}
else{
    header("location:signin.php");
    exit();
}
?>
