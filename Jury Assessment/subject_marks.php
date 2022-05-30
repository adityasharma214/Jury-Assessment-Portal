<?php
session_start();
if (isset($_SESSION["uid"])) {
    //echo "session in progress";
    //header('location:index_with.php');
    include('./connect.php');
    $enroll = mysqli_real_escape_string($conn, $_POST['id']);
    $Student = "SELECT * FROM `student` WHERE `Enrollment_id` = '$enroll'";
    $student_run = mysqli_query($conn, $Student);
    $Student_data = mysqli_fetch_array($student_run);
    $query = "SELECT * FROM `registration` r, subject s WHERE r.Subject_id=s.Subject_id AND r.Enrollment_id='$enroll';";
    $run = mysqli_query($conn, $query);
    function get_recent()
    {
        global $run;
        if ($run == true) {
            while ($data = mysqli_fetch_assoc($run)) {

                include('Student_marks_scroll.php');
            }
        } else {
            echo "error";
        }
    }
} else {
    header('location:Login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jury Landing</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous">
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap 5.1 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />


</head>


<!-- NAVBAR-->
<nav class="navbar navbar-expand-lg py-3 navbar-light bg-light shadow-sm">
    <div class="container">
        <a href="#" class="navbar-brand">
            <!-- Logo Image -->
            <img src="Avantika_Logo.png" width="75" alt="" class="d-inline-block align-middle mr-2" />
            <!-- Logo Text -->
        </a>

        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbarSupportedContent" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
            </ul>
            <h5 style="margin-left: 15%">Jury Assessment Portal</h5>
            <!-- Facebook -->
            <i style="margin-left: 35%" class="fab fa-facebook-f"></i>

            <!-- Twitter -->
            <i style="margin-left: 1%" class="fab fa-twitter"></i>

            <!-- Google -->
            <i style="margin-left: 1%" class="fab fa-google"></i>

            <!-- Instagram -->
            <i style="margin-left: 1%" class="fab fa-instagram"></i>

            <!-- Linkedin -->
            <i style="margin-left: 1%" class="fab fa-linkedin-in"></i>

            <!-- Pinterest -->
            <i style="margin-left: 1%" class="fab fa-pinterest"></i>
        </div>
        <!-- Small modal -->
        <a href="session_end.php">
            <button class="btn" data-toggle="modal" data-target=".bs-example-modal-sm">
                Logout
            </button>
        </a>
        <div class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Logout <i class="fa fa-lock"></i></h4>
                    </div>
                    <div class="modal-body">
                        <i class="fa fa-question-circle"></i> Are you sure you want to
                        log-off?
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-primary btn-block">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Small modal -->
    </div>
</nav>
<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<body oncontextmenu="false" class="snippet-body">
    <h5 style="margin-top: 3%; margin-left: 43px; margin-bottom: 20px; color:#737474"> <?php echo $Student_data['Name'] . '-' . $Student_data['Enrollment_id']  ?></h5>
    <form action="" method="post">
        <div class="container-fluid">
            <div class="row" style="margin-left: 20px; margin-right: 20px; margin-top: 20px">
                <?php get_recent(); ?>

            </div>
        </div>

        <div class="text-center" style="padding-top: 10px;">
            <button id="marks" type="submit" class="btn btn-success" style="margin-right: 20px;"> Next </button>
        </div>
    </form>
    <?php
    include('connect.php');
    $enroll = mysqli_real_escape_string($conn, $_POST['id']);
    foreach ($_REQUEST['data'] as $data) {
        $insert_row = $conn->query("INSERT INTO `grades`(`Grades_id`, `Marks_id`, `Rubrics_id`, `Marks`, `Enrollment_id`) VALUES ('','','','$data','$enroll')");
        if ($insert_row) {
            print 'Success! ID of last inserted record is : ' . $conn->insert_id . '<br />';
        }
    }
    ?>

</body>


</html>
<style>
    .center {
        font-family: arial;
        font-size: 24px;
        margin: 25px;
        width: fit-content;
        height: fit-content;

        /* Setup */
        position: relative;
    }
</style>