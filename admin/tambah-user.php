<?php session_start();
include_once("../config.php");
$result = mysqli_query($koneksi, "SELECT * FROM users ORDER BY kode DESC");

if( !isset($_SESSION['admin']) )
{
  header('location:./../'.$_SESSION['akses']);
  exit();
}

$nama = ( isset($_SESSION['user']) ) ? $_SESSION['user'] : '';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="shortcut icon" href="../images/icon.png">
	<!--Import Google Icon Font-->
    <link href="../fonts/material.css" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style type="text/css">
	       /* label color */
	       .e-input-field label {
	         color: #000;
	       }
	       /* label focus color */
	       .e-input-field input[type=text]:focus + label,.e-input-field input[type=password]:focus + label {
	         color:rgb(0, 0, 0) !important;
	       }
	       /* label underline focus color */
	       .e-input-field input[type=text]:focus,.e-input-field input[type=password]:focus {
	         border-bottom: 1px solid rgb(0, 0, 0) !important;
	         box-shadow: 0 1px 0 0 rgb(0, 0, 0) !important;
	       }
	       /* valid color */
	       .e-input-field input[type=text].valid,.e-input-field input[type=password].valid {
	         border-bottom: 1px solid rgb(0, 0, 0) !important;
	         box-shadow: 0 1px 0 0 rgb(0, 0, 0) !important;
	       }
	       /* invalid color */
	       .e-input-field input[type=text].invalid,.e-input-field input[type=password].invalid {
	         border-bottom: 1px solid rgb(0, 0, 0) !important;
	         box-shadow: 0 1px 0 0 rgb(0, 0, 0) !important;
	       }
	       /* icon prefix focus color */
	       .e-input-field .prefix.active {
	         color:rgb(0, 0, 0) !important;
	       }
	    </style>
</head>
<body>
	<div class="row">
		<!--header-->
		<header>
			<!--TopNav-->
	        <nav class="row top-nav black darken-2">
	    		<div class="container">
	    			<div class="col offset-l2 nav-wrapper">
	    				<a href="#" data-activates="slide-out" class="button-collapse top-nav full hide-on-large-only"><i class="material-icons">menu</i></a>
	    				<a class="page-title">Tambah User</a>
	    			</div>
	    		</div>
			</nav>

			<!--Sidenav-->
			<ul id="slide-out" class="side-nav fixed">
	            
	            <li class="no-padding">
		            <ul class="collapsible collapsible-accordion">
		                <li>
		                	<div class="user-view">
		                    	<div class="background" style="margin-bottom:-15%;">
		                    		<img src="../images/background.jpg">
		                    	</div>
		                		<span class="white-text name"><?php echo $nama; ?><i class="material-icons left">account_circle</i></span>
		                	</div>
		                </li>
		                
		                <li><div class="divider" style="margin-top:15%;"></div></li>

		                <li><a href="index.php" class="collapsible-header">Beranda<i class="material-icons">home</i></a></li>

		                <li>
		                	<a class="collapsible-header">Menu<i class="material-icons">arrow_drop_down</i></a>
		                	<div class="collapsible-body">
		                		<ul>
		                			<li class="active black darken-4"><a href="user.php">User</a></li>
									<li><a href="barangmasuk.php">Barang Masuk</a></li>
									<li><a href="gudang.php">Gudang</a></li>
									<li><a href="barangkeluar.php">Barang Keluar</a></li>
								</ul>
							</div>
		                </li>
		                
		                <li><a href="../logout.php" class="collapsible-header">Keluar<i class="material-icons">exit_to_app</i></a></li>

		            </ul>
	            </li>

	        </ul>
		</header>
		<!--end of header-->

		<!--content-->
		<main>
			<div class="row container">
				<div class="col s12 m12 l10 offset-l3"> <br>

					<!--table-->
				<form action="" method="post" name="form1">
					<div class="col s12 m12 l12 card-panel z-depth"> <br>
						<table class="highlight">
							<!--kolom isian table-->
							<tr>
				              <th>Kode</th>
				              <th><input type="text" name="kode" required></th>
				            </tr>
				            <tr>
				              <th>Nama</th>
				              <th><input type="text" name="nama" required></th>
				            </tr>
				            <tr>
				              <th>Email</th>
				              <th><input type="text" name="email" required></th>
				            </tr>
				            <tr>
				              <th>Telepon</th>
				              <th><input type="text" name="telepon" required></th>
				            </tr>
				            <tr>
				              <th>Alamat</th>
				              <th><input type="text" name="alamat" required></th>
				            </tr>
				            <tr>
				              <th>Username</th>
				              <th><input type="text" name="username" required></th>
				            </tr>
				            <tr>
				              <th>Password</th>
				              <th><input type="password" name="password" required></th>
				            </tr>
				            <tr>
				              <th>Status</th>
				              <th>
				                <input type="text" name="level" placeholder="Isi Dengan Admin / Member !">
				              </th>
				            </tr>
						</table>
						<table>
				            <tr>
				            	<th>
				            		<input type="submit" name="tambah" value="Tambah User" class="right waves-effect waves-light btn green darken-2" style="float: left;">
				            	</th>
				            	<th style="width: 1%;">
				            		<a href="user.php"><input type="button" value="Kembali" class="right waves-effect waves-light btn red darken-2"></a> 
				            	</th>
				            </tr>
				        </table>
					</div>
				</form>
				</div>
			</div>
		</main>
        <!--end of content-->

        <!-- Proses Penambahan Data User -->

        <?php
 
          // Check If form submitted, insert form data into users table.
          if(isset($_POST['tambah'])) {
            $kode = $_POST['kode'];
            $name = $_POST['nama'];
            $email = $_POST['email'];
            $telepon = $_POST['telepon'];
            $alamat = $_POST['alamat'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $level = $_POST['level'];
            
            // include database connection file
            include_once("../config.php");
                
            // Insert user data into table
            $result = mysqli_query($koneksi, "INSERT INTO users(kode,nama,email,telepon,alamat,username,password,level) VALUES('$kode','$name','$email','$telepon','$alamat','$username','$password','$level')");
            
            echo "<script>alert('Tambah User Dengan kode $kode Berhasil')</script>";
          }
        ?>

        <!-- End -->


	</div>

	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript">
	  	$(document).ready(function(){
	    	$('.collapsible').collapsible();
	    	$(".button-collapse").sideNav();
		});
	</script>
</body>
</html>