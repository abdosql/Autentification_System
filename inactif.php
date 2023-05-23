<?php
require_once("db.php");
    $query = "SELECT * FROM user WHERE valid = 0";
    $result = $conn->query($query);
    $data = $result->fetchALL(PDO::FETCH_ASSOC);
    if (count($data) > 0) {
        foreach ($data as $value) {
            ?>
              <tr>
                    <td><?=$value["nom"]?></td>
                    <td></td>
                    <td></td>
                    <td><a style="color: red;" href="inactif.php?id=<?=$value["id"]?>"><i class="fa-solid fa-check"></i></a></td>
                    <td><a href="delete.php?id=<?=$value["id"]?>"><i class="fa-solid fa-trash"></i></a></td>
        
                </tr>
            <?php
        }
    }else{
        echo"<tr><td>All users are actif</td></tr>";
    }
if (isset($_GET["id"])) {
    $id =$_GET["id"];
    $Qr = "UPDATE `user` SET `valid`= 1 WHERE id = $id";
    $conn->exec($Qr);
    $conn= null;
    header("Location:admin.php?page=inactif");
}
?>