<?php
include_once('header.php') ?>
<?php
$is_authentificated = "";
if (isset($_SESSION["login"])) {
  $is_authentificated = $_SESSION["login"];
}
if ($is_authentificated != 1) {
  if (isset($_POST["submit"])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    //Getting users data from database
    $query = "SELECT * FROM user";
    $result = $conn->query($query);
    $data = $result->fetchALL(PDO::FETCH_ASSOC);
    foreach ($data as $row) {
      if ($login == $row["login"]) {
        $id = $row["id"];
        $tentaive = $row["tantatives"];
        $lockout = $row["lockout"];
        $role = $row["role"];
        if (md5($password) == $row["password"]) {
          if ($row["valid"] == 1) {
            if ($lockout == 0) {
              $_SESSION["login"] = 1;
              $_SESSION["role"] = $role;
              $_SESSION["id"] = $id;
              $Qr = "UPDATE `user` SET `tantatives`= 0,`lockout`= 0 WHERE id = $id";
              $conn->exec($Qr);
              header("Location:index.php");
            } else {
              $_SESSION["message_error"] = "Votre compte est bloquée";
            }
          }else{
            $_SESSION["message_error"] = "Votre compte est inactif";
          }
        } else {
          if ($lockout == 0) {
            //Increment tentatives
            if ($tentaive < 3) {
              $tentaive++;
              $num_t = 3 - $tentaive;
              $Qr = "UPDATE `user` SET `tantatives`= $tentaive WHERE id = $id";
              $_SESSION["message_error"] = "Le mot de pass est incorrect il vous restes $num_t tentatives";
            } else {
              $Qr = "UPDATE `user` SET `lockout`= 1 WHERE id = $id";
              $_SESSION["message_error"] = "Votre compte est bloquée";
            }
            $conn->exec($Qr);
            $conn = null;
          } else {
            $_SESSION["message_error"] = "Votre compte est bloquée";
          }
        }
      } else {
        $_SESSION["message_error"] = "Le Login est incorrect";
      }
    }
  }

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
    <div class="card-header text-center">
      <h3>Login</h3>
    </div>
    <div class="card-body">
      <form action="login.php" method="post">
        <div class="form-group">
          <label for="">Login :</label>
          <input name="login" class="form-control" required type="text">
        </div>
        <div class="form-group">
          <label for="">Password :</label>
          <input name="password" class="form-control" required type="password">
        </div>
        <center>
          <button name="submit" class="btn btn-md btn-success">Login</button>
          <a href="index.php" class="btn btn-md btn-primary">S'inscrire</a>

        </center>
      </form>
    </div>
  </div>
<?php
} else {
  header("Location:index.php");
}
?>
<?php include_once("footer.php") ?>