<?php include "header.php"; ?>

<div class="container">

<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view){
	default:
	?>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Data Tamu Undangan</h3>
			</div>
			<div class="panel-body">
				<a class="btn btn-primary" style="margin-bottom: 10px" href="data_tamu.php?view=tambah">Tambah Data</a>
				<table class="table table-bordered table-striped">
					<tr>
						<th>No</th>
						<th>ID Tamu</th>
						<th>Nama Tamu</th>
						<th>Alamat</th>
						<th>Datang</th>
						<th>Aksi</th>
					</tr>
					<?php
					$sql=mysqli_query($konek, "SELECT * FROM tamu ORDER BY id_tamu ASC");
					$no=1;
					while($d=mysqli_fetch_array($sql)){
						echo "<tr>
							<td width='40px' align='center'>$no</td>
							<td>$d[id_tamu]</td>
							<td>$d[nama]</td>
							<td>$d[alamat]</td>
							<td>$d[datang]</td>
							<td width='180px' align='center'>
								<a class='btn btn-danger btn-sm' href='buatQRCode.php?id=$d[id_tamu]&nomor=$d[nama]'>Buat Kode QR</a>
								<a class='btn btn-success btn-sm' href='cetak_QR.php?id=$d[id_tamu]' target='_blank'>Cetak</a>
							</td>
						</tr>";
						$no++;
					}
					?>
				</table>
			</div>
		</div>
	</div>

<?php
	break;
	case "tambah":

?>
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Tambah Data Tamu Undangan</h3>

			</div>
			<div class="panel-body">
				
				<form method="post" action="aksi_tamu.php?act=insert">
					<table class="table">
						<tr>
							<td>Nama Tamu</td>
							<td><div class="col-md-6"><input class="form-control" type="text" name="nama" required /></div></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><div class="col-md-6"><input class="form-control" type="" name="alamat" required /></div></td>
						</tr>
						<tr>
							<td></td>
							<td>
							<div class="col-md-6">
								<input class="btn btn-primary" type="submit" value="Simpan" />
								<a class="btn btn-danger" href="data_tamu.php">Kembali</a>
								</div>
							</td>
						</tr>
					</table>
				</form>

			</div>
		</div>
	</div>

<?php
	break;
}
?>

</div>

<?php include "footer.php"; ?>