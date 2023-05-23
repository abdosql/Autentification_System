<?php
if (isset($_GET["id"])) {
    require_once("db.php");
    $id = $_GET["id"];
    $Qr = "DELETE FROM user WHERE id = $id";
    $conn->exec($Qr);
    header("Location:admin.php");
}
?>