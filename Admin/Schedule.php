<?php
$connect = mysqli_connect("localhost", "root", "", "webproject");
session_start();
if (isset($_SESSION["uid"])) {
    //header("location:admin_index.php");
} else {
    header('location:Login.php');
}
include("connect.php"); // Using database connection file here
$jury_panel = "SELECT Name FROM panel where type='External'";  // Use select query here 
$result = $conn->query($jury_panel);
$Internal_jury_panel = "SELECT Name FROM panel where type='Internal'";  // Use select query here 
$internal_result = $conn->query($Internal_jury_panel);
$Internal_jury_panel_2 = "SELECT Name FROM panel where type='Internal'";  // Use select query here 
$internal_result_2 = $conn->query($Internal_jury_panel_2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Schedule</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
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
      <h5 style="margin-left: 15%">Jury Assessment Portal</h5>
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
<!-- Load an icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<div class="navbar" style="padding-left: 20%; padding-right: 20%">
  <a class="active" href="Schedule.php"><i class="fa fa-fw fa-calendar"></i> Schedule</a>
  <a href="Marks&Feedback.php"><i class="fa fa-file"></i> Marks/Feedback</a>
  <a href="Result.php"><i class="fa fa-fw fa-bar-chart"></i> Result</a>
  <a href="Panel Member.php"><i class="fa fa-id-card"></i> Panel Member</a>
  <a href="Rubrics.php"><i class="fa fa-list-alt"></i> Rubrics</a>
</div>

<body style="
      background-repeat: no-repeat;
      background-color: #fff;
      position: relative;
      background-size: cover;
      backdrop-filter: blur(2px);
    ">
  <h1 style="
        /* Jury Scheduling */

        text-align: center;
        padding-top: 40px;
        font-size: 24px;
        color: #000;
        /* identical to box height */
      ">
    Jury Scheduling
  </h1>
  <form id="schedule">
    <div class="row g-2" style="
          border: #000000;
          padding-left: 15%;
          padding-right: 15%;
          padding-top: 2%;
        ">


      <div class="col-md">
        <div class="form-floating">
          <select required class="form-select" id="school" aria-label="Floating label select example">
            <option disabled>---Select School---</option>
            <option value="School of Engineering">School of Engineering</option>
            <option value="School of Design">School of Design</option>

          </select>
          <label for="floatingSelectGrid">School</label>
        </div>

        <div style="padding-top: 20px">
          <div class="form-floating">
            <select required class="form-select" id="branch" aria-label="Floating label select example">
              <option disabled>---Select Discipline---</option>
              <option value="Computer Science & Engineering">Computer Science & Engineering</option>
              <option value="UI/UX Design">UI/UX Design</option>
              <option value="Communication Design">Communication Design</option>
              <option value="Industrial Design">Industrial Design</option>
            </select>
            <label for="floatingSelectGrid">Discipline</label>
          </div>
        </div>

        <div style="padding-top: 20px">
          <div class="form-floating">
            <select required class="form-select" id="panel" aria-label="Floating label select example">
              <option disabled>---Select Jury Panel---</option>
              <?php
              while ($jury_panels = mysqli_fetch_array($result)) {; ?>
                <option value="<?php echo $jury_panels['Name']; ?>"><?php echo $jury_panels['Name']; ?></option>

              <?php  }; ?>
            </select>
            <label for="floatingSelectGrid">Panel Member</label>
          </div>
        </div>

        <div style="padding-top: 20px">
          <input type="date" id="date" required />
        </div>
      </div>
      <div class="col-md">
        <div class="form-floating">
          <select required class="form-select" id="semester" aria-label="Floating label select example">
            <option disabled>---Select Semester---</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
          </select>
          <label for="floatingSelectGrid">Semester</label>
        </div>
        <div style="padding-top: 20px">
          <div class="form-floating">
            <select required class="form-select" id="student" aria-label="Floating label select example">
              <option disabled>---Select number of Students---</option>
              <option value="0 8">1 - 8</option>
              <option value="8 16">9 - 16</option>
              <option value="16 24">17 - 24</option>
              <option value="24 32">25 - 32</option>
              <option value="32 40">33 - 40</option>
              <option value="40 48">41 - 48</option>
              <option value="48 56">49 - 56</option>
              <option value="56 64">57 - 64</option>
              <option value="64 72">65 - 72</option>
              <option value="72 80">73 - 80</option>
              <option value="80 88">81 - 88</option>
              <option value="88 96">89 - 96</option>
              <option value="96 104">97 - 104</option>
              <option value="104 112">105 - 112</option>
              <option value="112 120">113 - 120</option>
            </select>
            <label for="floatingSelectGrid">Students/Day</label>
          </div>
        </div>
        <div style="padding-top: 20px">
          <div class="form-floating">
            <select required class="form-select" id="internal"   aria-label="multiple select example">
              <option disabled>---Select Internal Jury Member---</option>
              <?php
              while ($internal_jury_panels = mysqli_fetch_array($internal_result)) {; ?>
                <option value="<?php echo $internal_jury_panels['Name']; ?>"><?php echo $internal_jury_panels['Name']; ?></option>

              <?php  }; ?>
            </select>
            <label for="floatingSelectGrid">Internal Member - 1</label>
          </div>
        </div>
        <div style="margin-top: 20px">
          <div class="form-floating" style="margin-bottom: 20px;">
            <select required class="form-select" id="internal_2"   aria-label="multiple select example">
              <option disabled>---Select Internal Jury Member---</option>
              <?php
              while ($internal_jury_panels_2 = mysqli_fetch_array($internal_result_2)) {; ?>
                <option value="<?php echo $internal_jury_panels_2['Name']; ?>"><?php echo $internal_jury_panels_2['Name']; ?></option>

              <?php  }; ?>
            </select>
            <label for="floatingSelectGrid">Internal Member - 2</label>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center">
      <button id="formsubmit" type="submit" class="btn btn-success me-2" style="align-items: center; margin: top 20px;">
        Submit
      </button>
    </div>
  </form>
  <script>
    $(document).ready(function() {

      $("#formsubmit").click(function() {

        var school = $("#school").val();
        var branch = $("#branch").val();
        var panel = $("#panel").val();
        var semester = $("#semester").val();
        var student = $("#student").val();
        var date = $("#date").val();
        var internal = $("#internal").val();
        var internal_2 = $("#internal_2").val();

        $.ajax({
          type: "POST",
          url: "Schedule_students.php",
          data: {
            school: school,
            branch: branch,
            panel: panel,
            semester: semester,
            student: student,
            date: date,
            internal: internal,
            internal_2:internal_2
          },
          cache: false,
          success: function(data) {
            alert(data);
          },
          error: function(xhr, status, error) {
            console.error(xhr);
          }
        });

        if (school == '' || branch == '' || panel == '' || semester == '' || student == '' || date == '' || time_interval == '' || internal == '' || internal_2 == '') {
          alert("Please fill all fields.");
          return false;
        }


      });

    });
  </script>
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

  td {
    text-align: center;
  }

  tr {
    text-align: center;
  }

  /* Style the navigation bar */
  .navbar {
    width: 100%;
    background-color: #e73b3b;
    overflow: auto;
  }

  /* Navbar links */
  .navbar a {
    float: left;
    text-align: center;
    padding: 12px;
    height: 50px;
    color: white;
    text-decoration: none;
    font-size: 18px;
  }

  /* Navbar links on mouse-over */
  .navbar a:hover {
    background-color: #000000;
  }

  /* Current/active navbar link */
  .active {
    background-color: #000000;
  }

  /* Add responsiveness - will automatically display the navbar vertically instead of horizontally on screens less than 500 pixels */
  @media screen and (max-width: 100px) {
    .navbar a {
      float: none;
      display: block;
    }
  }
</style>