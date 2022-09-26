<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if(isset($_POST['add'])){
	$uuid = Uuid::uuid4()->toString();
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$spesialis = trim(mysqli_real_escape_string($con, $_POST['spesialis']));
	$alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	$telp = trim(mysqli_real_escape_string($con, $_POST['telp']));
	mysqli_query($con, "INSERT INTO tb_dokter VALUES('$uuid', '$nama', '$spesialis', '$alamat', '$telp')") or die(mysqli_error($con));
	echo "<script>alert('Data berhasil ditambahkan');window.location='data.php';</script>";
}
else if(isset($_POST['edit'])){
	$id = $_POST['id'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$username = trim(mysqli_real_escape_string($con, $_POST['username']));
	$password = trim(mysqli_real_escape_string($con, $_POST['password']));
	$spesialis = trim(mysqli_real_escape_string($con, $_POST['spesialis']));
	$alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	$no_telp = trim(mysqli_real_escape_string($con, $_POST['no_telp']));
	$level = trim(mysqli_real_escape_string($con, $_POST['level']));
	mysqli_query($con, "UPDATE tb_user SET nama_user='$nama', username='$username', password='$password', spesialis='$spesialis', alamat='$alamat', no_telp='$no_telp', level='$level' WHERE id_user='$id'") or die(mysqli_error($con));
	echo "<script>alert('Data berhasil diubah');window.location='data.php';</script>";
}