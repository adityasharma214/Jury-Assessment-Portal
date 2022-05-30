<?php
        include('connect.php');

        //Output any connection error
        if ($conn->connect_error) {
            die('Error : (' . $conn->connect_errno . ') ' . $conn->connect_error);
        }

        $capture_field_vals = "";
        if (isset($_POST["data"]) && is_array($_POST["data"])) {
            $capture_field_vals = implode(",", $_POST["data"]);
            echo $capture_field_vals;
        }

        //MySqli Insert Query
        $insert_row = $conn->query("INSERT INTO `grades`(`Grades_id`, `Marks_id`, `Rubrics_id`, `Marks`, `Enrollment_id`) VALUES ('','1','1','$capture_field_vals','$enroll')");

        if ($insert_row) {
            print 'Success! ID of last inserted record is : ' . $conn->insert_id . '<br />';
        }
        ?>