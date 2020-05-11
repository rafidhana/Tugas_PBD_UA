<!DOCTYPE html>
<html>
<head>
    <title>Menu Login</title>
    <link rel="stylesheet" type="text/css" href="style_login.css">
</head>
<body>

    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan']=="gagal"){
            echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
        }
    }
    ?>
    <div class="kotak_login">
        <center><img src="polinela.png" width="175px" height="200px"></center></br>
        <form action="sistem.php" method="post">
            <input type="text" name="username" class="input_login" placeholder="Username" required="required">
            <input type="password" name="password" class="input_login" placeholder="Password" required="required">
            <input type="submit" class="btn_login" value="LOGIN">
        </form>
        
    </div>
</body>
</html>