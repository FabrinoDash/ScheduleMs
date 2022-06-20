<?php
session_start();
include "connection.php";

if (isset($_SESSION['uname'])) {
    $_SESSION['uname'];
    $_SESSION['fname'];
    $_SESSION['contact'];
    $uid = $_SESSION['id'];
    $_SESSION['nationality'];
    $_SESSION['city'];
    $_SESSION['gender'];
    $_SESSION['timeRegistered'];

    if (isset($_GET['schid'])) {

        $schid=$_GET['schid'];

        $sql="DELETE FROM dashcorpschedule WHERE ScheduleId='$schid';";
        $result=mysqli_query($conn,$sql);
        header("location:scheduleView.php?sucessDelete");
        exit();
    }
    else{
        header("location:scheduleView.php");
        exit();
    }
}
else{
    header("location:signin.php");
    exit();
}
