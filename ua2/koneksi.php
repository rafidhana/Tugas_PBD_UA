<?php 
function open_connection(){

$koneksi  = mysqli_connect ("localhost","root","","pbd_akademik_3049");
return $koneksi;

}
 ?>
