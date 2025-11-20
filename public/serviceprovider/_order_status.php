<?php
include '../db/dbconnect.php';
session_start();

// if (isset($_GET['approve']) && isset($_GET[''])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // APPROVE BUTTON PRESS CODE
    if (isset($_POST['approve'])) {
        $hire_id = $_POST['hire_id'];
        $sp_id = $_POST['sp_id'];
        $status = $_POST['status'];
        $service_id = $_POST['service_id'];

        $sql1 = "UPDATE `hire_service` SET `status` = 'inprogress' WHERE `hire_service`.`hire_id` = $hire_id AND `hire_service`.`service_id` = $service_id AND `hire_service`.`sp_id` = $sp_id";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1) {
            $_SESSION['status_done'] = "Hire Approved.";
            header("location: hire_details.php?hire_id= $hire_id &sp_id= $sp_id");
        } else {
            $_SESSION['status_undone'] = "Hire not Approved.";
            header("location: hire_details.php?hire_id= $hire_id &sp_id= $sp_id");
        }
    }


    // REJECT BUTTON PRESS CODE
    if (isset($_POST['reject'])) {
        $hire_id = $_POST['hire_id'];
        $sp_id = $_POST['sp_id'];
        $status = $_POST['status'];
        $service_id = $_POST['service_id'];

        $sql2 = "UPDATE `hire_service` SET `status` = 'rejected' WHERE `hire_service`.`hire_id` = $hire_id AND `hire_service`.`service_id` = $service_id AND `hire_service`.`sp_id` = $sp_id";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            $_SESSION['status_done'] = "hire Rejected.";
            header("location: hire_details.php?hire_id= $hire_id &sp_id= $sp_id");
        } else {
            $_SESSION['status_undone'] = "hire not Rejected.";
            header("location: hire_details.php?hire_id= $hire_id &sp_id= $sp_id");
        }
    }

    
    // COMPLETED BUTTON PRESS CODE
    if (isset($_POST['completed'])) {
        $hire_id = $_POST['hire_id'];
        $sp_id = $_POST['sp_id'];
        $status = $_POST['status'];
        $service_id = $_POST['service_id'];

        $sql3 = "UPDATE `hire_service` SET `status` = 'completed' WHERE `hire_service`.`hire_id` = $hire_id AND `hire_service`.`service_id` = $service_id AND `hire_service`.`sp_id` = $sp_id";
        $result3 = mysqli_query($conn, $sql3);
        if ($result3) {
            $_SESSION['status_done'] = "Hired Completed.";
            header("location: hire_details.php?hire_id= $hire_id &sp_id= $sp_id");
        } else {
            $_SESSION['status_undone'] = "Hire not Completed.";
            header("location: hire_details.php?hire_id= $hire_id &sp_id= $sp_id");
        }
    }

    //UNCOMPLETED BUTTON PRESS CODE
    if (isset($_POST['uncompleted'])) {
        $hire_id = $_POST['hire_id'];
        $sp_id = $_POST['sp_id'];
        $status = $_POST['status'];
        $service_id = $_POST['service_id'];

        $sql4 = "UPDATE `hire_service` SET `status` = 'uncompleted' WHERE `hire_service`.`hire_id` = $hire_id AND `hire_service`.`service_id` = $service_id AND `hire_service`.`sp_id` = $sp_id";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4) {
            $_SESSION['status_done'] = "Hire Uncompleted.";
            header("location: hire_details.php?hire_id= $hire_id &sp_id= $sp_id");
        } else {
            $_SESSION['status_undone'] = "Hire not Uncompleted.";
            header("location: hire_details.php?hire_id= $hire_id &sp_id= $sp_id");
        }
    }



}


