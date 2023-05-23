<?php include_once('header.php')?>

<div class="card w-75">

<table class="table">
<thead>
    <tr>
      <th scope="col">Nom </th>
      <th scope="col"></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php

    if (isset($_GET["page"])) {
        if ($_GET["page"] == "blocked") {
            include_once("blocked.php");
        }elseif($_GET["page"] == "inactif"){
            include_once("inactif.php");

        }else{
            echo"page not found";
        }
    }else{
        $query = "SELECT * FROM user";
        $result = $conn->query($query);
        $data = $result->fetchALL(PDO::FETCH_ASSOC);
        ?>


    <?php
    foreach ($data as $value) {
        ?>
          <tr>
                <td><?=$value["nom"]?>  (<?=$value["role"]?>)</td>
                <td></td>
                <td><a style="
                <?php
                    if($value["lockout"] == 1){
                        echo"color : red";
                    }else{
                        echo"color : green";

                    }
                ?>
                "><i class="fa-solid fa-lock"></i></a></td>
                <td><a style="
                                <?php
                    if($value["valid"] == 0){
                        echo"color : red";
                    }else{
                        echo"color : green";

                    }
                ?>
                "><i class="fa-solid fa-check"></i></a></td>
                <td><a href="delete.php?id=<?=$value["id"]?>"><i class="fa-solid fa-trash"></i></a></td>

            </tr>
        <?php
    }
    ?>

        <?php
    }
?>
</tbody>
</table>
<div class="card-footer">
    <center>
        <a href="admin.php" class="btn btn-md btn-primary">Tous les utilisateur</a>
        <a href="admin.php?page=blocked" class="btn btn-md btn-danger">Comptes Bloqué</a>
        <a href="admin.php?page=inactif" class="btn btn-md btn-success">Comptes inactif</a>
        <br>
        <hr>
        <a class="btn btn-md btn-secondary" href="logout.php">Logout</a>
    </center>
</div>
</div>
<?php include_once('footer.php')?>
