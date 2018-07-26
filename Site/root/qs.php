<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('location:login.php');
	}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="br"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HexaMedicine - Quem somos</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <?php include('menu.php'); ?> <!--Barra lateral-->
	
    <div id="right-panel" class="right-panel">

	<?php include('header.php');?> <!--Topo da página-->

        <div class="content mt-3 animated fadeIn"> <!--Conteúdo-->
			<div class="row">
				<!--<div class="col-md-6 offset-md-3 mr-auto ml-auto">
					<div class="card">
						<div class="card-header"><strong>Sobre</strong></div>
						<div class="card-body">
							askdjghsud
						</div>
					</div>
                </div>-->
				<div class="col-md-4 offset-md mr-auto ml-auto">
					<div class="card">
						<div class="card-body">
							<div class="mx-auto d-block">
								<img class="rounded-circle mx-auto d-block" height="200px" width="200px" src="images/admin/adminFelipe.jpg" alt="Card image cap">
								<h5 class="text-sm-center mt-2 mb-1">Felipe Risney</h5>
								<div class="location text-sm-center"><i class="fa fa-map-marker"></i> Paraná, Brasil</div>
							</div>
							<hr>
							<div class="card-text text-sm-center">
								<a href="#"><i class="fa fa-facebook pr-1"></i></a>
								<a href="#"><i class="fa fa-twitter pr-1"></i></a>
								<a href="#"><i class="fa fa-linkedin pr-1"></i></a>
								<a href="#"><i class="fa fa-pinterest pr-1"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 offset-md mr-auto ml-auto">
					<div class="card">
						<div class="card-body">
							<div class="mx-auto d-block">
								<img class="rounded-circle mx-auto d-block" height="200px" width="200px" src="images/admin/adminAndre.jpg" alt="Card image cap">
								<h5 class="text-sm-center mt-2 mb-1">André Gabardo</h5>
								<div class="location text-sm-center"><i class="fa fa-map-marker"></i> Paraná, Brasil</div>
							</div>
							<hr>
							<div class="card-text text-sm-center">
								<a href="#"><i class="fa fa-facebook pr-1"></i></a>
								<a href="#"><i class="fa fa-twitter pr-1"></i></a>
								<a href="#"><i class="fa fa-linkedin pr-1"></i></a>
								<a href="#"><i class="fa fa-pinterest pr-1"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 offset-md mr-auto ml-auto">
					<div class="card">
						<div class="card-body">
							<div class="mx-auto d-block">
								<img class="rounded-circle mx-auto d-block" height="200px" width="200px" src="images/admin/adminMarcelo.jpg" alt="Card image cap">
								<h5 class="text-sm-center mt-2 mb-1">Marcelo Bispo</h5>
								<div class="location text-sm-center"><i class="fa fa-map-marker"></i> Paraná, Brasil</div>
							</div>
							<hr>
							<div class="card-text text-sm-center">
								<a href="#"><i class="fa fa-facebook pr-1"></i></a>
								<a href="#"><i class="fa fa-twitter pr-1"></i></a>
								<a href="#"><i class="fa fa-linkedin pr-1"></i></a>
								<a href="#"><i class="fa fa-pinterest pr-1"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 offset-md mr-auto ml-auto">
					<div class="card">
						<div class="card-body">
							<div class="mx-auto d-block">
								<img class="rounded-circle mx-auto d-block" height="200px" width="200px" src="images/admin/adminGiuliano.jpg" alt="Card image cap">
								<h5 class="text-sm-center mt-2 mb-1">Giuliano Tomasi</h5>
								<div class="location text-sm-center"><i class="fa fa-map-marker"></i> Paraná, Brasil</div>
							</div>
							<hr>
							<div class="card-text text-sm-center">
								<a href="#"><i class="fa fa-facebook pr-1"></i></a>
								<a href="#"><i class="fa fa-twitter pr-1"></i></a>
								<a href="#"><i class="fa fa-linkedin pr-1"></i></a>
								<a href="#"><i class="fa fa-pinterest pr-1"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="assets/js/dashboard.js"></script>


</body>
</html>
