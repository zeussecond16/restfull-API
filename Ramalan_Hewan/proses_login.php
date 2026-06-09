<?php
session_start();
include "config_koneksi.php";

$user = $_POST['username'];
$pass = $_POST['password'];

$q = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");

if(mysqli_num_rows($q) > 0){

    // bikin session admin
    $_SESSION['admin'] = $user;
    $_SESSION['login'] = true;

    header("Location: index.php");
    exit;

}else{
    echo "Login gagal";
}
?>
