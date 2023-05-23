<?php
require_once("db.php");
    $query = "SELECT * FROM user WHERE lockout = 1";
    $result = $conn->query($query);
    $data = $result->fetchALL(PDO::FETCH_ASSOC);
    if (count($data) > 0) {
        foreach ($data as $value) {
            ?>
              <tr>
                    <td><?=$value["nom"]?></td>
                    <td></td>
                    <td></td>
                    <td><a style="color:red;" href="blocked.php?id=<?=$value["id"]?>"><i class="fa-solid fa-lock"></i></a></td>
                    <td><a href="delete.php?id=<?=$value["id"]?>"><i class="fa-solid fa-trash"></i></a></td>
        
                </tr>
            <?php
        }
    }else{
        echo"<tr><td>All users are actif</td></tr>";
    }
if (isset($_GET["id"])) {
    $id =$_GET["id"];
    $Qr = "UPDATE `user` SET `lockout`= 0 WHERE id = $id";
    $conn->exec($Qr);
    $conn= null;
    header("Location:admin.php?page=blocked");
}
?>