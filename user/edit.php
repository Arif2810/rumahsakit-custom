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
		<small>Edit Data User</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<?php
			$id = @$_GET['id'];
			$sql_user = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user='$id'") or die(mysqli_error($con));
			$data = mysqli_fetch_array($sql_user);
			?>
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="nama">Nama User</label>
					<input type="hidden" name="id" value="<?= $data['id_user'] ?>">
					<input type="text" name="nama" id="nama" value="<?= $data['nama_user'] ?>" class="form-control" required="" autofocus="">
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" value="<?= $data['username'] ?>" class="form-control" required="">
				</div>

				<div class="form-group">
					<label for="password">password</label>
					<input type="hidden" name="password_default" value="<?= $data['password'] ?>">
					<input type="password" name="password" id="password" class="form-control">
					<small class="text-danger"><i>* Kosongkan, jika tidak ingin ganti password!</i></small>
				</div>

				<div class="form-group">
					<label for="spesialis">Spesialis</label>
					<input type="text" name="spesialis" id="spesialis" value="<?= $data['spesialis'] ?>" class="form-control">
					<small class="text-danger"><i>* Diisi jika user adalah dokter!</i></small>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<textarea name="alamat" id="alamat" class="form-control" required=""><?= $data['alamat'] ?></textarea>
				</div>
				<div class="form-group">
					<label for="no_telp">No Telepon</label>
					<input type="text" name="no_telp" id="no_telp" value="<?= $data['no_telp'] ?>" class="form-control" required="">
				</div>
				<div class="form-group">
						<label for="level">Level</label>
						<select name="level" id="level" class="form-control" required="">
							<option value="<?= $data['level']; ?>"><?= $data['level']; ?></option>
							<option value="Admin">Admin</option>
							<option value="Dokter">Dokter</option>
							<option value="Petugas">Petugas</option>
						</select>
				</div>

				<div class="form-group">
					<input type="submit" name="edit" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>


<?php include_once('../_footer.php'); ?>
