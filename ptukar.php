<?php
session_start();
    if (!isset($_SESSION["username"])) 
    {
    echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
    exit;
    }
include('koneksi.php'); 
    
    $cek = mysqli_query($kon, "SELECT * from tb_user WHERE  koin = 2000 and username = '{$_SESSION['username']}'" ) or die(mysqli_error($kon));
    
    if($cek)
    {
        echo '<script>alert("Silahkan isi data sesuai perintah."); document.location="pesan.php";</script>';
    }
    else
    {
        echo '<script>alert("Koin Anda kurang dari 2000."); document.location="product1.php";</script>';
    }
?>
