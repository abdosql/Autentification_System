<?php
$id = "";
$data = "";
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $query = "SELECT * FROM user WHERE id = $id";
    $result = $conn->query($query);
    $data = $result->fetchALL(PDO::FETCH_ASSOC);
}
if (isset($_GET["action"])) {
    if ($_GET["action"] == "change_password") {
        include_once("change_password.php");
        if (isset($_POST["submit"])) {
            $current = $_POST["current"];
            $new = $_POST["new"];
            $new2 = $_POST["new2"];
            //verifying password
            if ($data[0]["password"] == md5($current)) {
                if ($new == $new2) {
                    $new = md5($new);
                    $Qr = "UPDATE `user` SET `password` = '$new' WHERE id = $id";
                    $conn->exec($Qr);
                    $_SESSION["message_success"] = "Password has changed successfully";
                    header("Location:index.php");
                }else {
                     $_SESSION["message_error"] = "Password Confirmation rong";
                     header("Location:index.php?action=change_password");
                    
                }
            }else{
                $_SESSION["message_error"] = "Current Password rong";
                header("Location:index.php?action=change_password");

            }
        }
    }
} else {
?>
    <div class="card w-50">
    <?php
    if (isset($_SESSION["message_error"])) {
    ?>
      <div class="alert alert-danger">
        <p><?= $_SESSION["message_error"]; ?></p>
      </div>
    <?php
      unset($_SESSION["message_error"]);
    } elseif (isset($_SESSION["message_success"])) {
    ?>
      <div class="alert alert-success">
        <p><?= $_SESSION["message_success"]; ?></p>
      </div>
    <?php
      unset($_SESSION["message_success"]);
    }
    ?>
        <div class="card-body text-center">
            <h5 class="mb-0 pt-5"><?= $data[0]["nom"] ?></h5>
            <p class="text-muted"><?= $data[0]["role"] ?></p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item px-3 d-flex align-items-center justify-content-between"> <span class="text-muted small">email</span> <strong><?= $data[0]["email"] ?></strong></li>
                <li class="list-group-item px-3 d-flex align-items-center justify-content-between"> <span class="text-muted small">Login</span> <strong><?= $data[0]["login"] ?></strong></li>
            </ul>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-center">
            <div class="w-50 d-flex align-items-center justify-content-around">
                <a href="logout.php" class="btn btn-md btn-secondary">Logout</a>
                <a href="index.php?action=change_password" class="btn btn-md btn-danger">Change Password</a>
            </div>
        </div>
    </div>
<?php
}

?>