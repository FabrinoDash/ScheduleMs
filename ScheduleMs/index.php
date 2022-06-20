<?php
include "header.php";
?>

<div class="text">
    <strong>DashCorp | Schedule management System</strong>: This system Designed in order to provide a user with the ability of Adding their tasks and Schedule at different time. <br>
    When starting registering be able to remember your Username and Password which can help you get access of your information that you added including your profile picture, Tasks and Schedules
</div>
<div class="footer">
    <p>
        Made by <strong>DashCorp</strong> <br>
        Email <strong>fabrino.corp@gmail.com</strong> <br>
        Contacts <strong>0768192810</strong> <br>
        <strong>DashCorp&copy;</strong><strong id="year"></strong>
        <script>
            const date = new Date();
            const year = date.getFullYear();
            const yearP = document.getElementById('year');
            yearP.innerHTML=year;
        </script>
    </p>
</div>