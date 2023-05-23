<?php
session_start();
if(isset($_POST["submit"])){
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password1 = md5($_POST['password1']);
    $password2 = md5($_POST['password2']);

    if (!empty($nom) and !empty($email) and !empty($password1) and !empty($password2)) {
        //checking password confirmation
        if ($password1 == $password2) {
            //preparing the query
            require_once("db.php");
            $query = "
            INSERT INTO `user`
            (`nom`, `email`, `login`, `password`, `role`, `tantatives`, `lockout`, `valid`)
             VALUES 
             ('$nom','$email','$login','$password1','user','0','0','0')
            ";
            if ($conn->exec($query)) {
                $_SESSION["message_success"] = "Vous étes inscrit.";
                $conn = null;
                header("Location:login.php");
            }
        }else {
            $_SESSION["message_error"] = "Confirmation du mot de pass est erronée.";
        }
    }else{

    }
}
?>