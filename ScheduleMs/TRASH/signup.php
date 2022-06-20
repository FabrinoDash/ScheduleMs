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
    if($_GET['error']=='FailedTosend' || $_GET['error']=='stmtfailed') {
        ?>
        <div class="error">
            <p>Something Went Wrong</p>
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
    if($_GET['error']=='pwddm') {
        ?>
        <div class="error">
            <p>Password Don't Match</p>
        </div>
        <?php
    }
    if($_GET['error']=='invEmail') {
        ?>
        <div class="error">
            <p>Invalid Email</p>
        </div>
        <?php
    }
    if($_GET['error']=='invContact') {
        ?>
        <div class="error">
            <p>Invalid Contact</p>
        </div>
        <?php
    }
    if($_GET['error']=='userexist') {
        ?>
        <div class="error">
            <p>User Exists</p>
        </div>
        <?php
    }
}
// END OF DISPLAYING ERRORS
?>

<form action="signup.php" method="POST" class="SignupForm">
    <p>Signup Here</p>
    <input type="text" name="fname" placeholder="Full name"> <br><br>
    <input type="text" name="email" placeholder="Email"> <br><br>
    <input type="text" name="contact" placeholder="Contact"> <br><br>
    <input type="text" name="nation" placeholder="Nationality"> <br><br>
    <input type="text" name="city" placeholder="City"> <br><br>
    <div class="genderDiv">
        <div class="male">
            <input type="radio" name="gender" value="M">&nbsp;&nbsp;Male
        </div>
        <div class="female">
        <input type="radio" name="gender" value="F">&nbsp;&nbsp;Female
        </div>
    </div>
    <br>
    <input type="text" name="uname" placeholder="Enter Username"> <br><br>
    <input type="password" name="pwd" placeholder="Enter Password"> <br><br>
    <input type="password" name="cpwd" placeholder="Confirm Password"> <br><br>
    <button type="submit" name="submit">Signup</button>
</form>

<!-- DATA PROCESSING -->

<?php
include "connection.php";
if (isset($_POST['submit'])) {

    $fullname = $_POST['fname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $nationality = $_POST['nation'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $username = $_POST['uname'];
    $password = $_POST['pwd'];
    $cpassword = $_POST['cpwd'];

    if ($fullname=="" || $email=="" || $contact=="" || $nationality=="" || $city=="" || $gender=="" || $username =="" || $password=="" ||$cpassword=="") {
        header("location:signup.php?error=empty");
        exit();
    }
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header("location:signup.php?error=invEmail");
        exit();
    }
    if (!preg_match("/^[0-9]*$/",$contact)) {
        header("location:signup.php?error=invContact");
        exit();
    }
    if($password != $cpassword){
        header("location:signup.php?error=pwddm");
        exit();
    }

    $sqlCheck = "SELECT * FROM dashcorpusers WHERE FullName='$fullname' OR Email='$email' OR Username='$username';";
    $result = mysqli_query($conn,$sqlCheck);
    $resultData = mysqli_num_rows($result);
    if($resultData>0){
        header("location:signup.php?error=userexist");
        exit();
    }
    $sql1 = "INSERT INTO dashcorpusers(FulName, Email, Contacts, Nationality, City, Gender, Username, `Password`) VALUES(?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql1)) {
        header("location:signup.php?error=stmtfailed");
        exit();
    }
    $pwdHash=password_hash($password,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"ssssssss",$fullname,$email,$contact,$nationality,$city,$gender,$username,$pwdHash);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:signin.php?error=none");
    exit();
}
?>