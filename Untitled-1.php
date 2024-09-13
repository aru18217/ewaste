$sql = mysqli_query($kon, "INSERT INTO faktur_kompos(id_faktur,  id_user, id_kompos, nama, alamat, tgl_transaksi, nama_kompos, qty, harga, total_bayar, statuss)
			VALUES('$id_faktur', '$id_user','$id_kompos','$nama', '$alamat', '$tgl_transaksi', '$nama_kompos', '$qty', '$harga', '$total_bayar', '$statuss')") or die(mysqli_error($kon));
			if($sql){}
			 $koin = mysqli_query($kon, "SELECT koin from tb_user WHERE username = '{$_SESSION['username']}' " ) or die(mysqli_error($kon));
				if(mysqli_num_rows($koin) >= 2000)
					{
						$sql2 = mysqli_query($kon, "UPDATE tb_user SET koin = koin - 2000 WHERE username = '{$_SESSION['username']}'" ) or die(mysqli_error($kon));
						if($sql2)
						{
							echo '<script>alert("Selamat Tukar Koin Anda Berhasil."); document.location="riwayat_faktur.php";</script>';
						}
						elseif (mysqli_num_rows($sql2) <= 2000)
						{
							mysqli_query($kon, "UPDATE faktur_kompos SET statuss = 'cancel'" ) or die(mysqli_error($kon));
							echo '<script>alert("Mohon Maaf koin Anda Kurang Dari 2000. Silahkan Gunakan Pesan COD."); document.location="ecommerce.php";</script>';
						}
					}
					elseif (mysqli_num_rows($koin) <= 2000)
					{
						mysqli_query($kon, "UPDATE faktur_kompos SET statuss = 'cancel'" ) or die(mysqli_error($kon));
						echo '<script>alert("Mohon Maaf koin Anda Kurang Dari 2000. Silahkan Gunakan Pesan COD."); document.location="ecommerce.php";</script>';
					}