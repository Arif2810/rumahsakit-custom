<?php
require_once"../_config/config.php";
if($_SESSION['level'] !== 'Admin'){
  echo "<script>window.location='".base_url('dashboard')."'</script>";
}

?>

<?php
include_once('../_header.php');
?>

<div class="box">
	<h1>User</h1>
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
	<h4>
		<small>Tambah Data User</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="nama">Nama User</label>
					<input type="text" name="nama" id="nama" class="form-control" required="" autofocus="">
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="text" name="password" id="password" class="form-control" required="" value="<?= 1234 ?>" readonly>
					<small class="text-danger"><i>* Password default: '1234'</i></small>
				</div>
				<div class="form-group">
					<label for="spesialis">Spesialis</label>
					<input type="text" name="spesialis" id="spesialis" class="form-control">
					<small class="text-danger"><i>* Diisi jika user adalah dokter!</i></small>
				</div>
				<div class="form-group">
					<label for="alamat">alamat</label>
					<textarea name="alamat" id="alamat" class="form-control" required=""></textarea>
				</div>
				<div class="form-group">
					<label for="no_telp">No Telepon</label>
					<input type="text" name="no_telp" id="no_telp" class="form-control" required="">
				</div>
				<div class="form-group">
					<label for="level">Level</label>
					<select name="level" id="level" class="form-control" required="">
						<option value="">-Pilih Level-</option>
						<option value="Admin">Admin</option>
						<option value="Dokter">Dokter</option>
						<option value="Petugas">Petugas</option>
					</select>
				</div>
				<div class="form-group">
					<input type="submit" name="add" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>

<?php include_once('../_footer.php'); ?>
