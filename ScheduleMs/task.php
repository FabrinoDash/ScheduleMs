<?php
include "headerMainPage.php";
include_once "connection.php";
if (isset($_SESSION['uname'])) {

?>
        <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="css/scheduleFormResponsive.css">
            <div class="app taskApp">
                <p class="head">Add your Tasks Here</p>
                <form class='scheduleForm' action="" method="POST">
                    <table>
                        <tr>
                            <td><label for="">Task Title</label></td>
                            <td><input type="text" name="taskTitle"></td>
                        </tr>

                        <tr>
                            <td><label for="">Task Details</label></td>
                            <td><input type="text" name="taskDetail"></td>
                        </tr>

                        <tr>
                            <td><label for="">Task Date</label></td>
                            <td><input type="date" name="taskDate"></td>
                        </tr>

                        <tr>
                            <td><label for="">Task Time</label></td>
                            <td><input type="time" name="taskTime"></td>
                        </tr>

                        <tr>
                            <td colspan="2" style="padding: 30px;text-align:center;"><button type="submit" name="add">Add</button></td>
                        </tr>
                    </table>
                </form>

                <?php
                    if (isset($_POST['add'])) {
                        $task_title =$_POST['taskTitle'];
                        $task_detail =$_POST['taskDetail'];
                        $task_date =$_POST['taskDate'];
                        $task_time =$_POST['taskTime'];
                        
                        if ($task_title == "" || $task_detail == "" || $task_date == "" || $task_time == "") {
                            echo "<div class='errorMessage'>Field cant be empty</div>";
                            exit();
                        }

                        $query = "INSERT INTO dashcorptask(UserId, TaskTitle, TaskDetail, TaskDate,	TaskTime) VALUES('$uid','$task_title','$task_detail','$task_date','$task_time');";
                        $result = mysqli_query($conn,$query);

                        if ($result) {
                            header("location:taskView.php?added");
                            exit();
                        }
                        else{
                            echo mysqli_error($conn);
                        }
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