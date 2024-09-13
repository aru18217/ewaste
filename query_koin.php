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