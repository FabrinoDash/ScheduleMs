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
    if($_GET['error']=='exist') {
        ?>
        <div class="error">
            <p>User Exist: fullname, Email or Username</p>
        </div>
        <?php
    }
    if($_GET['error']=='inve') {
        ?>
        <div class="error">
            <p>Invalid Email</p>
        </div>
        <?php
    }
        if($_GET['error']=='invc') {
        ?>
        <div class="error">
            <p>Invalid Contact</p>
        </div>
        <?php
    }
}
// END OF DISPLAYING ERRORS
?>

<form action="signup.php" method="POST" class="SignupForm">
    <p class="formHeader">Register Here</p>
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
if (isset($_POST['submit'])) {
    include "connection.php";

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
        header("location:signup.php?error=inve");
        exit();
    }
    if (!preg_match("/^[0-9]*$/",$contact)) {
        header("location:signup.php?error=invc");
        exit();
    }
    if($password != $cpassword){
        header("location:signup.php?error=pwddm");
        exit();
    }
    // USER EXIST PROCESSING
    $newSql="SELECT * FROM dashcorpusers WHERE FullName='$fullname' OR Email='$email' OR Username='$username';";
    $newResult = mysqli_query($conn,$newSql);
    $resultData = mysqli_num_rows($newResult);
    if ($resultData>0) {
        header("location:signup.php?error=exist");
        exit();
    }
    // if($contact.ob_get_length()>10)

    // DIRECT DATA INSERTION TO DATABASE
/*
    $sql="INSERT INTO dashcorpusers(FullName, Email, Contacts, Nationality, City, Gender, Username, `Password`) VALUES('$fullname','$email','$contact','$nationality','$city','$gender','$username','$password');";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
        header("location:signup.php?error=FailedTosend");
        exit();
    }
    else{
        header("location:signup.php?error=none");
        exit();
    } 
*/

    // USING PREPARED STATEMENTS

    $sql="INSERT INTO dashcorpusers(FullName, Email, Contacts, Nationality, City, Gender, Username, `Password`) VALUES(?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
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