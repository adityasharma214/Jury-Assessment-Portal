<?php
$connect = mysqli_connect("localhost", "root", "", "webproject");
session_start();
if (isset($_SESSION["uid"])) {
    //header("location:admin_index.php");
} else {
    header('location:Login.php');
}


include("connect.php");
$uidd = $_SESSION["uid"];
$user = "SELECT * FROM `user` WHERE `user_id`='$uidd';";
$user_results = $conn->query($user);
$user_row = $user_results->fetch_assoc();

$Panel_member = $user_row['Fname'] . ' ' . $user_row['Lname'];


$SQL = "SELECT Name, Enrollment, Time FROM `scheduled` WHERE `Jury_pannel`='$Panel_member' AND Date=CURDATE();";
$result = $conn->query($SQL);
$sql_count = "SELECT Name, Enrollment, Time FROM `scheduled` WHERE `Jury_pannel`='$Panel_member' AND Date=CURDATE()";
$count_result = $conn->query($sql_count);
$panel = "SELECT `Internal`, `Internal_2` FROM `scheduled` WHERE `Jury_pannel`='$Panel_member' AND `Date` = CURDATE() LIMIT 1;";
$panel_result = $conn->query($panel);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jury Landing</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</head>

<body style="
      background-repeat: no-repeat;
      background-image: url(orange.jpg);
      position: relative;
      background-size: cover;
      backdrop-filter: blur(2px);
    ">
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

    <h5 style="margin-left: 5%; margin-top: 2%; color: azure">
        Number of Students - <?php $count_stu = 0;
                                while ($rows = $count_result->fetch_assoc()) {
                                    $count_stu = $count_stu + 1;
                                }
                                echo $count_stu; ?>
    </h5>
    <h5 style="margin-left: 5%; color: azure">Jury Panel - <?php echo $Panel_member; ?> </h5>
    <h5 style="margin-left: 5%; color: azure">Internal Panel - <?php
                                                                while ($rows = $panel_result->fetch_assoc()) {
                                                                    echo $rows['Internal'] . ", " . $rows['Internal_2'];
                                                                } ?> </h5>
    <div style="margin-top: 5%; margin-left: 5%; margin-right: 5%;">
        <table class="table table-light table-bordered border-dark">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Enrollment</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

                while ($rows = $result->fetch_assoc()) {

                    $count = $count + 1;
                ?>
                    <tr data-userid="<?php echo $rows['Enrollment']; ?>" data-name="<?php echo $rows['Name']; ?>">
                        <th scope="row"><?php echo $count; ?></th>

                        <td><?php echo $rows['Name']; ?></td>
                        <td><?php echo $rows['Enrollment']; ?></td>
                        <td><?php echo $rows['Time']; ?></td>
                        <td style="align-items: center;"><button id="student_details" type="button" class="btn btn-danger">Start</button></td>
                    </tr>
                <?php
                }

                ?>
            </tbody>
        </table>
        <form id="tags-form" method="POST" action="subject_marks.php">
            <input type="hidden" name="id" id="id-input">
        </form>

    </div>
</body>
<script>
    $("body").on("click", "#student_details", function() {

        var userid = $(this).parents("tr").attr('data-userid');
        var name = $(this).parents("tr").attr('data-name');
        console.log(userid);
        console.log(name);
        $("#id-input").val(userid);
        $("#tags-form").submit();

    });
</script>

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

    td {
        text-align: center;
    }

    tr {
        text-align: center;
    }
</style>