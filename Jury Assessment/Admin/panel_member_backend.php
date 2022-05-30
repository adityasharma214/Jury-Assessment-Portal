<?php
include("connect.php");

$name = mysqli_real_escape_string($conn, $_POST['name']);
$school = mysqli_real_escape_string($conn, $_POST['school']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$type = mysqli_real_escape_string($conn, $_POST['type']);

echo $name;

if (mysqli_query($conn, "INSERT INTO `panel`(`panel_id`, `Name`, `School`, `Contact`, `Password`, `Type`) VALUES ('','" . $name . "','" . $school . "','" . $contact . "','" . $password . "', '" . $type . "');")) {
    echo '- Added to Database';
} else {
    echo "Error: " . $sql . "" . mysqli_error($conn);
}


$user_name = explode(" ", $name);
$email =strtolower($user_name[0].'.'.$user_name[1].'@avantika.edu.in');
echo $email;

if(mysqli_query($conn, "INSERT INTO `user`(`user_id`, `Fname`, `Lname`, `Email`, `P_number`, `passsword`, `type`) VALUES ('','$user_name[0]','$user_name[1]','$email','$contact','$password','')"))
{
    echo "Added to User Table";
} else{
    echo "Error: ";
}
mysqli_close($conn);
