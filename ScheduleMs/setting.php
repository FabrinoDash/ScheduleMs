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

    <div class="settings">
        <a href="profile.php"><button>Edit Profile</button></a>
        <a href="pwdsetting.php"><button>Change Password</button></a>
    </div>
    
    <script src="js/setting.js"></script>
</body>
</html>

<?php
}
else{
    header("location:signin.php");
    exit();
}