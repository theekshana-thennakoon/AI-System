<?php
session_start();
//include('database.php');
header("Location:search");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<link rel="icon" href="https://th.bing.com/th/id/R.c70638d537870aec2fdae3699a22c1df?rik=N76Nn3vS2F3PeQ&riu=http%3a%2f%2fwww.lanmds.com%2fwp-content%2fuploads%2f2016%2f03%2fPress-Release-image-1.jpg&ehk=Vq46veuwxCiHGJYg%2fg3qHHgR%2f%2b%2fDyENwzMaKaydjS0o%3d&risl=&pid=ImgRaw&r=0">
-->
	<title>AI System</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="wrapstyle.css">
	<!-- custom css file link  -->
	<link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
	.home {margin-top:-70px}
	.header-1 img{width:30%;}
	table{width:100%;border:1px solid #ccc;}
	tr:nth-child(1){border:1px solid #ccc;}
	th,td{padding:1%;font-size:15px;}
	a{text-decoration:none;color:#fe2121;}

	.copyright{position:fixed;bottom:20px;right:10px;border:1px solid #ccc;padding:0.5%;z-index: 2;}
	</style>
</head>
<body>
<script src="sweetalert.min.js"></script>
<!-- header section starts  -->

<section class="contact">
	<div class="wrapper">
      <div class="content">
        <ul class="menu">
          <li class="item share">
            <ul class="share-menu"></ul>
          </li>
          <li class="item">
            <i class="uil uil-ban"></i>
          </li>
          <li class="item">
            <span>Right Click Disabled</span>
          </li>
        </ul>
      </div>
    </div>
</section>
<div class="copyright"><h5>Developed by<br>Thisula Development<h5></div>
<!-- Pickup section ends -->
<br><br>
<!-- custom js file link  -->
<script src = "scripts.js">
</script>
</body>
</html>