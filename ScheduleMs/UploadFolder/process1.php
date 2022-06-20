<?php
if (isset($_POST['uploadPic']) && isset($_FILES['myImage'])) {
    $tmpName=$_FILES['myImage']['tmp_name'];
    $fileName=$_FILES['myImage']['name'];
    $fileSize=$_FILES['myImage']['size'];
    $fileError=$_FILES['myImage']['error'];
    $fileType=$_FILES['myImage']['type'];

    if (empty($fileName)) {
        header("location:index.php?error=empty");
        exit();
    }
    if ($fileError === 0) {
        if ($fileSize < 10240000) {
            $fileExt = pathinfo($fileName,PATHINFO_EXTENSION);
            $lowerExt = strtolower($fileExt);
            $allowedExt = array("jpg","jpeg","png");

            if(in_array($lowerExt,$allowedExt)){
                $newName = uniqid("DashCorp-",true).'.'.$lowerExt;
                $uploadPath = 'Upload/'.$newName;
                move_uploaded_file($tmpName,$uploadPath);

                include_once "folderConnection.php";
                $sql="INSERT INTO images(image_url) VALUES('$newName');";
                $result = mysqli_query($conn,$sql);
                if ($result) {
                    header("location:index.php?SuccessfullUploaded");
                    exit();
                }
                else{
                    header("location:index.php?ServerError");
                    exit();
                }

            }
            else{
                header("location:index.php?error=FileNotAllowed");
                exit();
            } 
        }
        else{
            header("location:index.php?error=fileTooBig");
            exit();
        }
    }
    else{
        header("location:index.php?error=fileError");
        exit();
    }
}
else{
    header("location:index.php");
    exit();
}