<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FolderUpload</title>
    <link rel="shortcut icon" href="../logo/DashCorpLogo2.png">
    <style>body{padding: 0;margin: 0;background: gray;}form{margin: auto;width: 500px; background-color: silver;text-align: center;padding: 10px 0;}</style>
</head>
<body>
    <form action="process1.php" method="POST" enctype="multipart/form-data">
        <?php
        if (isset($_GET['error'])) {
            echo "<p style='color:red'>Error</p>";
        }
        ?>
        <input type="file" name="myImage"><br><br>
        <button type="submit" name="uploadPic">Upload</button> <br><br>
        <a href="view.php">View Uploaded Picture</a>
    </form>
</body>
</html>