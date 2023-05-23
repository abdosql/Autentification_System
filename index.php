<?php include_once('header.php')?>
<?php
if (isset($_SESSION["login"]) && isset($_SESSION["role"])) {
  if ($_SESSION["login"] == 1) {
      if ($_SESSION["role"] == 'user') {
        include_once("user.php");
      }else{
        include_once("admin.php");
      }
  }
}else{
  ?>

<div class="card w-50">
  <?php
  if (isset($_SESSION["message_error"])) {
    ?>
      <div class="alert-danger">
        <p><?= $_SESSION["message_error"];?></p>
      </div>
    <?php
    $_SESSION["message_error"] = "";
    header("Location:inscription.php");
  }elseif(isset($_SESSION["message_success"])){
    ?>
      <div class="alert alert-success">
        <p><?= $_SESSION["message_success"];?></p>
      </div>
    <?php
        $_SESSION["message_success"] = "";
        header("Location:login.php");
  }
?>
    <div class="card-header text-center">
      <h3>Inscription</h3>
    </div>
    <div class="card-body">
      <form action="inscription.php" method="post">
        <div class="form-group">
          <label for="">Nom :</label>
          <input name="nom" class="form-control" required pattern="[A-za-Z]{3,50}" type="text">
        </div>
        <div class="form-group">
          <label for="">Email :</label>
          <input name="email" class="form-control" required type="email">
        </div>
        <div class="form-group">
          <label for="">Login :</label>
          <input name="login" class="form-control" required type="text">
        </div>
        <div class="form-group">
          <label for="">Password :</label>
          <input name="password1" class="form-control" required type="password">
          <label for="">Confirmation :</label>
          <input name="password2" class="form-control" required type="password">
        </div>
        <center>
          <button name="submit" class="btn btn-md btn-success">S'inscrire</button>
          <a href="login.php" class="btn btn-md btn-primary">Login</a>
        </center>
      </form>
    </div>
  </div>


  <?php
}

?>
<?php include_once("footer.php")?>