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
        <div class="app">
            <div class="appHeader">
                    <a href="task.php">Add Tasks<li></li></a>
                    <a href="schedule.php">Add Schedule<li></li></a>
            </div>
            <div class="content">
                <a href="taskView.php">
                    <div class="taskDiv">
                        <h1>Task View</h1>
                    </div>
                </a>

                <a href="scheduleView.php">
                    <div class="taskDiv">
                        <h1>Schedule View</h1>
                    </div>
                </a>
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
