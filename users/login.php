<?php

session_start();

require_once "../App.php";
App::init();

$error = false;

$db = new Database();
$ur = new userRepository($db);

if (isset($_POST["username"], $_POST["password"])){

    $user = $ur->loginUsers($_POST["username"]);

    if (password_verify($_POST["password"], $user["password"] )) {

        unset($user["password"]);
        unset($user["2"]);
        $_SESSION["user"] = $user;

        session_regenerate_id();

        header("Location: ../index.php");

    } else {
        $error = true;
    }

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Přihlášení</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/ZF.png" />
  </head>

  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
                <!-- Functional part -->
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Přihlášení</h3>

                  <?php if ($error):?>
                      <p>
                          <strong>
                              Chybně zadané přihlačovací údaje
                          </strong>
                      </p>
                  <?php endif; ?>

                <form method="post">
                  <div class="form-group">
                    <label>Uživatelské jméno *</label>
                    <input name="username" type="text" class="form-control p_input">
                  </div>

                  <div class="form-group">
                    <label>Heslo *</label>
                    <input name="password" type="password" class="form-control p_input">
                  </div>
                    <?php if (isset($_SESSION["user"])): ?>
                      <div class="form-group d-flex align-items-center justify-content-between">
                        <a href="register.php" class="">Registrovat se</a>
                        <a href="passwordRetrive.html" class="forgot-pass">Zapomenuté heslo</a>
                      </div>
                    <?php endif; ?>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Přihlásit se</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
  </body>
</html>