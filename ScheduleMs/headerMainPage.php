<?php
ob_start();
    session_start();
    include_once "connection.php";

    $_SESSION['uname'];
    $_SESSION['fname'];
    $_SESSION['contact'];
    $uid = $_SESSION['id'];
    $_SESSION['nationality'];
    $_SESSION['city'];
    $_SESSION['gender'];
    $_SESSION['timeRegistered'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/FontAwesome/all.min.css">
    <link rel="shortcut icon" href="./logo/DashCorpLogo2.png">
    <title>DashCorp | ScheduleMs</title>
</head>
<body>
    <div class="header">
        <div class="logo">DashCorp<br>ScheduleMS</div>
        <div class="nav">
            <a href="main.php"><li><i class='fas fa-home'></i>&nbsp;Home</li></a>
            <a href="setting.php"><li><i class="fas fa-cog"></i>&nbsp;Setting</li></a>
            <a href="logout.php"><li><i class='fas fa-sign-out-alt'></i>&nbsp;Logout</li></a>
        </div>
        <div class="profileWelcome">
            <div class="welcome">
                Hi: <strong><?php echo $_SESSION['uname'];?></strong>
            </div>
            <a href="profile.php">
                <div class="profile">
<?php
ob_start();
$sql="SELECT * FROM dashcorpprofile WHERE UserId='$uid';";
$result=mysqli_query($conn,$sql);
$resultData = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($resultData>0) {?>
    <img src="img/profile/<?php echo $row['ProfileImage'] ?>" style='width:50px;height:50px;'><?php
}
else{
    echo "<i class='fa fa-user'></i>";
}
ob_end_flush();
?></div>
</a>
</div>
</div>