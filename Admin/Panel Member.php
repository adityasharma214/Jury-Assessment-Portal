<?php
$connect = mysqli_connect("localhost", "root", "", "webproject");
session_start();
if (isset($_SESSION["uid"])) {
    //header("location:admin_index.php");
} else {
    header('location:Login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel Member</title>
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
  <a href="Schedule.php"><i class="fa fa-fw fa-calendar"></i> Schedule</a>
  <a href="Marks&Feedback.php"><i class="fa fa-file"></i> Marks/Feedback</a>
  <a href="Result.php"><i class="fa fa-fw fa-bar-chart"></i> Result</a>
  <a class="active" href="Panel Member.php"><i class="fa fa-id-card"></i> Panel Member</a>
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
    Panel Member
  </h1>
  <form action="Panel Member.php" method="post">
    <div class="row g-2" style="
          border: #000000;
          padding-left: 15%;
          padding-right: 15%;
          padding-top: 2%;
        ">
      <div class="col-md">
        <label for="exampleInputEmail1" class="form-label">Panel Name</label>
        <input required type="text" name="name" id="name" class="form-control" aria-describedby="emailHelp" />

        <div style="padding-top: 20px">
          <label for="exampleInputEmail1" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" aria-describedby="emailHelp" required />
        </div>
        <div class="form-floating" style="margin-top: 20px;">
          <select required name="type" id="type" class="form-select" aria-label="Floating label select example">
            <option disabled>---Select Panel Type---</option>
            <option value="Internal">Internal</option>
            <option value="External">External</option>

          </select>
          <label for="floatingSelectGrid">School</label>
        </div>
      </div>
      <div class="col-md" style="padding-top: 10px;">
        <div class="form-floating">
          <select required name="school" id="school" class="form-select" aria-label="Floating label select example">
            <option disabled>---Select School---</option>
            <option value="School of Engineering">School of Engineering</option>
            <option value="School of Design">School of Design</option>

          </select>
          <label for="floatingSelectGrid">School</label>
        </div>

        <div style="padding-top: 20px;">
          <label for="exampleInputEmail1" class="form-label">Contact </label>
          <input required type="number" name="contact" maxlength="10" placeholder="7898888293" pattern="[0-9]{3} [0-9]{3} [0-9]{4}" id="contact" class="form-control" aria-describedby="emailHelp" />
        </div>
      </div>
    </div>
    <div class="text-center" style="padding-top: 20px">
      <button type="submit" id="panel_submit" class="btn btn-success me-2" style="align-items: center">
        Submit
      </button>
    </div>
  </form>
  <script>
    $(document).ready(function() {

      $("#panel_submit").click(function() {

        var name = $("#name").val();
        var school = $("#school").val();
        var password = $("#password").val();
        var contact = $("#contact").val();
        var type = $('#type').val();

        if (name == '' || school == '' || password == '' || contact == '' || type == '') {
          alert("Please fill all fields.");
          alert(thrownError);
        } else {
          $.ajax({
            type: "POST",
            url: "panel_member_backend.php",
            data: {
              name: name,
              school: school,
              password: password,
              contact: contact,
              type: type
            },
            cache: false,
            success: function(data) {
              alert(data);
            },
            error: function(xhr, status, error) {
              console.error(xhr);
            }
          });
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