<?php
require_once 'koneksi.php';
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

?>

<!DOCTYPE html>
<!-- saved from url=(0037)https://angrystudio.com/preview/puro/ -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex,follow">
    <meta name="keywords" content="UINAM, uinam, uinamfind, UIN, Universitas Alauddin Makassar, Alauddin, Makassar, Mahaisswa, Kampus, Samata, Gowa, Recruiter, Loker, Lowongan Kerja, Organisasi, UKM, UIN Alauddin Makassar, Universitas Islam Negeri Alauddin Makassar, Islam, Find, Cari" />
    <meta name="description" content="">
    <?php
    if (mysqli_num_rows($result) > 0) {
        $dta = mysqli_fetch_assoc($result);
        if ($dta['foto'] == "") {
            $fotonya = "/images/icon_uianam.ico";
        } else {
            $fotonya = "https://api.uinamfind.com/upload/photo/$dta[foto]";
        }
    ?>
        <title> <?= $dta['nama_depan'] ?> <?= $dta['nama_belakang'] ?> | My Resume</title>
        <link rel="icon" type="image/x-icon" href="<?= $fotonya ?>" />
    <?php
    } else {
    ?>
        <title> <?= $username ?> | My Resume</title>
        <link rel="icon" type="image/x-icon" href="/images/icon_uianam.ico" />
    <?php
    }
    ?>
    <link rel="stylesheet" href="template/preview-generator.css">
</head>

<body data-rsssl="1">

    <div id="preview">
        <iframe id="hk-preview" class="pc-preview tab-preview mobile-preview" src="template/user.php?username=<?= $username ?>" frameborder="0"></iframe>
    </div>
    <!-- <script type="text/javascript" async="" src="template/analytics.js.download"></script> -->
    <script>
        (function($) {

        }(jQuery));
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="" src="template/js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-159397668-1');
    </script>


</body>

</html>