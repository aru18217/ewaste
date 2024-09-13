<?php
	session_start();
    if (!isset($_SESSION["username"])) 
    {
    echo "Anda harus login dulu <br><a href='login.php'>Klik disini</a>";
    exit;
    }
	include "koneksi.php";
	$id_faktur			=$_POST['id_faktur'];
	$id_user			=$_POST['id_user'];
	$id_kompos			=$_POST['id_kompos'];
	$nama				=$_POST['nama'];
	$alamat				=$_POST['alamat'];
	$tgl_transaksi		=$_POST['tgl_transaksi'];
	$nama_kompos		=$_POST['nama_kompos'];
	$qty				=$_POST['qty'];
	$harga				=$_POST['harga'];
	$total_bayar		=$_POST['total_bayar'];
	$statuss			=$_POST['statuss'];
		
	$cek = mysqli_query($kon, "SELECT * FROM faktur_kompos WHERE id_faktur ='$id_faktur'") or die(mysqli_error($kon));
		if(mysqli_num_rows($cek) == 0)
		{
			$sql = mysqli_query($kon, "INSERT INTO faktur_kompos(id_faktur,  id_user, id_kompos, nama, alamat, tgl_transaksi, nama_kompos, qty, harga, total_bayar, statuss)
			VALUES('$id_faktur', '$id_user','$id_kompos','$nama', '$alamat', '$tgl_transaksi', '$nama_kompos', '$qty', '$harga', '$total_bayar', '$statuss')") or die(mysqli_error($kon));
				
				if($sql)
					{
						$koin = mysqli_query($kon, "SELECT koin from tb_user WHERE koin >= 2000 and username = '{$_SESSION['username']}' " ) or die(mysqli_error($kon));
						if (mysqli_fetch_array($koin) >= 2000)
							{
								mysqli_query($kon, "UPDATE tb_user SET koin = koin - 2000 WHERE username = '{$_SESSION['username']}'" ) or die(mysqli_error($kon));
								echo '<script>alert("Selamat Tukar Koin Anda Berhasil."); document.location="riwayat_faktur.php";</script>';
							}
						elseif (mysqli_fetch_array($koin) <= 2000)
							{
								mysqli_query($kon, "UPDATE faktur_kompos SET statuss = 'cancel'" ) or die(mysqli_error($kon));
								echo '<script>alert("Mohon Maaf koin Anda Kurang Dari 2000. Silahkan Gunakan Pesan COD."); document.location="ecommerce.php";</script>';
							}
						else{
							echo '<script>alert("Gagal melakukan tukar koin."); document.location="ecommerce.php";</script>';	
							}
							
					}
					else
					{
						echo '<script>alert("Gagal melakukan proses edit data."); document.location="ecommerce.php";</script>';
					}
		}
		else
		{
			echo '<script>alert("Gagal melakukan proses edit data."); document.location="ecommerce.php";</script>';
					
		}
?>