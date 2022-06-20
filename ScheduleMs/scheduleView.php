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
?><link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="css/schedule.css">
        <?php
            if(isset($_GET['added'])) {
                ?>
                <div class="success">
                    <p>Successfully Added</p>
                </div>
                <?php
            }
            if(isset($_GET['sucessDelete'])) {
                ?>
                <div class="success">
                    <p>Successfully Deleted</p>
                </div>
                <?php
            }
        ?>
        <div class="app">
            <div class="appHeader">
                    <a href="task.php">Add Tasks<li></li></a>
                    <a href="schedule.php">Add Schedule<li></li></a>
            </div>
            <div class="content">
                <?php
                    $sql1 = "SELECT * FROM dashcorpschedule WHERE UserId=$uid ORDER BY schedule_date ASC;";
                    $result = mysqli_query($conn,$sql1);
                    while($row=mysqli_fetch_array($result)){
                        ?>
                            <div class="taskDiv">
                                <div class="trueDiv">
                                    <div class="mainContent">
                                        <p><strong>Title:</strong> <?php echo $row['schedule_title'] ?> </p>
                                        <p><strong>Details:</strong> <?php echo $row['schedule_detail'] ?> </p>
                                        <p><strong>Location:</strong> <?php echo $row['schedule_location'] ?> </p>
                                    </div>

                                    <div class="timeDiv">
                                        <?php $sid=$row['ScheduleId'] ?>
                                        <p><strong>Date:</strong>  <?php echo $row['schedule_date'] ?></p>
                                        <p><strong>From</strong> <?php echo $row['schedule_start_time'] ?> to <?php echo $row['schedule_end_time'] ?></p>
                                        <p><div class="timeCounter"><p id='days<?php echo $sid ?>' style="color:red;"></p>d<p id='hours<?php echo $sid ?>' style="color:red;"></p>h<p id='minutes<?php echo $sid ?>' style="color:red;"></p>m<p id='seconds<?php echo $sid ?>' style="color:red;"></p>s</div></p> 
                                        
                                        <script>
                                            const notification<?php echo $sid ?> = document.getElementById('not<?php echo $sid?>');
                                            const days<?php echo $sid ?> = document.getElementById('days<?php echo $sid ?>');
                                            const hours<?php echo $sid ?> = document.getElementById('hours<?php echo $sid ?>');
                                            const minutes<?php echo $sid ?> = document.getElementById('minutes<?php echo $sid ?>');
                                            const seconds<?php echo $sid ?> = document.getElementById('seconds<?php echo $sid ?>');
                                            const timeCounter<?php echo $sid ?> = document.getElementsByClassName('timeCounter<?php echo $sid ?>');

                                            function setCountdown(){
                                                const currentTime<?php echo $sid ?> = new Date();
                                                const scheduleTime<?php echo $sid ?> = new Date("<?php echo $row['schedule_date']." ".$row['schedule_start_time']; ?>");
                                                const diff<?php echo $sid ?> = scheduleTime<?php echo $sid ?> - currentTime<?php echo $sid ?>;
                                                // CALCULATION OF REMAINING TIME
                                                const d<?php echo $sid ?> = Math.floor(diff<?php echo $sid ?>/1000/60/60/24);
                                                const h<?php echo $sid ?> = Math.floor(diff<?php echo $sid ?>/1000/60/60)%24;
                                                const m<?php echo $sid ?> = Math.floor(diff<?php echo $sid ?>/1000/60)%60;
                                                const s<?php echo $sid ?> = Math.floor(diff<?php echo $sid ?>/1000)%60;

                                                days<?php echo $sid ?>.innerHTML=d<?php echo $sid ?>;
                                                hours<?php echo $sid ?>.innerHTML=h<?php echo $sid ?> < 10? "0" +h<?php echo $sid ?>:h<?php echo $sid ?>;
                                                minutes<?php echo $sid ?>.innerHTML=m<?php echo $sid ?> < 10 ? "0" + m<?php echo $sid ?>:m<?php echo $sid ?>;
                                                seconds<?php echo $sid ?>.innerHTML=s<?php echo $sid ?> <10 ? "0"+s<?php echo $sid ?>:s<?php echo $sid ?>;

                                                if (d<?php echo $sid ?> <= 0 && h<?php echo $sid ?> <= 0 && m<?php echo $sid ?> <= 0 && s<?php echo $sid ?> <= 0) {
                                                    days<?php echo $sid ?>.innerHTML="00";
                                                    hours<?php echo $sid ?>.innerHTML="00";
                                                    minutes<?php echo $sid ?>.innerHTML="00";
                                                    seconds<?php echo $sid ?>.innerHTML="00";
                                                    timeCounter<?php echo $sid ?>.innerHTML = "Completed";
                                                }
                                            }
                                            setInterval(setCountdown,1000);
                                        </script>
                                    </div>

                                    <div class="deleteDiv">
                                        <a href="deleteSchedule.php?schid=<?php echo $row['ScheduleId'] ?>"><i class="fa fa-close"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </body>
    </html>

<?php
}
else{
    header("location:signin.php");
    exit();
}
?>