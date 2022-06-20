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
        <link rel="stylesheet" href="css/scheduleFormResponsive.css">
        <div class="app">
            <p class="head">Add your Schedule Here</p>
            <form class='scheduleForm' action="" method="POST">
                <table>
                    <tr>
                        <td><label for="">Title</label></td>
                        <td><input type="text" name="stitle"></td>
                    </tr>

                    <tr>
                        <td><label for="">Schedule Details</label></td>
                        <td><input type="text" name="sdetail"></td>
                    </tr>

                    <tr>
                        <td><label for="">Location</label></td>
                        <td><input type="text" name="location"></td>
                    </tr>

                    <tr>
                        <td><label for="">Date</label></td>
                        <td><input type="date" name="date"></td>
                    </tr>

                    <tr>
                        <td><label for="">Start Time</label></td>
                        <td><input type="time" name="stime"></td>
                    </tr>

                    <tr>
                        <td><label for="">End Time</label></td>
                        <td><input type="time" name="etime"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 30px;text-align:center;"><button type="submit" name="submit">Add</button></td>
                    </tr>
                </table>
            </form>

            <?php
                if (isset($_POST['submit'])) {
                    $schedule_title =$_POST['stitle'];
                    $schedule_detail =$_POST['sdetail'];
                    $schedule_location =$_POST['location'];
                    $schedule_date =$_POST['date'];
                    $schedule_start_time =$_POST['stime'];
                    $schedule_end_time =$_POST['etime'];
                    
                    if ($schedule_title == "" || $schedule_detail == "" || $schedule_location == "" || $schedule_date == "" || $schedule_start_time=="" || $schedule_end_time=="") {
                        echo "<div class='errorMessage'>Field cant be empty</div>";
                        exit();
                    }

                    $query = "INSERT INTO dashcorpschedule(UserId, schedule_title, schedule_detail, schedule_location, schedule_date, schedule_start_time, schedule_end_time) VALUES('$uid','$schedule_title','$schedule_detail','$schedule_location','$schedule_date','$schedule_start_time','$schedule_end_time');";
                    $result = mysqli_query($conn,$query);

                    if ($result) {
                        header("location:scheduleView.php?added");
                        exit();
                    }
                    else{
                        echo mysqli_error($conn);
                    }
                }
            ?>
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
