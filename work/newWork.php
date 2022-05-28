<?php

require_once "../Secure.php";

$db = new Database();
$userRepository = new userRepository($db);
$workRepository = new workRepository($db);
$rr = new roleRepository($db);
$uwr = new userWorksRepository($db);

if (isset($_POST["date"], $_POST["hours"], $_POST["earnings"], $_POST["expenses"], $_POST["note"])) {

    $lastId = $workRepository->addWorks($_POST["date"], ($_POST["hours"]), $_POST["earnings"], $_POST["expenses"],$_POST["workCategoryId"], $_POST["note"]);

}

if (isset($_POST["worker"], $_POST["work"]))
{
    $lastId = $uwr->addUserWorks($_POST["worker"], $_POST["work"]);
    header("Location:newWork.php");
}



$userRepository = new userRepository($db);
$users = $userRepository->getStudents();

$workRepository = new workRepository($db);
$worksCategory = $workRepository->getCategories();

$DaysAgoDuration = "P300D";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Přidání práce</title>
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

<body class="container-scroller">
    <div class="col-md-6 full-page-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Přidání práce</h4>

                <form method="post" class="forms-sample">

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kdo pracoval</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="worker" multiple>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user["id"] ?>"><?= $user["name"]?> <?= $user["surname"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <?php

                        $now = new DateTime();
                        ($now->format("Y-m-d"));

                        $daysAgo = new DateTime();
                        $daysAgo->sub(new DateInterval($DaysAgoDuration));

                        ?>
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Datum</label>
                        <div class="col-sm-9">
                            <input type="date" name="date"
                                   min="<?= $daysAgo->format("Y-m-d"); ?>"
                                   max="<?= $now->format("Y-m-d") ?>"
                                   value="<?= $now->format("Y-m-d") ?>"
                                   class="form-control" id="exampleInputUsername2" required >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Počet hodin</label>
                        <div class="col-sm-9">
                            <input type="number" max="24" name="hours" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Vyděláno</label>
                        <div class="col-sm-9">
                            <input type="number" name="earnings" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Náklady</label>
                        <div class="col-sm-9">
                            <input type="number" name="expenses" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Typ práce</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="workCategoryId">
                                <?php foreach ($worksCategory as $workCategory): ?>
                                    <option value="<?= $workCategory["id"] ?>"><?= $workCategory["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Poznámky</label>
                        <div class="col-sm-9">
                            <input type="text" name="note" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Odeslat ke schválení</button>

                </form> <br>
                <a href="../index.php">Hlavní stránka</a>
            </div>
        </div>
    </div>
</body>
</html>