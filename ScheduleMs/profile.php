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
    ?><link rel="stylesheet" href="css/profile.css"><?php
    $sql="SELECT * FROM dashcorpprofile WHERE UserId='$uid';";
    $result=mysqli_query($conn,$sql);
    $resultData=mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    if ($resultData===0) {?>
        <div class="profileArea">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="profilePic"> <br><br>
                <button type="submit" name="upload">Upload Profile</button>
            </form>
        </div><?php
        if (isset($_POST['upload'])) {

            $tmpName=$_FILES['profilePic']['tmp_name'];

            $imageName=$_FILES['profilePic']['name'];
            $imageError=$_FILES['profilePic']['error'];
            $imageSize=$_FILES['profilePic']['size'];
            $imageType=$_FILES['profilePic']['type'];

            $imageExt = pathinfo($imageName,PATHINFO_EXTENSION);
            $lowerExt = strtolower($imageExt);
            $allowedExtension = array("jpg","jpeg","png");

            if($imageName==""){
                header("location:profile.php?error=empty");
                exit();
            }

            if ($imageError === 0) {
                if ($imageSize<10240000) {
                    if (in_array($lowerExt,$allowedExtension)) {
                        // $newName = uniqid("DashCorp$uid-",true).'.'.$lowerExt;
                        $newName ="DashCorp$uid".'.'.$lowerExt;
                        $uploadPath = 'img/profile/'.$newName;
                        move_uploaded_file($tmpName,$uploadPath);

                        // INSERTING PROFILE NAME TO DATABASE

                        $sql2 = "INSERT INTO dashcorpprofile(userId,ProfileImage) VALUES('$uid','$newName');";
                        $result = mysqli_query($conn,$sql2);
                        if ($result) {
                            header("location:profile.php?error=succesUpload");
                            exit();
                        }
                    }
                    else{
                        header("location:profile.php?error=FileTypeNotAllowed");
                        exit();
                    }
                }
                else{
                    header("location:profile.php?error=FileTooBig");
                    exit();
                }
            }
            else{
                header("location:profile.php?error=unknownError");
                exit();
            }
        }
    }
    else{
        // Displaying profile
        $sql="SELECT * FROM dashcorpprofile WHERE UserId='$uid';";
        $result=mysqli_query($conn,$sql);
        $resultData = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        if (isset($_GET['error'])) {
            if($_GET['error']=='empty') {
                ?>
                <div class="error">
                    <p>Please Select Image</p>
                </div>
                <?php
            }
            if($_GET['error']=='succesUpdate') {
                ?>
                <div class="success">
                    <p>Successfully Updated</p>
                </div>
                <?php
            }
            if($_GET['error']=='succesUpload') {
                ?>
                <div class="success">
                    <p>Successfully Uploaded</p>
                </div>
                <?php
            }
        }
        if ($resultData>0) {?>
            <div class="imageProfile">
                <img src="img/profile/<?php echo $row['ProfileImage'] ?>">
            </div><?php
        }?>
        
        <div class="profileArea">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="profilePic"> <br><br>
                <button type="submit" name="update">Update Profile</button>
            </form>
        </div><?php
        if (isset($_POST['update'])) {

            $tmpName=$_FILES['profilePic']['tmp_name'];

            $imageName=$_FILES['profilePic']['name'];
            $imageError=$_FILES['profilePic']['error'];
            $imageSize=$_FILES['profilePic']['size'];
            $imageType=$_FILES['profilePic']['type'];

            $imageExt = pathinfo($imageName,PATHINFO_EXTENSION);
            $lowerExt = strtolower($imageExt);
            $allowedExtension = array("jpg","jpeg","png");
            
            if($imageName==""){
                header("location:profile.php?error=empty");
                exit();
            }
            if ($imageError === 0) {
                if ($imageSize<10240000) {
                    if (in_array($lowerExt,$allowedExtension)) {
                        // $newName = uniqid("DashCorp$uid-",true).'.'.$lowerExt;
                        $newName ="DashCorp$uid".'.'.$lowerExt;
                        $uploadPath = 'img/profile/'.$newName;
                        move_uploaded_file($tmpName,$uploadPath);

                        // INSERTING PROFILE NAME TO DATABASE
                        $sql2 = "UPDATE dashcorpprofile SET ProfileImage='$newName' WHERE UserId='$uid';";
                        $result = mysqli_query($conn,$sql2);
                        if ($result) {
                            header("location:profile.php?error=succesUpdate");
                            exit();
                        }
                    }
                    else{
                        header("location:profile.php?error=FileTypeNotAllowed");
                        exit();
                    }
                }
                else{
                    header("location:profile.php?error=FileTooBig");
                    exit();
                }
            }
            else{
                header("location:profile.php?error=unknownError");
                exit();
            }
        }
    }
}
else{
    header("location:signin.php");
    exit(); 
}