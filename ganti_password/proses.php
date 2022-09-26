<?php
require_once"../_config/config.php";

if(isset($_POST['edit'])){
  $username = $_SESSION['user'];
  $password = sha1(trim(mysqli_real_escape_string($con, $_POST['password'])));
  $query = mysqli_query($con, "UPDATE tb_user SET password = '$password' WHERE username = '$username'");

  if($query){
    echo "<script>alert('Password berhasil dirubah'); window.location='../dashboard';</script>";
  }
  else{
    echo "<script>alert('Password gagal dirubah, coba lagi'); window.location='../dashboard';</script>";
  }

}
