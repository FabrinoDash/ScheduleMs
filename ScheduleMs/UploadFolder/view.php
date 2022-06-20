<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="../logo/DashCorpLogo2.png">
    <style>
        body{
            padding: 0;
            margin: 0;
        }
        .imageDiv{
            width: 400px;
            height: 400px;
            /* background: orange; */
            border: 5px solid gray;
            border-radius: 10px;
            overflow: hidden;
            background:linear-gradient(to right,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black,orange,black);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main{
            display: grid;
            grid-template-columns: auto auto;
            grid-gap: 30px;
            margin: auto;
            width: 900px;
        }
    </style>
</head>
<body>
    <a href="index.php" style="text-align: center; text-decoration:none;">&#8592; INSERT PICTURE</a> <br><br>
    <div class="main">
        <?php
        include_once "folderConnection.php";
        $sql="SELECT * FROM images ORDER BY id DESC;";
        $result = mysqli_query($conn,$sql);
        $resultData= mysqli_num_rows($result);
        if($resultData>0){
            while($row=mysqli_fetch_assoc($result)){?>
                <div class="imageDiv">
                    <img src="Upload/<?php echo $row['image_url'] ?>" width="300px" height="300px">
                </div>
    <?php }
        }
        else{
            echo "<h1>Nothing To see Here</h1>";
        }
        ?>
    </div>
    
</body>
</html>