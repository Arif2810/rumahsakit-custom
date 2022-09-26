<?php
require_once"../_config/config.php";
require "../_assets/libs/vendor/autoload.php";

use Ramsey\Uuid\Uuid;

if(isset($_POST['add'])){
	$uuid = Uuid::uuid4()->toString();
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$username = trim(mysqli_real_escape_string($con, $_POST['username']));
	$password = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));
	$spesialis = trim(mysqli_real_escape_string($con, $_POST['spesialis']));
	$alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	$no_telp = trim(mysqli_real_escape_string($con, $_POST['no_telp']));
	$level = trim(mysqli_real_escape_string($con, $_POST['level']));
	mysqli_query($con, "INSERT INTO tb_user VALUES('$uuid', '$nama', '$username', '$password', '$spesialis', '$alamat', '$no_telp', '$level')") or die(mysqli_error($con));
	echo "<script>alert('Data berhasil ditambahkan');window.location='data.php';</script>";
}
else if(isset($_POST['edit'])){
	$id = $_POST['id'];
	$nama = trim(mysqli_real_escape_string($con, $_POST['nama']));
	$username = trim(mysqli_real_escape_string($con, $_POST['username']));

	if($_POST['password'] == ''){
		$password = trim(mysqli_real_escape_string($con, $_POST['password_default']));
	}
	else{
		$password = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));
	}

	$spesialis = trim(mysqli_real_escape_string($con, $_POST['spesialis']));
	$alamat = trim(mysqli_real_escape_string($con, $_POST['alamat']));
	$no_telp = trim(mysqli_real_escape_string($con, $_POST['no_telp']));
	$level = trim(mysqli_real_escape_string($con, $_POST['level']));
	mysqli_query($con, "UPDATE tb_user SET nama_user='$nama', username='$username', password='$password', spesialis='$spesialis', alamat='$alamat', no_telp='$no_telp', level='$level' WHERE id_user='$id'") or die(mysqli_error($con));
	echo "<script>alert('Data berhasil diubah');window.location='data.php';</script>";
}