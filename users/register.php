<!--Nevím jak jinak přidat heslo a účty-->
<?php

require_once "../model/Base.php";
require_once "../model/userRepository.php";
require_once "../model/roleRepository.php";

session_start();

$db = new Database();
$ur = new userRepository($db);

if (isset($_POST["username"],$_POST["password"], $_POST["name"], $_POST["surname"], $_POST["roleId"])){

    $lastId = $ur->addUser($_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["name"], $_POST["surname"], $_POST["roleId"]);

    header("Location: login.php");

//    $sql = "INSERT INTO user SET username = :username, password = :password";
//    $stmt = $conn->prepare($sql);
//    $stmt->execute([
//        ":username" => $_POST["username"],
//        ":password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
//    ]);
//
//    header("Location: index.php");
}

    $rr = new roleRepository($db);
    $roles = $rr->getRoles();

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrace</title>
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
    <link rel="shortcut icon" href="../assets/images/monte-mini-logo.png" />
</head>
<body class="">
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">

                            <h3 class="card-title text-left mb-3">Registrace</h3>
                            <form method="post">
                                <div class="form-group">
                                    <label>Uživatelské jméno *</label>
                                    <input name="username" type="text" class="form-control p_input" required>
                                </div>

                                <div class="form-group">
                                    <label>Jméno *</label>
                                    <input name="name" type="text" class="form-control p_input" required>
                                </div>

                                <div class="form-group">
                                    <label>Přijmení *</label>
                                    <input name="surname" type="text" class="form-control p_input" required>
                                </div>

                                <div class="form-group">
                                    <label>Heslo *</label>
                                    <input name="password" type="password" class="form-control p_input" required>
                                </div>

                                <select name="roleId" class="form-control">
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?= $role["id"] ?>"><?= $role["name"] ?></option>
                                    <?php endforeach; ?>
                                </select>

                                <div class="form-group d-flex align-items-center justify-content-between">
                                    <a href="login.php" class="forgot-pass">Už mám účet</a>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Zaregistrovat se</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
