<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

	<title>css</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="bg">

<?php 
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['as']==""){
		header("location:index.php?pesan=gagal");
	}

	?>

<?php 
require ("koneksi.php");


$hub =open_connection();
$a = @$_GET["a"];
$id = @$_GET["id"];
$sql = @$_POST["sql"];
switch ($sql) {
	case "create":
		create_mhs();
		break;
	case "update":
		update_mhs();
		break;
	case "delete":
		delete_mhs();
		break;
}
switch ($a){
	case "list":
	read_data();
	break;
	case "input":
	input_data();
	break;
	case "edit":
	edit_data($id);
	break;
	case "hapus":
	hapus_data($id);
	break;
	default:
	read_data();
	break;
}
mysqli_close($hub) ;
?>
<?php 
function read_data() {
	global $hub;
	$query ="select * from mahasiswa";
	$result =mysqli_query($hub, $query); ?>
<div class="container">

	<div class ="header">
	<h1 align="center" >Data Mahasiswa</h1>
	</div>
	<br>
	<div class="middle">
	<table border=1 cellpadding="2" align="center">
	<tr bgcolor="cream">
		<td colspan="5"><a href="mahasiswa.php?a=input"> INPUT </a></td>
	</tr>
	<tr bgcolor="cream" align="center">
		<td>ID MAHASISWA</td>
		<td>NPM</td>
		<td>NAMA</td>
		<td>ID PRODI</td>
	</tr>
	<?php while($row =mysqli_fetch_array($result)) {?>
	<tr bgcolor="white">
		<td><?php echo $row['idmhs']; ?></td>
		<td><?php echo $row['npm']; ?></td>
		<td><?php echo $row['nama']; ?></td>
		<td><?php echo $row['idprodi']; ?></td>
		<td>
			<a href ="mahasiswa.php?a=edit&id= <?php echo $row ['idmhs']; ?>" > EDIT </a>
			<br>
			<a href ="mahasiswa.php?a=hapus&id= <?php echo $row ['idmhs']; ?>" > HAPUS </a>
		</td>
	</tr>
	<?php } ?>
	</table>
	</div>

</div>
<?php } ?>

<?php  
function input_data() {
	$row = array(
		"npm" => "",
		"nama" => "",
		"idprodi" => "-"
		); ?>
	<div class="header">
	<h2 align="center"> Input Data Mahasiswa</h2>
	</div>
	<br>
	<form action ="mahasiswa.php?a=list" method="post">
	<input type="hidden" name="sql" value="create">

	<table border=1 cellpadding="2" align="center">
	<tr>
		<td>NPM</td>
		<td><input type ="text" name="npm" maxlength="6" value="<?php echo trim($row["npm"]) ?>" />
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input type ="text" name="nama" maxlength="70" value="<?php echo trim($row["nama"]) ?>" />
		</td>
	</tr>
	<tr>
		<td>Id Prodi</td>
		<td><input type ="text" name="idprodi" maxlength="70" value="<?php echo trim($row["idprodi"]) ?>" />
		</td>
		
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type ="submit" name="action" value="Simpan">
		<input type="submit" name="action" value="Batal"><a href="mahasiswa.php?a=list"></a>
		</td>
	</tr>

	</table>
	</form>

<?php } ?>


<?php 
function edit_data ($id) {
	global $hub;
	$query ="select * from mahasiswa where idmhs= $id";
	$result = mysqli_query($hub, $query);
	$row = mysqli_fetch_array($result); ?>

	<div class="header">
	<h2 align="center"> Edit Data Mahasiswa</h2>
	</div>
	<br>

	<form action="mahasiswa.php?a=list" method="post">
	<input type="hidden" name="sql" value="update">
	<input type="hidden" name="idmhs" value="<?php echo trim ($id) ?>">

	<table border=1 cellpadding="2" align="center">
	<tr>
		<td>NPM</td>
		<td><input type ="text" name="npm" maxlength="6" value="<?php echo trim($row["npm"]) ?>" />
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td><input type ="text" name="nama" maxlength="70" value="<?php echo trim($row["nama"]) ?>" />
		</td>
	</tr>
	<tr>
		<td>Id Prodi</td>
		<td><input type ="text" name="idprodi" maxlength="70" value="<?php echo trim($row["idprodi"]) ?>" />
		</td>
		
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type ="submit" name="action" value="Simpan">
		<input type="submit" name="action" value="Batal"><a href="mahasiswa.php?a=list"></a>
		</td>
	</tr>

	</table>
	</form>
<?php } ?>

<?php 
function hapus_data($id){
	global $hub;
	global $_POST;
	$query ="select * from mahasiswa where idmhs =$id";
	$result = mysqli_query($hub, $query);
	$row = mysqli_fetch_array($result); ?>
	<div class="header">
	<h2 align="center"> Hapus Data Mahasiswa </h2>
	</div>
	<br>
	<form action="mahasiswa.php?a=list" method="post">
		<input type="hidden" name="sql" value="delete">
		<input type="hidden" name="idmhs" value="<?php echo trim ($id) ?>">
		<table border=1 cellpadding="2" align="center">
			<tr>
				<td width="100">NPM</td>
				<td><?php echo trim ($row["npm"]) ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><?php echo trim ($row["nama"]) ?></td>
			</tr>
			<tr>
				<td>Idprodi</td>
				<td><?php echo trim ($row["idprodi"]) ?></td>
			</tr>
			<tr>
			<td colspan="2" align="center"><input type="submit" name="action" value="Hapus">
			<input type="submit" name="action" value="Batal"><a href="mahasiswa.php?a=list"></a>
			</td>
			</tr>
		</table>
	</form>
<?php } ?>

<?php 
function create_mhs() {
	global $hub;
	global $_POST;
	$query ="INSERT INTO mahasiswa (npm, nama, idprodi) values";
	$query .="('".$_POST["npm"]."', '".$_POST["nama"]. "', '".$_POST["idprodi"]."')";
	mysqli_query($hub, $query) or die (mysql_error());
}
function update_mhs(){
	global $hub;
	global $_POST;
	$query ="UPDATE mahasiswa";
	$query .=" SET npm='" .$_POST["npm"]."' , nama='" .$_POST["nama"]."' , idprodi='" .$_POST["idprodi"]."'";
	$query .=" WHERE idmhs = ".$_POST["idmhs"];
	mysqli_query($hub, $query) or die (mysql_error());
}
function delete_mhs(){
	global $hub;
	global $_POST;
	$query ="DELETE from mahasiswa";
	$query .=" WHERE idmhs=".$_POST["idmhs"];
	mysqli_query($hub, $query) or die (mysql_error());
}
?>

<a href="logout.php"> <input type="submit" value="<--logout"/> </a>

</body>
</html>
