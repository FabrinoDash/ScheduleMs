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

    if (isset($_GET['tid'])) {
        $tid=$_GET['tid'];
        $sql="DELETE FROM dashcorptask WHERE TaskId='$tid';";
        $result=mysqli_query($conn,$sql);
        header("location:taskView.php?sucessDelete");
        exit();
    }
    else{
        header("location:taskView.php");
        exit();
    }
}
else{
    header("location:signin.php");
    exit();
}
