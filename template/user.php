<?php
require_once '../koneksi.php';
$username = $_GET['username'];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
if (mysqli_num_rows($result) > 0) {
	$dta = mysqli_fetch_assoc($result);
} else {
	echo "<script>top.window.location = '../404.php'</script>";
	die;

	// header("location: ../views/404.php");
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="UINAM, uinam, uinamfind, UIN, Universitas Alauddin Makassar, Alauddin, Makassar, Mahaisswa, Kampus, Samata, Gowa, Recruiter, Loker, Lowongan Kerja, Organisasi, UKM, UIN Alauddin Makassar, Universitas Islam Negeri Alauddin Makassar, Islam, Find, Cari" />
	<title>My Resume | <?= $username ?></title>
	<meta name="robots" content="noindex,nofollow">
	<?php
	if ($dta['foto'] == "") {
		$fotonya = "../images/icon_uianam.ico";
	} else {
		$fotonya = "https://api.uinamfind.com/upload/photo/$dta[foto]";
	}
	?>
	<link rel="icon" type="image/x-icon" href="<?= $fotonya ?>" />
	<link rel="stylesheet" href="./bootstrap.min.css">
	<link rel="stylesheet" href="./style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com/">
	<link href="./css2" rel="stylesheet">
</head>

<body>
	<div class="container my-3 my-md-5">
		<div class="row">
			<!-- Sidebar column Start -->
			<div class="col-12 col-md-4 col-lg-4">
				<aside class="sidebar text-center px-2 px-md-3 px-lg-5 py-4 py-md-5 rounded">
					<div class="sticky-wrap">
						<div id="user-info" class="user-info">
							<?php
							if ($dta['foto'] == "") {
								$fotonya = "https://api.uinamfind.com/upload/photo/photo_default.png";
							} else {
								$fotonya = "https://api.uinamfind.com/upload/photo/$dta[foto]";
							}
							?>
							<div class="about"> <img alt="<?= $dta['nama_depan'] ?> | UINAMFind | UINA ALauddin Makassar" src="<?= $fotonya ?>" class="profile-pic img-fluid rounded-circle">
								<h1 class="name mt-3 mb-1"><?= $dta['nama_depan'] ?> <?= $dta['nama_belakang'] ?></h1>

								<?php
								$result_motto = mysqli_query($conn, "SELECT * FROM tb_motto_user WHERE user_id = '$dta[id]'");

								if (mysqli_num_rows($result_motto) > 0) {
									$dta_motto = mysqli_fetch_assoc($result_motto);
									echo "<p class='job-name mb-0'> $dta_motto[motto_profesional] </p>";
								}
								?>
							</div>
							<div id="contact-info" class="contact-info mt-5">
								<?php
								$telpon = "-";
								if ($dta['telpon'] == "") {
									$telpon = "-";
								} else {
									$telpon = $dta['telpon'];
								}

								$email = "-";
								if ($dta['email'] == "") {
									$email = "-";
								} else {
									$email = $dta['email'];
								}

								$lokasi = "-";
								if ($dta['lokasi'] == "") {
									$lokasi = "-";
								} else {
									$lokasi = $dta['lokasi'];
								}
								?>
								<p class="mb-2"><img src="./phone.svg"><a href="tel:<?= $telpon ?>" class="pl-2"><?= $telpon ?></a></p>
								<p class="mb-2"><img src="./envelope.svg"><a href="mailto:<?= $email ?>" class="pl-2"><?= $email ?></a></p>
								<p class="mb-2"><img src="./location.svg"><a href="#" class="pl-2"><?= $lokasi ?></a></p>
								<div class="social-icons">
									<ul class="list-unstyled mb-0">

										<?php
										$sosmed = mysqli_query($conn, "SELECT * FROM tb_sosmed WHERE kategori = 'Mahasiswa' AND from_id = '$dta[id]'");
										foreach ($sosmed as $dta_get_sosmed) {
											$nama_sosmed = $dta_get_sosmed['nama_sosmed'];
											$nama_svg_icon = "Google.svg";
											if ($nama_sosmed == "Facebook") {
												$nama_svg_icon = "Facebook.svg";
											} else if ($nama_sosmed == "Instagram") {
												$nama_svg_icon = "Instagram.svg";
											} else if ($nama_sosmed == "Whatsapp") {
												$nama_svg_icon = "WhatsApp.svg";
											} else if ($nama_sosmed == "Twitter") {
												$nama_svg_icon = "Twitter.svg";
											} else if ($nama_sosmed == "TikTok") {
												$nama_svg_icon = "TikTok.svg";
											} else if ($nama_sosmed == "Youtube") {
												$nama_svg_icon = "YouTube.svg";
											} else if ($nama_sosmed == "Linkedin") {
												$nama_svg_icon = "LinkedIn.svg";
											} else if ($nama_sosmed == "Github") {
												$nama_svg_icon = "Github.svg";
											} else if ($nama_sosmed == "Telegram") {
												$nama_svg_icon = "Telegram.svg";
											} else if ($nama_sosmed == "Pinterest") {
												$nama_svg_icon = "Pinterest.svg";
											} else if ($nama_sosmed == "Website") {
												$nama_svg_icon = "Google.svg";
											}
										?>

											<li>
												<a target="_blank" href="<?= $dta_get_sosmed['url_sosmed'] ?>"><img src="svg/<?= $nama_svg_icon ?>"></a>
											</li>

										<?php

										}
										?>

									</ul>
								</div>
								<div class="contact-btn"> <a target="_parent" href="https://uinamfind.com" class="btn btn-primary btn-sm mt-5 rounded-pill text-uppercase">Home</a> </div>
							</div>
						</div>
						<div id="contact-form" class="contact-form mt-4">
							<div class="row align-items-center">
								<div class="col-6 text-left">
									<h3 class="form-title text-uppercase pl-3 mb-0">Say Hi!</h3>
								</div>
								<div class="col-6 text-right">
									<button id="close-form" class="close-form bg-transparent border-0 pr-3" onclick="showUserInfo(event)">
										<!--?xml version="1.0" encoding="iso-8859-1"?-->
										<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve">
											<polygon points="456.851,0 245,212.564 33.149,0 0.708,32.337 212.669,245.004 0.708,457.678 33.149,490 245,277.443 456.851,490 
										489.292,457.678 277.331,245.004 489.292,32.337 "></polygon>
										</svg>
									</button>
								</div>
							</div>
							<form action="https://angrystudio.github.io/angrystudio-puro-bootstrap-cv/#" method="POST" class="mt-1">
								<input type="text" class="form-control bg-transparent rounded-pill mb-3" placeholder="Name">
								<input type="text" class="form-control bg-transparent rounded-pill mb-3" placeholder="Email">
								<textarea class="form-control bg-transparent rounded-pill mb-3" placeholder="Message"></textarea>
								<button type="button" class="btn btn-primary btn-sm text-uppercase rounded-pill">Submit</button>
							</form>
						</div>
					</div>
				</aside>
			</div>
			<!-- Sidebar column End -->
			<!-- Main Content column Start -->
			<div class="col-12 col-md-8 col-lg-8">
				<main class="content ml-0 ml-md-2 mr-0">
					<!-- About  Start-->
					<div id="about" class="section mt-3 mt-md-0 p-3 p-md-5 rounded">
						<h3 class="mb-3 text-uppercase">Tentang Saya</h3>
						<?php
						if ($dta['tentang_user'] == "") {
							echo "
							<p><i>User belum mengatur</i></p>";
						} else {
							echo "<p> $dta[tentang_user]</p>";
						}
						?>
					</div>
					<!-- About  End-->



					<!-- Education  Start-->
					<div id="education" class="section mt-3 mt-md-5 p-3 p-md-5 rounded">
						<h3 class="mb-2 text-uppercase"> Pendidikan </h3>


						<?php

						$get_pendidikan = mysqli_query($conn, "SELECT * FROM tb_pendidikan_user WHERE user_id = '$dta[id]'");

						foreach ($get_pendidikan as $dta_get_pendidikan) {
						?>
							<div class="row mt-4 mb-2">
								<div class="col-6"> <span class="tiny-super font-weight-bold"><?= $dta_get_pendidikan['nama_tempat'] ?></span> <span class="tiny-super d-block"><?= $dta_get_pendidikan['jurusan'] ?></span> </div>

								<?php
								$mulai_pendidikan = date("Y", strtotime($dta_get_pendidikan['tanggal_masuk']));
								$akhir_pendidikan = date("Y", strtotime($dta_get_pendidikan['tanggal_berakhir']));
								$masa_pendidikan = "-";
								if ($dta_get_pendidikan['status_pendidikan'] == "Masih") {
									$masa_pendidikan = $mulai_pendidikan . " - Sekarang";
								} else {

									$masa_pendidikan = $mulai_pendidikan . " - " . $akhir_pendidikan;
								}
								?>
								<div class="col-6 text-right"> <span class="tiny-super"><?= $masa_pendidikan ?></span> </div>
							</div>
						<?php
						}
						?>

					</div>
					<!-- Education  End-->

					<!-- Experience  Start-->
					<div id="experience" class="section mt-3 mt-md-5 p-3 p-md-5 rounded">
						<h3 class="mb-3 text-uppercase">Pengalaman</h3>


						<?php

						$get_pengalaman = mysqli_query($conn, "SELECT * FROM tb_pengalaman_user WHERE user_id = '$dta[id]'");

						foreach ($get_pengalaman as $dta_get_pengalaman) {
						?>
							<div class="row mt-4 mb-2">
								<div class="col-6"> <span class="tiny-super font-weight-bold"><?= $dta_get_pengalaman['judul'] ?></span> <span class="tiny-super d-block"><?= $dta_get_pengalaman['nama_tempat'] ?></span> </div>

								<?php
								$mulai_pengalaman = date("M Y", strtotime($dta_get_pengalaman['tanggal_mulai']));
								$akhir_pengalaman = date("M Y", strtotime($dta_get_pengalaman['tanggal_berakhir']));
								$masa_pengalaman = "-";
								if ($dta_get_pengalaman['status_pengalaman'] == "Berjalan") {
									$masa_pengalaman = $mulai_pengalaman . " - Sekarang";
								} else {

									$masa_pengalaman = $mulai_pengalaman . " - " . $akhir_pengalaman;
								}
								?>
								<div class="col-6 text-right"> <span class="tiny-super"><?= $masa_pengalaman ?></span> </div>
								<div class="col-12 mt-2">
									<p><?= $dta_get_pengalaman['deskripsi'] ?></p>
								</div>
							</div>

						<?php
						}
						?>

					</div>
					<!-- Experience End-->



					<!-- Education  Start-->
					<div id="education" class="section mt-3 mt-md-5 p-3 p-md-5 rounded">
						<h3 class="mb-2 text-uppercase"> Organisasi </h3>


						<?php

						$get_organisasi = mysqli_query($conn, "SELECT * FROM tb_organisasi_user WHERE user_id = '$dta[id]'");

						foreach ($get_organisasi as $dta_get_organisasi) {
						?>
							<div class="row mt-4 mb-2">
								<div class="col-6"> <span class="tiny-super font-weight-bold"><?= $dta_get_organisasi['nama_organisasi'] ?></span> <span class="tiny-super d-block"><?= $dta_get_organisasi['jabatan'] ?></span> </div>

								<?php
								$mulai_organisasi = date("Y", strtotime($dta_get_organisasi['tanggal_mulai']));
								$akhir_organisasi = date("Y", strtotime($dta_get_organisasi['tanggal_berakhir']));
								$masa_organisasi = "-";
								if ($dta_get_organisasi['status_organisasi_user'] == "Berakhir") {
									$masa_organisasi = $mulai_organisasi . " - " . $akhir_organisasi;
								} else {
									$masa_organisasi = $mulai_organisasi . " - Sekarang";
								}
								?>
								<div class="col-6 text-right"> <span class="tiny-super"><?= $masa_organisasi ?></span> </div>
							</div>
						<?php
						}
						?>

					</div>
					<!-- Education  End-->


					<?php
					$get_skill = mysqli_query($conn, "SELECT * FROM tb_skills_user WHERE user_id = '$dta[id]'");
					?>

					<!-- Skills  Start-->
					<div id="skills" class="section mt-3 mt-md-5 p-3 p-md-5 rounded">
						<h3 class=" mb-3 text-uppercase">Keahlian</h3>
						<div class="row">
							<div class="col-12">
								<p>Skill dan keahlian saya</p>
							</div>
							<div class="col-12 col-md-12">
								<?php
								foreach ($get_skill as $dta_get_skill) {
									$persen = "20%";
									if ($dta_get_skill['level_skill'] == "1") {
										$persen = "20%";
									} else if ($dta_get_skill['level_skill'] == "2") {
										$persen = "40%";
									} else if ($dta_get_skill['level_skill'] == "3") {
										$persen = "60%";
									} else if ($dta_get_skill['level_skill'] == "4") {
										$persen = "80%";
									} else {
										$persen = "95%";
									}

								?>

									<div class="progress mt-4">
										<div class="progress-bar progress-bar-striped progress-bar-animated bg-progress" role="progressbar" aria-valuenow="<?= $dta_get_skill['level_skill'] ?>" aria-valuemin="0" aria-valuemax="5" style="width: <?= $persen ?>"><?= $dta_get_skill['nama_skill'] ?></div>
									</div>

								<?php

								}
								?>
								<!-- <div class="progress mt-4">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-progress" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">JavaScript</div>
								</div>
								<div class="progress mt-4">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-progress" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">Go</div>
								</div> -->
							</div>
							<!-- <div class="col-12 col-md-6">
								<div class="progress mt-4">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-progress" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%">PHP</div>
								</div>
								<div class="progress mt-4">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-progress" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%">JAVA</div>
								</div>
								<div class="progress mt-4">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-progress" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 90%">Pearl</div>
								</div>
							</div> -->
						</div>
					</div>
					<!-- Skills  End-->


					<!-- Projects  Start-->
					<!-- <div id="projects" class="section mt-3 mt-md-5 p-3 p-md-5 rounded">
						<h3 class="mb-3 text-uppercase">Projects</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
						<p><strong>Apps - </strong>Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
						<p><strong>CRMs - </strong>Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
						<p><strong>Websites - </strong>Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
						<p><strong>eCom Apps - </strong>Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
					</div> -->
					<!-- Projects  End-->
					<!-- Certifications  Start-->
					<!-- <div id="certifications" class="section mt-3 mt-md-5 p-3 p-md-5 rounded">
						<h3 class="mb-3 text-uppercase">Certifications</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
						<p><strong>SAP - </strong>Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
						<p><strong>CCP - </strong>Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
						<p><strong>PAAS - </strong>Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
						<p><strong>HDPCD - </strong>Ut accumsan turpis nec elit feugiat, et sodales ex pulvinar. Donec dolor massa, consequat eu interdum a, semper at lectus.</p>
					</div> -->
					<!-- Certifications  End-->
				</main>
			</div>
			<!-- Main Content column End -->
		</div>
	</div>
	<script src="./main.js.download"></script>

</body>

</html>