<?php
	require 'config.php';
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('location:login.php');
	}
	if($_POST){
		$senha = hash("sha256",$_POST['senha']);
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		
		if($nome != ""){
			$perfil = $db->query("Update usuario Set nome = '$nome' where login = '{$_SESSION['usuario']}'");
		}
		if($email != ""){
			$perfil = $db->query("Update usuario Set email = '$email' where login = '{$_SESSION['usuario']}'");
		}
		if($senha != ""){
			$perfil = $db->query("Update usuario Set senha = '$senha' where login = '{$_SESSION['usuario']}'");
		}
		if($telefone != ""){
			$perfil = $db->query("Update usuario Set telefone = '$telefone' where login = '{$_SESSION['usuario']}'");
		}
		$db->close();
		if(isset($_FILES['fileUpload'])){move_uploaded_file($_FILES['fileUpload']['tmp_name'], "images/profile/".$_SESSION['usuario'].".jpg");}	
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
    <title>HexaMedicine - Conta</title>
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
				<div class="col-lg-5 offset-md mr-auto ml-auto">
					<div class="card">
						<div class="card-body">
							<form method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Nome</label>
									<input type="text" class="form-control" name="nome">
								</div>
								<div class="form-group">
									<label>Senha</label>
									<input type="password" class="form-control" name="senha">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="email">
								</div>
								<div class="form-group">
									<label>Imagem do Perfil</label>
									<input type="file" class="form-control" name="fileUpload">
								</div>
								<div class="form-group">
									<label>Telefone</label>
									<input type="tel" class="form-control" name="telefone" maxlength="15" placeholder="(__)___-___-___" data-mask="(00)000-000-000" data-mask-selectonfocus="true" />
								</div>
								<button type="submit" class="btn btn-info btn-lg btn-block">Atualizar dados Cadastrais</button>
							</form>
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
	<script src="assets/js/jquery.mask.min.js"></script>


</body>
</html>
