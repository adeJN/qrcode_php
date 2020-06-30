<?php
session_start();
if(!isset($_SESSION['login'])){
	header('location:login.php');
}
include "koneksi.php";

// jika ada get act
if(isset($_GET['act'])){

	//proses simpan data
	if($_GET['act']=='insert'){
		//variabel dari elemen form
		$nama 	= $_POST['nama'];
		$alamat  = $_POST['alamat'];
		
		if($nama=='' || $alamat==''){
			header('location:data_tamu.php?view=tambah');
		}else{			
			//proses simpan data admin
			$simpan = mysqli_query($konek, "INSERT INTO tamu(fk_id_event, nama,alamat,konfirmasi_kedatangan,datang) 
							VALUES (0,'$nama','$alamat','tidak','tidak')");
			
			if($simpan){
				// BUAT QRCODE
				// tampung data kiriman
				$namaa = $nama;
			
				// include file qrlib.php
				include "phpqrcode/qrlib.php";
			
				//Nama Folder file QR Code kita nantinya akan disimpan
				$tempdir = "temp/";
			
				//jika folder belum ada, buat folder 
				if (!file_exists($tempdir)){
					mkdir($tempdir);
				}
			
				#parameter inputan
				$isi_teks = $namaa;
				$namafile = $namaa.".png";
				$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
				$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
				$padding = 2;
			
				QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
				echo "Qr code telah dibuat";
				header('location:data_tamu.php');
			}else{
				header('location:data_tamu.php');
			}
		}
	} // akhir proses simpan data

	else{
		header('location:data_tamu.php');
	}

} // akhir get act

else{
	header('location:data_tamu.php');
}
?>