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
	    				<a class="page-title">User</a>
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
				<div class="col s12 m12 l12 offset-l2"> <br>
					<!--kolom search-->
					<div class="col s12 m12 l12">
						<form name="cari" method="post" action="cari-user.php" class="row">
	                    	<div class="e-input-field col s12 m12 l12">
	                    		<input type="text" name="cari" placeholder="Cari Berdasarkan Nama / Kode / Telepon / Email / Alamat / Status" class="validate" required title="Cari User">
	                    		<input type="submit" name="cari2" value="cari" class="btn right black darken-2"> 
	                    	</div>
						</form>
					</div>

					<!--table-->
					<div class="col s12 m12 l12 card-panel z-depth"> <br>
						<table class="highlight">
							<!--kolom header table-->
							<tr>
			                  <th hidden>ID</th>
								<th>Kode</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Telepon</th>
								<th>Alamat</th>
								<th>Status</th>
								<th>Pengaturan</th>
				            </tr>

							<?php 

							while($user_data = mysqli_fetch_array($result)) { 
			                    $test = $user_data['nama']; 
				                echo "<tr>";
			                    echo "<td hidden>".$user_data['id']."</td>";
				                echo "<td> <h6>".$user_data['kode']."</h6></td>";
				                echo "<td> <h6>".$user_data['nama']."</h6> </td>";
								echo "<td> <h6>".$user_data['email']."</h6> </td>";
				                echo "<td><h6>".$user_data['telepon']."</h6></td>";
								echo "<td> <h6>".$user_data['alamat']."</h6> </td>";
			                    echo "<td><h6>".$user_data['level']."</h6></td>"; 
				                echo "<td> <a href='edit-user.php?id=$user_data[id]' style='text-decoration: none;'><i class='material-icons' title='Edit $test'>mode_edit</i></a> | <a data-id='1' class='hapus' href='delete.php?id=$user_data[id]' style='text-decoration: none;'><i class='material-icons' title='Hapus $test'>delete</i></a> | <a href='edit-password.php?id=$user_data[id]' style='text-decoration: none;'><i class='material-icons' title='Ganti Kata Sandi $test'>lock</i></a> </td></tr>";
				            }

							?>

							
						</table>
						<table>
							<tr>
				            	<td colspan='9'>
				            		<a href='tambah-user.php' class="right waves-effect waves-light btn black darken-2">Tambah User<i class="material-icons right">add</i></a>
				            	</td>
				            </tr>
						</table>
					</div>
				</div>
			</div>
		</main>
        <!--end of content-->


	</div>

	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript">
	  	$(document).ready(function(){
	    	$('.collapsible').collapsible();
	    	$(".button-collapse").sideNav();
		});
	</script>
	<script>
        $(".hapus").click(function () {
        var jawab = confirm("Anda Yakin Ingin Menghapus User ?");
        if (jawab === true) {
        // konfirmasi
            var hapus = false;
            if (!hapus) {
                hapus = true;
                $.post('delete.php', {id: $(this).attr('data-id')},
                function (data) {
                    alert(data);
                });
                hapus = false;
            }
        } else {
            return false;
        }
        });
      </script>
</body>
</html>