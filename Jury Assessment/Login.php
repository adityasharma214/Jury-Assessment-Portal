<?php
session_start();
if (isset($_SESSION["uid"])) {
    header("location:Jury Landing.php");
}
?>
<?php
include("./connect.php");
if (isset($_POST["btn"])) {
    $username = $_POST["mail"];
    $password = $_POST["pass"];
    $query = "SELECT `user_id`, `Fname`, `Lname`, `Email`, `P_number` FROM `user` WHERE `Email`= '$username' AND `passsword`= '$password'";
    $run = mysqli_query($conn, $query);
    //$data= mysqli_fetch_assoc($run);
    $row = mysqli_num_rows($run);
    echo $row;
    if ($row < 1) {
        ?>
        <script>
            alert("LOGIN FAILED - Invalid Login or Password");
            window.open("login.php", "_self");
        </script>
<?php
    } else {
        $data = mysqli_fetch_assoc($run);
        $id = $data["user_id"];
        echo "id=" . $id;
        session_start();
        $_SESSION["uid"] = $id;
        header("location:Jury Landing.php");
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Jury Login</title>
  </head>
  <body style="background-repeat: no-repeat; 
  background-image: url(orange.jpg);
   position: relative; 
   background-size: cover;">
    <section class="vh-100">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
              <div class="row g-2">
                <div class="col-md-5 col-lg-5 d-none d-md-block">
                  <img
                    src="login_image.png"
                    alt="login form"
                    class="img-fluid" style=" width: 600px; height: 400px; margin-top: auto;margin-bottom: auto; margin-top: 25%; "

                  />
                </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">
    
                    <form name="Login" action="login.php" onsubmit="return validate(this) " method="Post">
    
                      <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0">Jury Assessment Portal</span>
                      </div>
    
                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
    
                      <div class="form-outline mb-4">
                        <input type="email" id="form2Example17" class="form-control form-control-lg" name="mail" value="" required />
                        <label class="form-label" for="form2Example17">Email address</label>
                      </div>
    
                      <div class="form-outline mb-4">
                        <input type="password" id="form2Example27" class="form-control form-control-lg" name="pass" value="" required />
                        <label class="form-label" for="form2Example27">Password</label>
                      </div>
    
                      <div class="pt-1 mb-4">
                        <button class="btn btn-dark btn-lg btn-block" name="btn" value="Sign In" type="submit">Login</button>
                      </div>
    
                      <a class="small text-muted" href="#!">Forgot password?</a>
                      <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!" style="color: #393f81;">Register here</a></p>
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>