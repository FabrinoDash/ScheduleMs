<?php
    include_once "headerMainPage.php";

if (isset($_SESSION['uname'])) {
    ?>
<div class="passwordSetting" id="pwdDiv">
    <link rel="stylesheet" href="css/app.css">
    <?php
        if (isset($_GET['pwddm'])) {
            ?>
                <div class="success">
                    <p>Password Don't Match</p>
                </div>
            <?php
        }
        if (isset($_GET['wcp'])) {
            ?>
                <div class="error">
                    <p>Wrong Current Password</p>
                </div>
            <?php
        }
        if (isset($_GET['empty'])) {
            ?>
                <div class="error">
                    <p>Field can't be Empty</p>
                </div>
            <?php
        }
    ?>
        <form action="" method="POST">
            <input type="password" placeholder="Current Password" name="cupwd"> <br><br>
            <input type="password" placeholder="New Password" name="npwd"> <br><br>
            <input type="password" placeholder="Confirm New Password" name="cnpwd"> <br><br>
            <a href="setting.php"><button>Cancel</button></a>
            <button type="submit" name="updatepwd">Save Changes</button>
        </form>

        <?php
            if(isset($_POST['updatepwd'])){
                include "connection.php";

                $currentPwd=$_POST['cupwd'];
                $newPwd=$_POST['npwd'];
                $confirmPwd=$_POST['cnpwd'];

                $sql = "SELECT * FROM dashcorpusers WHERE UserId=$uid;";
                $result1 = mysqli_query($conn,$sql);
                $row1=mysqli_fetch_array($result1);

                $pwdHash = $row1['Password'];
                $pwdCheck = password_verify($currentPwd,$pwdHash);

                if ($currentPwd =="" || $newPwd=="" || $confirmPwd=="") {
                    header("location:pwdsetting.php?empty");
                    exit();
                }
                elseif ($pwdCheck==false) {
                    header("location:pwdsetting.php?wcp");
                    exit();
                }
                elseif($newPwd != $confirmPwd){
                    header("location:pwdsetting.php?pwddm");
                    exit();
                }
                elseif($pwdCheck==true){
                    $newHashPwd=password_hash($newPwd,PASSWORD_DEFAULT);
                    $sql2="UPDATE dashcorpusers SET Password='$newHashPwd' WHERE UserId=$uid;";
                    mysqli_query($conn,$sql2);
                    session_unset();
                    session_destroy();
                    header("location:signin.php");
                    exit(); 
                }
            }
        ?>
    </div>
<?php
}
else{
    header("location:signin.php");
    exit(); 
}