<?php
	include 'koneksi.php';

	if (isset($_POST['aksi'])){
		if ($_POST['aksi'] == "add") {

			
			
			$nisn = $_POST['nisn'];
			$nama_siswa = $_POST['nama_siswa'];
			$jk = $_POST['jenis_kelamin'];
			$foto = $_FILES['foto']['name'];
			$alamat = $_POST['alamat'];

			$dir = "img/";
			$tmpFile = $_FILES['foto']['tmp_name'];

			move_uploaded_file($tmpFile, $dir.$foto);
			//die();

			$query = "insert into tb_siwa values(null, '$nisn', '$nama_siswa', '$jk', '$foto', '$alamat')";
			$sql = mysqli_query($conn, $query);
			if ($sql) {
				header("location: index.php");
				// echo "Data berhasil Ditambahkan <a href = 'index.php' > [Home]  </a>";
			} else{
				echo ($query);
			}

			// echo $nisn." | ".$nama_siswa." | ".$jk." | ".$foto." | ".$alamat;

		}else  if ($_POST['aksi'] == "edit") {
			echo "Edit data <a href ='index.php'>[Home]</a>";
		}
	}
	if (isset($_GET['hapus'])) {
		$id_siswa = $_GET['hapus'];
		$queryShow = "select * from tb_siwa where id_siswa = '$id_siswa'; ";
		$sqlshow = mysqli_query($conn, $queryShow);

		$result = mysqli_fetch_assoc($sqlshow);


		//var_dump($result);
		//die();
		unlink("img/".$result['foto']);

		$query = "Delete from tb_siwa where id_siswa ='$id_siswa'; ";
		$sql = mysqli_query($conn, $query);
		// echo "Hapus Data <a href ='index.php'>[Home]</a>";
		if ($sql) {
			header("location: index.php");
		}else{
			echo($query);
		}
	}
?>