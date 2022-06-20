<?php
    include "header.php";


// DISPLAYING ERRORS

if(isset($_GET['error'])) {
    if($_GET['error']=='empty') {
        ?>
        <div class="error">
            <p>Please Fill all the field</p>
        </div>
        <?php
    }
    if($_GET['error']=='wrongUsername') {
        ?>
        <div class="error">
            <p>Incorect Username and Password</p>
        </div>
        <?php
    }
    if($_GET['error']=='wrongPwd') {
        ?>
        <div class="error">
            <p>Incorect Password</p>
        </div>
        <?php
    }
    if($_GET['error']=='none') {
        ?>
        <div class="success">
            <p>Successfully Registered</p>
        </div>
        <?php
    }
}
// END OF DISPLAYING ERRORS
?>

<form action="" method="POST" class="SigninForm">
    <p class="formHeader">Login Here</p>
    <input type="text" name="uname" placeholder="Username or Email"> <br><br>
    <input type="password" name="pwd" placeholder="Enter Password"> <br><br>
    <button type="submit" name="submit">Signin</button>
</form>

<?php
if (isset($_POST['submit'])) {

    include "connection.php";

    $username = $_POST['uname'];
    $password = $_POST['pwd'];

    if ($username=="" || $password=="") {
        header("location:signin.php?error=empty");
        exit();
    }

    $sql = "SELECT * FROM dashcorpusers WHERE Username ='$username' OR Email ='$username';";
    $result=mysqli_query($conn,$sql);
    $dataExist = mysqli_num_rows($result);
    if ($dataExist > 0) {
        $row = mysqli_fetch_array($result);
        $pwdHash = $row['Password'];
        $pwdCheck = password_verify($password,$pwdHash);
        if($pwdCheck == true){
            session_start();

            $_SESSION['uname'] = $row['Username'];
            $_SESSION['fname'] = $row['FullName'];
            $_SESSION['contact'] = $row['Contact'];
            $_SESSION['id'] = $row['UserId'];
            $_SESSION['nationality'] = $row['Nationality'];
            $_SESSION['city'] = $row['City'];
            $_SESSION['gender'] =$row['gender'];
            $_SESSION['timeRegistered'] =$row['TimeRegistered'];

            header("location:main.php");
            exit();
        }
        else{
            header("location:signin.php?error=wrongPwd");
            exit();
        }
    }
    else{
        header("location:signin.php?error=wrongUsername");
        exit();
    }
}

?>