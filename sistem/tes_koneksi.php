<?php 
require('koneksi.php');

$hub = open_connection();
if ($hub) {
 echo ("Koneksi Sukses");
} else 
{
	echo ("koneksi Gagal");
}
mysqli_close($hub);

 ?>
