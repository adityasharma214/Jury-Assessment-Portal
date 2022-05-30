<?php
include("connect.php");

$school = mysqli_real_escape_string($conn, $_POST['school']);
$branch = mysqli_real_escape_string($conn, $_POST['branch']);
$panel = mysqli_real_escape_string($conn, $_POST['panel']);
$semester = mysqli_real_escape_string($conn, $_POST['semester']);
$student = mysqli_real_escape_string($conn, $_POST['student']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$internal = mysqli_real_escape_string($conn, $_POST['internal']);
$internal_2 = mysqli_real_escape_string($conn, $_POST['internal_2']);

$student_per_day = explode(" ", $student);

$count=-1;
$dt1 = new DateTime('09:30 UTC');
$dt2 = new DateTime('17:30 UTC');

$values = array();
while ($dt1 <= $dt2) {
    $values[] = $dt1->format("('H:i')");
    $dt1->modify('+45 minute');
}



$SQL = "SELECT * FROM `student` WHERE `Semester`='$semester' AND `School`='$school' AND `Discipline`='$branch' LIMIT $student_per_day[0], $student_per_day[1];";
$result = mysqli_query($conn, $SQL);

while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $count+=1;
    $time_slot = $values[$count];
    $time_slot = trim($time_slot,"',',/,(,)");
    if (mysqli_query($conn, "INSERT INTO `scheduled`(`Schedule_id`,`Name`, `Enrollment`, `Jury_pannel`, `School`, `Discipline`, `Date`, `Time`, `Semester`, `Internal`, `Internal_2`, `Status`) 
    VALUES ('', '$row[1]','$row[0]','$panel','$school','$branch','$date','$time_slot','$semester', '$internal', '$internal_2', '0') ")) {
        echo 'Jury Scheduled:- '.$row[1] .PHP_EOL; 
    } else {
        echo "Error:-  Jury Already Scheduled".PHP_EOL;
    }
}


mysqli_close($conn);
